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
    public function index(Request $request, $id_BPZ = null)
    {
        $id_Z = $request->input('zone');
        if ($id_Z == null) {
            $id_Z = session('zone');
        } else {
            session(['zone' => $id_Z]);
        }
        $user = session('user');
        // $colis = Colis::query()->with('ville')->whereNull('id_BPZ')->where('zone', $id_Z)->get();
        $colis = Colis::query()
            ->with('ville')
            ->whereNull('id_BPZ')
            ->where('zone', $id_Z)
            ->where('status', 'Livre')
            ->where('etat', 'Paye')
            ->get();

        $colisBon = [];
        if (!$id_BPZ) {
            if ($user) {
                $bon = BonPaymentZone::create([
                    'id_BPZ' => 'BPZ-' . Str::random(10),
                    'reference' => 'BPZ-' . Str::random(10),
                    'status' => 'Nouveau',
                    'id_Z' => $id_Z??'hIhWv3fAYL',
                ]);
            } else {
                return redirect(route('auth.client.signIn'));
            }
        } else {
            $bon = BonPaymentZone::query()->with('colis')->where('id_BPZ', $id_BPZ)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BPZ =?', [$id_BPZ]);
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
            'bon_payment_zones.id_BPZ',
            'bon_payment_zones.reference',
            'bon_payment_zones.status',
            'bon_payment_zones.created_at',
            'zones.zonename as zone',

        )
            ->withCount('colis') // Count the number of related colis
            ->withSum('colis', 'prix') // Sum the prices of related colis
            ->leftJoin('zones', 'bon_payment_zones.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_payment_zones.id_BPZ', '=', 'colis.id_BPZ')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->orderBy('created_at','desc')
            
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
            $query->where('status', 'Livre')
                ->where('etat', 'Paye')
                ->whereNull('id_BPZ')
                ->whereHas('bonPaymentLivreur', function ($queryBPZ) {
                    $queryBPZ->where('status', 'Paye');
                })
                ;
        })
        ->with(['colis' => function ($query) {
            $query->where('status', 'Livre')
                ->where('etat', 'Paye')
                ->whereNull('id_BPZ');
        }])
        ->withCount(['colis' => function ($query) {
            $query->where('status', 'Livre')
                ->where('etat', 'Paye')
                ->whereNull('id_BPZ');
        }])
        ->get();
        // dd($zones);
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
    public function update($id, $id_BPZ)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BPZ' => $id_BPZ]);
        return redirect()->route('bon.payment.zone.index', $id_BPZ);
    }
    public function updateDelete($id, $id_BPZ)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BPZ' => null]);
        return redirect()->route('bon.payment.zone.index', $id_BPZ);
    }


    public function updateAll(Request $request, $id_BPZ)
    {
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BPZ' => $id_BPZ]);
        } else {


            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BPZ' => $id_BPZ]);
            }
        }
        return redirect()->route('bon.payment.zone.index', $id_BPZ);
    }
    public function updateDeleteAll(Request $request, $id_BPZ)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BPZ' => null]);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BPZ' => null]);
            }
        }
        return redirect()->route('bon.payment.zone.index', $id_BPZ);
    }

    public function recu($id_BPZ)
    {
        BonPaymentZone::where('id_BPZ', $id_BPZ)
            ->update(['status' => 'Paye']);
        return back();
    }
    public function nonrecu($id_BPZ)
    {
        BonPaymentZone::where('id_BPZ', $id_BPZ)
            ->update(['status' => 'Nouveau']);
        return back();
    }

    
    public function exportColis($id_BPZ)
    {
        $colis = Colis::where('id_BPZ', $id_BPZ)->get();
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
        $fileName = 'colis_' . $id_BPZ . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }

    public function getPdfColis($id,$idC)
    {
        // $bon = BonDistribution::where('id_BPZ', $id)->first();
        $bon = BonRetourClient::where('bon_payment_zones.id_BPZ', $id) // Specify the table for id_BPZ
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            // ->leftJoin('livreurs', 'bon_payment_zones.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('zones', 'bon_payment_zones.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_payment_zones.id_BPZ', '=', 'colis.id_BPZ')
            ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
            ->select('bon_payment_zones.*',
            //  'livreurs.nomcomplet as liv_nom',
            //   'livreurs.fraislivraison as frais', 
            //   'livreurs.Phone as liv_tele', 
              'clients.nomcomplet as nomcomplet', 
              'colis.status as status', 
              'zones.zonename as liv_zone'
              
              )
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BPZ = bon_payment_zones.id_BPZ) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BPZ = bon_payment_zones.id_BPZ) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id', $idC)
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
        return $dompdf->stream('bon-' . $bon->id_BPZ . '.pdf');
    }
    public function getPdf($id)
    {
        // $bon = BonDistribution::where('id_BPZ', $id)->first();
        $bon = BonRetourClient::where('bon_payment_zones.id_BPZ', $id) // Specify the table for id_BPZ
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            // ->leftJoin('livreurs', 'bon_payment_zones.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('zones', 'bon_payment_zones.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_payment_zones.id_BPZ', '=', 'colis.id_BPZ')
            ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
            ->select('bon_payment_zones.*',
            //  'livreurs.nomcomplet as liv_nom',
            //   'livreurs.fraislivraison as frais', 
            //   'livreurs.Phone as liv_tele', 
              'clients.nomcomplet as nomcomplet', 
              'colis.status as status', 
              'zones.zonename as liv_zone'
              
              )
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BPZ = bon_payment_zones.id_BPZ) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BPZ = bon_payment_zones.id_BPZ) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id_BPZ', $id)
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
        return $dompdf->stream('bon-' . $bon->id_BPZ . '.pdf');
    }

}
