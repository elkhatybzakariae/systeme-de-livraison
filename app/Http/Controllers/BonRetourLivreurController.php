<?php

namespace App\Http\Controllers;

use App\Models\BonRetourLivreur;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Zone;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Writer;

class BonRetourLivreurController extends Controller
{
    public function index(Request $request, $id_BRL = null)
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
        $colis = Colis::query()->with('ville')->whereNull('id_BRL')->where('zone', $id_Z)->get();

        $colisBon = [];
        // dd($colis);
        if (!$id_BRL) {
            if ($user) {
                $bonLivraison = BonRetourLivreur::create([
                    'id_BRL' => 'BRL-' . Str::random(10),
                    'reference' => 'BRL-' . Str::random(10),
                    'status' => 'nouveau',
                    'id_Z' => $id_Z,
                    'id_Liv' => $request->input('id_Liv'),
                ]);
            } else {
                return redirect(route('auth.client.signIn'));
            }
        } else {
            $bonLivraison = BonRetourLivreur::query()->with('colis')->where('id_BRL', $id_BRL)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BRL =?', [$id_BRL]);
            // dd($colisBon)  ;

        }
        $breads = [
            ['title' => 'créer un Bon Distribution', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.BonRetourLivreur.index', compact("colis", "bonLivraison", 'colisBon', 'breads'));
    }
    public function list()
    {
        $user = session('user');
        if (!$user) {
            return redirect(route('auth.admin.signIn'));
        }

        $bons = BonRetourLivreur::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('livreurs', 'bon_retour_livreurs.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('zones', 'bon_retour_livreurs.id_Z', '=', 'zones.id_Z')
            ->select('bon_retour_livreurs.*', 'livreurs.nomcomplet as liv_nomcomplet', 'zones.zonename as zone')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BRL = bon_retour_livreurs.id_BRL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BRL = bon_retour_livreurs.id_BRL) as total_prix')) // Corrected table name (BL -> BD)
            ->leftJoin('colis', 'bon_retour_livreurs.id_BRL', '=', 'colis.id_BRL')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->get();
        // $bons=BonRetourLivreur::all();
        // dd($bons);
        $breads = [
            ['title' => 'Liste des Bons de distributions ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.BonRetourLivreur.list', compact("bons", 'breads'));
    }
    public function create()
    {
        $user = session('user');
        if (!$user) {
            return redirect(route('auth.client.signIn'));
        }

        $zones = Zone::withCount([
            'colis' => function ($query) {
                $query->where('status', 'distribution');
            }
        ])->with(['colis', 'livreurs'])->get();

        $breads = [
            ['title' => 'créer un Bon Distribution', 'url' => null],
            ['text' => 'Bons', 'url' => null],
        ];
        return view('pages.admin.bonDistribution.create', compact("zones", 'breads'));
    }

    public function update($id, $id_BRL)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BRL' => $id_BRL, 'status' => 'en livraison']);
        $coli = Colis::where('id', $id)->first();
        $colisinfo = colisinfo::where('id', $id)->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',non paye,en livraison,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.distribution.index', $id_BRL);
    }
    public function recu($id_BRL)
    {
        Colis::where('id_BRL', $id_BRL)
            ->update(['status' => 'recu']);
        BonRetourLivreur::where('id_BRL', $id_BRL)
            ->update(['status' => 'recu']);
        $coli = Colis::where('id_BRL', $id_BRL)->first();
        $colisinfo = colisinfo::where('id', $coli['id'])->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',non paye,recu,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.retour.livreur.list');
    }
    public function updateDelete($id, $id_BRL)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BRL' => null, 'status' => 'distribution']);

        // dd($colis);
        return redirect()->route('bon.retour.livreur.index', $id_BRL);
    }


    public function updateAll(Request $request, $id_BRL)
    {
        // dd($request->input('query'));
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BRL' => $id_BRL, 'status' => 'en livraison']);
        } else {


            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BRL' => $id_BRL, 'status' => 'en livraison']);
            }
        }
        return redirect()->route('bon.retour.livreur..index', $id_BRL);
    }
    public function updateDeleteAll(Request $request, $id_BRL)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BRL' => null, 'status' => 'distribution']);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BRL' => null, 'status' => 'distribution']);
            }
        }
        return redirect()->route('bon.retour.livreur..index', $id_BRL);
    }
    public function exportColis($id_BRL)
    {
        $colis = Colis::where('id_BRL', $id_BRL)->get();
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
        $fileName = 'colis_' . $id_BRL . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }
    public function getPdf($id)
    {
        // $bon = BonRetourLivreur::where('id_BRL', $id)->first();
        $bon = BonRetourLivreur::where('bon_retour_livreurs.id_BRL', $id) // Specify the table for id_BRL
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('livreurs', 'bon_retour_livreurs.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('zones', 'bon_retour_livreurs.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_retour_livreurs.id_BRL', '=', 'colis.id_BRL')
            ->select('bon_retour_livreurs.*', 'livreurs.nomcomplet as liv_nom', 'livreurs.Phone as liv_tele', 'zones.zonename as liv_zone')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BRL = bon_retour_livreurs.id_BRL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BRL = bon_retour_livreurs.id_BRL) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id_BRL', $id)->get();
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
        $dompdf = new Dompdf();
        // 
        //     // Load the HTML content into Dompdf
        $html = view('pages.admin.BonRetourLivreur.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon' . $bon->id_BRL . '.pdf');
    }
}
