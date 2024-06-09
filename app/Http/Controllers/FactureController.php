<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Client;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Facture;
use App\Models\Frais;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Writer;

class FactureController extends Controller
{
    public function index(Request $request, $id_F = null)
    {
        $id_Cl = $request->input('client');
        if ($id_Cl == null) {
            $id_Cl = session('client');
        } else {
            session(['client' => $id_Cl]);
        }
        $user = session('admin');
        $colis = Colis::query()->with('ville')
            ->whereNull('id_F')
            ->where('status', 'Livre')
            ->where('etat', 'Paye')
            // ->whereNot('id_BPZ',null)
            ->where('id_Cl', $id_Cl)
            ->get();
        $colisBon = [];
        if (!$id_F) {
            $bonLivraison = Facture::create([
                'id_F' => 'Fac-' . Str::random(10),
                'reference' => 'Fac-' . Str::random(10),
                'date_paiment' => now(),
                'id_Cl' => $id_Cl,
                'id_Ad' => session('admin')['id_Ad'],
            ]);
        } else {
            $bonLivraison = Facture::query()->with('colis')->where('id_F', $id_F)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_F =?', [$id_F]);
        }
        $frais=Frais::query()->where('id_F',$bonLivraison->id_F)->get();
        $breads = [
            ['title' => 'créer un Facture', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.Factures.index', compact("colis", "bonLivraison", 'colisBon', 'breads','frais'));
    }
    public function list()
    {


        $bons = Facture::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'factures.id_Cl', '=', 'clients.id_Cl')
            ->select('factures.*', 'clients.nomcomplet as nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_F = factures.id_F) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_F = factures.id_F) as total_prix'))
            ->leftJoin('colis', 'factures.id_F', '=', 'colis.id_F')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();
        $breads = [
            ['title' => 'Liste des Factures ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.Factures.list', compact("bons", 'breads'));
    }
    public function getClientBons()
    {


        $bons = Facture::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'factures.id_Cl', '=', 'clients.id_Cl')
            ->select('factures.*', 'clients.nomcomplet as nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_F = factures.id_F) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_F = factures.id_F) as total_prix')) // Corrected table name (BL -> BD)
            ->leftJoin('colis', 'factures.id_F', '=', 'colis.id_F')
            ->with('colis', 'colis.ville')
            ->where('clients.id_Cl', session('client')['id_Cl'])
            ->distinct()
            ->orderBy('created_at', 'desc')

            ->get();
        // $bons=Facture::all();
        // dd($bons);
        $breads = [
            ['title' => 'Liste des Factures ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.Factures.list', compact("bons", 'breads'));
    }
    public function create()
    {

        $clients = Client::whereHas('colis', function ($query) {
            $query->where('status', 'Livre')
                ->where('etat', 'Paye')
                ->whereNotNull('id_BPZ')
                ->whereHas('bonPaymentZone', function ($queryBPZ) {
                    $queryBPZ->where('status', 'Paye');
                })
                ;
        })
        // select('clients.*')
        //     ->leftJoin('colis', 'clients.id_Cl', 'colis.id_Cl')
        //     ->where('colis.status', 'Livre')
        //     ->where('colis.etat', 'Paye')
            // ->whereNotNull('colis.id_BPZ')
            ->withCount(['colis as colis_count' => function ($query) {
                $query->where('status', 'Livre')
                    ->where('etat', 'Paye')
                    // ->whereNotNull('id_BPZ')
                ;
            }])->distinct()
            ->get();

        $breads = [
            ['title' => 'Créer un Facture', 'url' => null],
            ['text' => 'Bons', 'url' => null],
        ];
        return view('pages.admin.Factures.create', compact("clients", 'breads'));
    }
    public function store(Request $request,$id_F)
{
    
    $request->validate([
        'title' => 'required|string|max:255',
        'quntite' => 'required|integer',
        'prix' => 'required|numeric',
    ]);
    // dd($request);
    $facture = Frais::create([
        'id_Fr' => 'Frais'. Str::random(10),
        'title' => $request->title,
        'quntite' => $request->quntite,
        'prix' => $request->prix,
        'id_F' => $id_F,
    ]);
    return redirect()->route('factures.index', $id_F);
    
}
public function deleteFrais($id)
{
    $bon = Frais::find($id);
    $bon->delete();
    return redirect()->route('factures.index',$bon->id_F)->with('success', 'Frais deleted successfully.');
}

    public function destroy($id)
    {
        $bon = Facture::find($id);
        $bon->delete();
        return redirect()->route('factures.list')->with('success', 'bon deleted successfully.');
    }
    public function update($id, $id_F)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_F' => $id_F, 'etat' => 'Facture']);

