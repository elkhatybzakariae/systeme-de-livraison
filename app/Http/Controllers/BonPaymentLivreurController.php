<?php

namespace App\Http\Controllers;

use App\Models\BonPaymentLivreur;
use App\Models\Colis;
use App\Models\Zone;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Writer;

class BonPaymentLivreurController extends Controller
{

    public function index(Request $request, $id_BPL = null)
    {
        $id_Z = $request->input('zone');
        if ($id_Z == null) {
            $id_Z = session('zone');
        } else {
            session(['zone' => $id_Z]);
        }
        $user = session('user');
        // $colis = Colis::query()->with('ville')->whereNull('id_BPL')->where('zone', $id_Z)->get();
        $colis = Colis::query()
            ->with('ville')
            ->whereNull('id_BPL')
            ->where('zone', $id_Z)
            ->where('status', 'Livre')
            ->get();

        $colisBon = [];
        if (!$id_BPL) {
            // dd($id_BPL);
            if ($user) {
                $bon = BonPaymentLivreur::create([
                    'id_BPL' => 'BPL-' . Str::random(10),
                    'reference' => 'BPL-' . Str::random(10),
                    'status' => 'Nouveau',
                    'id_Z' => $id_Z,
                    'id_Liv' => $request->id_Liv,
                ]);
            } else {
                return redirect(route('auth.client.signIn'));
            }
        } else {
            $bon = BonPaymentLivreur::query()->with('colis')->where('id_BPL', $id_BPL)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BPL =?', [$id_BPL]);
            // dd($colisBon)  ;

        }
        $breads = [
            ['title' => 'créer un Bon payment pour livreur', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonPaymentLivreur.index', compact("colis", "bon", 'colisBon', 'breads'));
    }
    public function list()
    {
        $user = session('user');
        if (!$user) {
            return redirect(route('auth.admin.signIn'));
        }
        $bons = BonPaymentLivreur::select(
            'bon_payment_livreurs.id_BPL',
            'bon_payment_livreurs.reference',
            'bon_payment_livreurs.status',
            'bon_payment_livreurs.created_at',
            'livreurs.nomcomplet as nomComplet',
            'zones.zonename as zone',

        )
            ->withCount('colis') // Count the number of related colis
            ->withSum('colis', 'prix') // Sum the prices of related colis
            ->leftJoin('zones', 'bon_payment_livreurs.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
            ->leftJoin('livreurs', 'bon_payment_livreurs.id_Liv', '=', 'livreurs.id_Liv')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->orderBy('created_at','desc')

            ->get();
        // $bons=BonPaymentLivreur::all();
        // dd($bons);
        $breads = [
            ['title' => 'Liste des Bons de payment livreur ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonPaymentLivreur.list', compact("bons", 'breads'));
    }
    public function create()
    {
        $user = session('user');

        // $zones = Zone::whereHas('colis', function ($query) {
        //     $query->where('status', 'livre');
        // })
        //     ->with(['colis', 'livreurs'])
        //     ->withCount('colis')
        //     ->get();
        // $zones = Zone::with([
        //     'colis' => function ($query) {
        //         $query->where('status', 'livre');
        //     },
        //     'livreurs'
        // ])
        // ->withCount('colis')
        // ->get();
        // $zones = Zone::whereHas('colis', function ($query) {
        //     $query->where(['status'=>'Livre','etat'=>'Paye']);
        // })
        //     ->with([
        //         'colis' => function ($query) {
        //             $query->where(['status'=>'Livre','etat'=>'Paye']);
        //         },
        //         'livreurs'
        //     ])
        //     ->withCount('colis')->distinct()
        //     ->get();
        $zones = Zone::whereHas('colis', function ($query) {
            $query->where(['status' => 'Livre', 'etat' => 'Paye']);
        })
        ->with([
            'colis' => function ($query) {
                $query->where(['status' => 'Livre', 'etat' => 'Paye']);
            },
            'livreurs'
        ])
        ->withCount(['colis' => function ($query) {
            $query->where(['status' => 'Livre', 'etat' => 'Paye']);
        }])
        ->distinct('zones.id') // Assuming 'id' is the primary key in 'zones' table
        ->get();

        // dd($zones);

        $breads = [
            ['title' => 'créer un Bon Payement', 'url' => null],
            ['text' => 'Bons', 'url' => null],
        ];
        return view('pages.admin.bonPaymentLivreur.create', compact("zones", 'breads'));
    }

    public function destroy($id)
    {
        $bon = BonPaymentLivreur::find($id);
        $bon->delete();
        return redirect()->route('bon.payment.livreur.list')->with('success', 'bon deleted successfully.');
    }
    public function update($id, $id_BPL)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BPL' => $id_BPL]);
        return redirect()->route('bon.payment.livreur.index', $id_BPL);
    }
    public function updateDelete($id, $id_BPL)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BPL' => null]);

        // dd($colis);
        return redirect()->route('bon.payment.livreur.index', $id_BPL);
    }


    public function updateAll(Request $request, $id_BPL)
    {
        // dd($request->input('query'));
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BPL' => $id_BPL]);
        } else {


            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BPL' => $id_BPL]);
            }
        }
        return redirect()->route('bon.payment.livreur.index', $id_BPL);
    }
    public function updateDeleteAll(Request $request, $id_BPL)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BPL' => null]);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BPL' => null]);
            }
        }
        return redirect()->route('bon.payment.livreur.index', $id_BPL);
    }

    public function recu($id_BPL)
    {
        BonPaymentLivreur::where('id_BPL', $id_BPL)
            ->update(['status' => 'Paye']);
        return back();
    }
    public function nonrecu($id_BPL)
    {
        BonPaymentLivreur::where('id_BPL', $id_BPL)
            ->update(['status' => 'Nouveau']);
        return back();
    }
    public function encours($id_BPL)
    {
        BonPaymentLivreur::where('id_BPL', $id_BPL)
            ->update(['status' => 'en cours']);
        return back();
    }

    
    public function exportColis($id_BPL)
    {
        $colis = Colis::where('id_BPL', $id_BPL)->get();
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
        $fileName = 'colis_' . $id_BPL . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }
    public function getPdfColis($id,$idC)
    {
        // $bon = BonDistribution::where('id_BPL', $id)->first();
        $bon = BonPaymentLivreur::where('bon_payment_livreurs.id_BPL', $id) // Specify the table for id_BPL
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('livreurs', 'bon_payment_livreurs.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('zones', 'bon_payment_livreurs.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
            ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
            ->select('bon_payment_livreurs.*',
             'livreurs.nomcomplet as liv_nom',
              'livreurs.fraislivraison as frais', 
              'livreurs.Phone as liv_tele', 
              'clients.nomcomplet as nomcomplet', 
              'colis.status as status', 
              'zones.zonename as liv_zone'
              
              )
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BPL = bon_payment_livreurs.id_BPL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BPL = bon_payment_livreurs.id_BPL) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()
        ->where('id', $idC)
        ->with('client')
        ->get();
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
        $dompdf = new Dompdf();
        $html = view('pages.admin.bonPaymentLivreur.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BPL . '.pdf');
    }
    public function getPdf($id)
    {
        // $bon = BonDistribution::where('id_BPL', $id)->first();
        $bon = BonPaymentLivreur::where('bon_payment_livreurs.id_BPL', $id) // Specify the table for id_BPL
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('livreurs', 'bon_payment_livreurs.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('zones', 'bon_payment_livreurs.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
            ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
            ->select('bon_payment_livreurs.*',
             'livreurs.nomcomplet as liv_nom',
              'livreurs.fraislivraison as frais', 
              'livreurs.Phone as liv_tele', 
              'clients.nomcomplet as nomcomplet', 
              'colis.status as status', 
              'zones.zonename as liv_zone'
              
              )
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BPL = bon_payment_livreurs.id_BPL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BPL = bon_payment_livreurs.id_BPL) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id_BPL', $id)
        ->with('client')
        ->get();
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
        $dompdf = new Dompdf();
        $html = view('pages.admin.bonPaymentLivreur.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BPL . '.pdf');
    }


    public function livreurBP()
    {
        $liv = Auth::id();

        $bons = BonPaymentLivreur::select(
            'bon_payment_livreurs.id_BPL',
            'bon_payment_livreurs.reference',
            'bon_payment_livreurs.status',
            'bon_payment_livreurs.created_at',
            'livreurs.nomcomplet as nomComplet',
            'zones.zonename as zone',
        )
            ->withCount('colis') // Count the number of related colis
            ->withSum('colis', 'prix') // Sum the prices of related colis
            ->leftJoin('zones', 'bon_payment_livreurs.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
            ->leftJoin('livreurs', 'bon_payment_livreurs.id_Liv', '=', 'livreurs.id_Liv') // assuming 'id_Liv' is the foreign key in 'livreurs' table
            ->where('bon_payment_livreurs.id_Liv', $liv) // Filter by user ID
            ->with('colis', 'colis.ville')
            ->distinct() // Ensure unique results
            ->get();
        // $bons=BonPaymentLivreur::all();
        // dd($bons);
        $breads = [
            ['title' => 'Liste des Bons de payment ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.livreur.bonPaymentLivreur.list', compact("bons", 'breads'));
    }
}
