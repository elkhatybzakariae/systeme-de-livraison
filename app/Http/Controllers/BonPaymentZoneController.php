<?php

namespace App\Http\Controllers;

use App\Models\BonPaymentZone;
use App\Models\BonRetourClient;
use App\Models\Colis;
use App\Models\Zone;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Writer;

class BonPaymentZoneController extends Controller
{
    public function index(Request $request, $id_BRZ = null)
    {
        $id_Z = $request->input('zone');
        if ($id_Z == null) {
            $id_Z = session('zone');
        } else {
            session(['zone' => $id_Z]);
        }
        $user = session('user');
        // $colis = Colis::query()->with('ville')->whereNull('id_BRZ')->where('zone', $id_Z)->get();
        $colis = Colis::query()
            ->with('ville')
            ->whereNull('id_BRZ')
            ->where('zone', $id_Z)
            ->where('status', 'Livre')
            ->where('etat', 'Paye')
            ->whereNot('id_BRZ',null)
            ->get();

        $colisBon = [];
        if (!$id_BRZ) {
            if ($user) {
                $bon = BonPaymentZone::create([
                    'id_BRZ' => 'BPZ-' . Str::random(10),
                    'reference' => 'BPZ-' . Str::random(10),
                    'status' => 'Nouveau',
                    'id_Z' => $id_Z??'hIhWv3fAYL',
                ]);
            } else {
                return redirect(route('auth.client.signIn'));
            }
        } else {
            $bon = BonPaymentZone::query()->with('colis')->where('id_BRZ', $id_BRZ)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BRZ =?', [$id_BRZ]);
        }
        $breads = [
            ['title' => 'créer un Bon payment pour zone', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.BonPaymentZone.index', compact("colis", "bon", 'colisBon', 'breads'));
    }
    public function list()
    {
        $user = session('user');
        if (!$user) {
            return redirect(route('auth.admin.signIn'));
        }
        $bons = BonPaymentZone::select(
            'bon_retour_zones.id_BRZ',
            'bon_retour_zones.reference',
            'bon_retour_zones.status',
            'bon_retour_zones.created_at',
            'zones.zonename as zone',

        )
            ->withCount('colis') // Count the number of related colis
            ->withSum('colis', 'prix') // Sum the prices of related colis
            ->leftJoin('zones', 'bon_retour_zones.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_retour_zones.id_BRZ', '=', 'colis.id_BRZ')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->get();
        // $bons=BonPaymentZone::all();
        // dd($bons);
        $breads = [
            ['title' => 'Liste des Bons de payment zone ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.BonPaymentZone.list', compact("bons", 'breads'));
    }
    public function create()
    {
        $user = session('user');

        $zones = Zone::whereHas('colis', function ($query) {
            $query
            ->where('status', 'Livre')
            ->where('etat', 'Paye')
            ->whereNot('id_BRZ',null );
        })
            ->with([
                'colis' => function ($query) {
                    $query->where('status', 'Livre');
                }
            ])
            ->withCount('colis')
            ->get();

        $breads = [
            ['title' => 'créer un Bon Payement', 'url' => null],
            ['text' => 'Bons', 'url' => null],
        ];
        return view('pages.admin.BonPaymentZone.create', compact("zones", 'breads'));
    }

    public function destroy($id)
    {
        $bon = BonPaymentZone::find($id);
        $bon->delete();
        return redirect()->route('bon.payment.zone.list')->with('success', 'bon deleted successfully.');
    }
    public function update($id, $id_BRZ)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BRZ' => $id_BRZ]);
        return redirect()->route('bon.payment.zone.index', $id_BRZ);
    }
    public function updateDelete($id, $id_BRZ)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BRZ' => null]);
        return redirect()->route('bon.payment.zone.index', $id_BRZ);
    }


    public function updateAll(Request $request, $id_BRZ)
    {
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BRZ' => $id_BRZ]);
        } else {


            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BRZ' => $id_BRZ]);
            }
        }
        return redirect()->route('bon.payment.zone.index', $id_BRZ);
    }
    public function updateDeleteAll(Request $request, $id_BRZ)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BRZ' => null]);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BRZ' => null]);
            }
        }
        return redirect()->route('bon.payment.zone.index', $id_BRZ);
    }

    public function recu($id_BRZ)
    {
        BonPaymentZone::where('id_BRZ', $id_BRZ)
            ->update(['status' => 'Paye']);
        return back();
    }
    public function nonrecu($id_BRZ)
    {
        BonPaymentZone::where('id_BRZ', $id_BRZ)
            ->update(['status' => 'Nouveau']);
        return back();
    }

    
    public function exportColis($id_BRZ)
    {
        $colis = Colis::where('id_BRZ', $id_BRZ)->get();
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
        $fileName = 'colis_' . $id_BRZ . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }

    public function getPdf($id)
    {
        // $bon = BonDistribution::where('id_BRZ', $id)->first();
        $bon = BonRetourClient::where('bon_retour_zones.id_BRZ', $id) // Specify the table for id_BRZ
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            // ->leftJoin('livreurs', 'bon_retour_zones.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('zones', 'bon_retour_zones.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_retour_zones.id_BRZ', '=', 'colis.id_BRZ')
            ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
            ->select('bon_retour_zones.*',
            //  'livreurs.nomcomplet as liv_nom',
            //   'livreurs.fraislivraison as frais', 
            //   'livreurs.Phone as liv_tele', 
              'clients.nomcomplet as nomcomplet', 
              'colis.status as status', 
              'zones.zonename as liv_zone'
              
              )
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BRZ = bon_retour_zones.id_BRZ) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BRZ = bon_retour_zones.id_BRZ) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id_BRZ', $id)
        ->with('client','BRL',)
        ->get();
        // dd($colis[0]->bonPaymentLivreur->livreur->fraislivraison);
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
        $dompdf = new Dompdf();
        $html = view('pages.admin.bonRetourZone.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BRZ . '.pdf');
    }

}