        // $coli = Colis::find($id);
        // $colisinfo = colisinfo::where('id', $id)->first();
        // $oldinfo = $colisinfo['info'];
        // $newInfo = $oldinfo . $coli['code_d_envoi'] . $coli['etat'] . $coli['status'] .  $coli['updated_at'] . ',' . ' ' . '_';
        // $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('factures.index', $id_F);
    }
    public function recu($id_F)
    {
      
        Facture::where('id_F', $id_F)
            ->update(['status' => 'Enregistre']);
        
        return redirect()->route('factures.list');
    }
    public function paye($id_F)
    {
        Colis::where('id_F', $id_F)
            ->update(['etat' => 'Paye a Client']);
        Facture::where('id_F', $id_F)
            ->update(['status' => 'Paye']);
        
        return redirect()->route('factures.list');
    }
    public function updateDelete($id, $id_F)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_F' => null, 'etat' => 'Paye']);
        // $coli = Colis::find($colis->id);

        // $colisinfo = colisinfo::where('id', $colis->id)->first();
        // $oldinfo = $colisinfo['info'];
        // $newInfo = $oldinfo . $coli['code_d_envoi'] . $coli['etat'] . $coli['status'] .  $coli['updated_at'] . ',' . ' ' . '_';

        // $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('factures.index', $id_F);
    }


    public function updateAll(Request $request, $id_F)
    {
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_F' => $id_F, 'etat' => 'Facture']);
            // $coli = Colis::find($colis->id);

            // $colisinfo = colisinfo::where('id', $colis->id)->first();
            // $oldinfo = $colisinfo['info'];
            // $newInfo = $oldinfo . $coli['code_d_envoi'] . $coli['etat'] . $coli['status'] .  $coli['updated_at'] . ',' . ' ' . '_';

            // $colisinfo->update(['info' => $newInfo]);
        } else {
            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_F' => $id_F, 'etat' => 'Facture']);
                // $coli = Colis::find($colis->id);

                // $colisinfo = colisinfo::where('id', $colis->id)->first();
                // $oldinfo = $colisinfo['info'];
                // $newInfo = $oldinfo . $coli['code_d_envoi'] . $coli['etat'] . $coli['status'] .  $coli['updated_at'] . ',' . ' ' . '_';

                // $colisinfo->update(['info' => $newInfo]);
            }
        }
        return redirect()->route('factures.index', $id_F);
    }
    public function updateDeleteAll(Request $request, $id_F)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_F' => null, 'etat' => 'Paye']);
            // $coli = Colis::find($colis->id);

            // $colisinfo = colisinfo::where('id', $colis->id)->first();
            // $oldinfo = $colisinfo['info'];
            // $newInfo = $oldinfo . $coli['code_d_envoi'] . $coli['etat'] . $coli['status'] .  $coli['updated_at'] . ',' . ' ' . '_';

            // $colisinfo->update(['info' => $newInfo]);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_F' => null, 'etat' => 'Paye']);
                // $coli = Colis::find($colis->id);

                // $colisinfo = colisinfo::where('id', $colis->id)->first();
                // $oldinfo = $colisinfo['info'];
                // $newInfo = $oldinfo . $coli['code_d_envoi'] . $coli['etat'] . $coli['status'] .  $coli['updated_at'] . ',' . ' ' . '_';

                // $colisinfo->update(['info' => $newInfo]);
            }
        }
        return redirect()->route('factures.index', $id_F);
    }
    public function exportColis($id_F)
    {
        $colis = Colis::where('id_F', $id_F)->get();
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
        $fileName = 'colis_' . $id_F . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }
    public function getPdf($id)
    {
        // $bon = Facture::where('id_F', $id)->first();
        $bon = Facture::where('factures.id_F', $id) 
            ->withCount('colis') 
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'factures.id_Cl', '=', 'clients.id_Cl')
            ->leftJoin('frais', 'factures.id_F', '=', 'frais.id_F')
            ->leftJoin('colis', 'factures.id_F', '=', 'colis.id_F')
            ->leftJoin('bon_payment_livreurs', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
            ->leftJoin('livreurs', 'bon_payment_livreurs.id_Liv', '=', 'livreurs.id_Liv')
            ->select('factures.*', 'clients.*', 'clients.Phone as telephone',
            // DB::raw('SUM(frais.prix * frais.quntite) AS autre_frais'),
            )
            ->addSelect(DB::raw('(SELECT SUM(frais.prix * frais.quntite) FROM frais WHERE frais.id_F = factures.id_F) as autre_frais'))
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_F = factures.id_F) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_F = factures.id_F) as prix_total'))
             // Corrected table name (BL -> BD)
            ->addSelect( DB::raw('(SELECT SUM(livreurs.fraislivraison) FROM livreurs 
            JOIN bon_payment_livreurs ON bon_payment_livreurs.id_Liv = livreurs.id_Liv 
            JOIN colis ON colis.id_BPL = bon_payment_livreurs.id_BPL 
            WHERE colis.id_F = factures.id_F) as frais')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

            $colis = Colis::query()->where('id_F', $id)
            // ->with('ville')
            ->leftJoin('bon_payment_livreurs', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
            ->leftJoin('livreurs', 'bon_payment_livreurs.id_Liv', '=', 'livreurs.id_Liv')
            ->leftJoin('villes', 'villes.id_V', '=', 'colis.ville_id')
            ->select(
                'colis.*',
                'villes.villename',
                'livreurs.fraislivraison'
            )
            ->get();
            // dd($colis);
        $img = Helpers::base64Image();
        $data = [
            'bon' => $bon,
            'colis' => $colis,
            'img'=>$img
        ];
        
        $dompdf = new Dompdf();
        $html = view('pages.admin.Factures.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        $dompdf->render();
        return $dompdf->stream('bon' . $bon->id_F . '.pdf');
    }
  
}
