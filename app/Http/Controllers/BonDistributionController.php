<?php

namespace App\Http\Controllers;

use App\Models\BonDistribution;
use App\Models\Colis;
use App\Models\Zone;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Writer;
use PDF;

class BonDistributionController extends Controller
{
    public function index(Request $request, $id_BD = null)
    {
        // dd($request);
        $id_Z = $request->input('zone');
        if ($id_Z == null) {
            $id_Z = session('zone');
        } else {
            session(['zone' => $id_Z]);
        }
        // dd(session('zone'));
        $user = session('user');
        $colis = Colis::query()->with('ville')->whereNull('id_BD')->where('zone', $id_Z)->get();

        $colisBon = [];
        // dd($colis);
        if (!$id_BD) {
            if ($user) {
                $bonLivraison = BonDistribution::create([
                    'id_BD' => 'BD-' . Str::random(12),
                    'reference' => 'BD-' . Str::random(10),
                    'status' => 'nouveau',
                    'id_Z' => $id_Z,
                    'id_Liv' => $request->input('id_Liv'),
                ]);
            } else {
                return redirect(route('auth.client.signIn'));
            }
        } else {
            $bonLivraison = BonDistribution::query()->with('colis')->where('id_BD', $id_BD)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BD =?', [$id_BD]);
            // dd($colisBon)  ;

        }
        $breads = [
            ['title' => 'créer un Bon Distribution', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonDistribution.index', compact("colis", "bonLivraison", 'colisBon', 'breads'));
    }
    public function list()
    {
        $user = session('user');
        if (!$user) {
            return redirect(route('auth.admin.signIn'));
        }

        $bons = BonDistribution::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('livreurs', 'bon_distributions.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('zones', 'bon_distributions.id_Z', '=', 'zones.id_Z')
            ->select('bon_distributions.*', 'livreurs.nomcomplet as liv_nomcomplet', 'zones.zonename as zone')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BD = bon_distributions.id_BD) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BD = bon_distributions.id_BD) as total_prix')) // Corrected table name (BL -> BD)
            ->leftJoin('colis', 'bon_distributions.id_BD', '=', 'colis.id_BD')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->get();
        // $bons=BonDistribution::all();
        // dd($bons);
        $breads = [
            ['title' => 'Liste des Bons de distributions ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonDistribution.list', compact("bons", 'breads'));
    }
    public function create()
    {
        $user = session('user');
        if (!$user) {
            return redirect(route('auth.client.signIn'));
        }

        $zones = Zone::whereHas('colis', function ($query) {
            $query->where('status', 'distribution');
        })
            ->with(['colis', 'livreurs'])
            ->withCount('colis')
            ->get();



        $breads = [
            ['title' => 'créer un Bon Distribution', 'url' => null],
            ['text' => 'Bons', 'url' => null],
        ];
        return view('pages.admin.bonDistribution.create', compact("zones", 'breads'));
    }

    public function update($id, $id_BD)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BD' => $id_BD, 'status' => 'en livraison']);
        return redirect()->route('bon.distribution.index', $id_BD);
    }
    public function recu($id_BD)
    {
        Colis::where('id_BD', $id_BD)
            ->update(['status' => 'recu']);
        BonDistribution::where('id_BD', $id_BD)
            ->update(['status' => 'recu']);
        return redirect()->route('bon.distribution.list');
    }
    public function updateDelete($id, $id_BD)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BD' => null, 'status' => 'recu']);

        // dd($colis);
        return redirect()->route('bon.distribution.index', $id_BD);
    }

    public function updateAll(Request $request, $id_BD)
    {
        // dd($request);
        foreach ($request->colis as $colis) {

            $colis = Colis::where('id', $colis)
                ->update(['id_BD' => $id_BD, 'status' => 'en livraison']);
        }
        return redirect()->route('bon.distribution.index', $id_BD);
    }
    public function updateDeleteAll(Request $request, $id_BD)
    {
        foreach ($request->colisDelete as $colis) {

            $colis = Colis::where('id', $colis)
                ->update(['id_BD' => null]);
        }
        return redirect()->route('bon.distribution.index', $id_BD);
    }
    public function exportColis($id_BD)
    {
        $colis = Colis::where('id_BD', $id_BD)->get();
        $csv = Writer::createFromString('');
        $csv->insertOne(['Code d\'envoi', 'Destinataire', 'Date de creation', 'Prix', 'Ville']);
        foreach ($colis as $colisItem) {
            $csv->insertOne([
                $colisItem->code_d_envoi,
                $colisItem->destinataire,
                $colisItem->created_at,
                $colisItem->prix,
                $colisItem->ville->villename
            ]);
        }
        $fileName = 'colis_' . $id_BD . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }
    public function getPdf($id)
    {
        // $bon = BonDistribution::where('id_BD', $id)->first();
        $bon = BonDistribution::where('bon_distributions.id_BD', $id) // Specify the table for id_BD
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('livreurs', 'bon_distributions.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('zones', 'bon_distributions.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_distributions.id_BD', '=', 'colis.id_BD')
            ->select('bon_distributions.*', 'livreurs.nomcomplet as liv_nom', 'livreurs.Phone as liv_tele', 'zones.zonename as liv_zone')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BD = bon_distributions.id_BD) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BD = bon_distributions.id_BD) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id_BD', $id)->get();
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
        $dompdf = new Dompdf();
        // 
        //     // Load the HTML content into Dompdf
        $html = view('pages.admin.bonDistribution.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon' . $bon->id_BD . '.pdf');
    }
}
