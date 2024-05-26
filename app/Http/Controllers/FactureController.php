<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Facture;
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
        $user = session('user');
        $colis = Colis::query()->with('ville')
            ->whereNull('id_F')
            ->where('status','livre')
            ->where('etat','paye')
            // ->whereNot('id_BPZ',null)
            ->where('id_Cl', $id_Cl)
            ->get();
        // dd($colis);
        $colisBon = [];
        if (!$id_F) {
            $bonLivraison = Facture::create([
                'id_F' => 'BRC-' . Str::random(10),
                'reference' => 'BRC-' . Str::random(10),
                'status' => 'Nouveau',
                'date_paiment' => now(),
                'id_Cl' => $id_Cl,
                'id_Ad' => session('user')['id_Ad'],
            ]);
        } else {
            $bonLivraison = Facture::query()->with('colis')->where('id_F', $id_F)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_F =?', [$id_F]);

        }
        $breads = [
            ['title' => 'créer un Facture', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.Factures.index', compact("colis", "bonLivraison", 'colisBon', 'breads'));
    }
    public function list()
    {


        $bons = Facture::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'factures.id_Cl', '=', 'clients.id_Cl')
            ->select('factures.*', 'clients.nomcomplet as nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_F = factures.id_F) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_F = factures.id_F) as total_prix')) // Corrected table name (BL -> BD)
            ->leftJoin('colis', 'factures.id_F', '=', 'colis.id_F')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->orderBy('created_at','desc')
            ->get();
        $breads = [
            ['title' => 'Liste des Bons de retour de client ', 'url' => null],
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
            ->where('clients.id_Cl', session('user')['id_Cl'])
            ->distinct()            
            ->orderBy('created_at','desc')

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
       
            $clients = Client::select('clients.*')
            ->leftJoin('colis', 'clients.id_Cl', 'colis.id_Cl')
            ->where('colis.status', 'livre')
            ->where('colis.etat', 'paye')
            // ->whereNotNull('colis.id_BPZ')
            ->withCount(['colis as colis_count' => function ($query) {
                $query->where('status', 'livre')
                    ->where('etat', 'paye')
                    // ->whereNotNull('id_BPZ')
                    ;
            }])
            ->get();
        
        $breads = [
            ['title' => 'Créer un Facture', 'url' => null],
            ['text' => 'Bons', 'url' => null],
        ];
        return view('pages.admin.Factures.create', compact("clients", 'breads'));
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
            ->update(['id_F' => $id_F, 'status' => 'Expedier vers Client']);

        $coli = Colis::find($id);

        $colisinfo = colisinfo::where('id', $id)->first();
        dd($colisinfo);
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',non paye,Expedier vers Client,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('factures.index', $id_F);
    }
    public function recu($id_F)
    {
        Colis::where('id_F', $id_F)
            ->update(['status' => 'Recu par Client']);
        Facture::where('id_F', $id_F)
            ->update(['status' => 'Recu']);
        $coli = Colis::where('id_F', $id_F)->first();
        $colisinfo = colisinfo::where('id', $coli['id'])->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',non paye,Recu par Client,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('factures.list');
    }
    public function updateDelete($id, $id_F)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_F' => null, 'status' => 'Recu par Centre Principale']);

        // dd($colis);
        return redirect()->route('factures.index', $id_F);
    }


    public function updateAll(Request $request, $id_F)
    {
        // dd($request->input('query'));
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_F' => $id_F, 'status' => 'Expedier vers Client']);
        } else {


            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_F' => $id_F, 'status' => 'Expedier vers Client']);
            }
        }
        return redirect()->route('factures.index', $id_F);
    }
    public function updateDeleteAll(Request $request, $id_F)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_F' => null, 'status' => 'Recu par Centre Principale']);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_F' => null, 'status' => 'Recu par Centre Principale']);
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
        $bon = Facture::where('factures.id_F', $id) // Specify the table for id_F
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'factures.id_Liv', '=', 'clients.id_Liv')
            ->leftJoin('zones', 'factures.id_Cl', '=', 'zones.id_Cl')
            ->leftJoin('colis', 'factures.id_F', '=', 'colis.id_F')
            ->select('factures.*', 'clients.nomcomplet as liv_nom', 'clients.Phone as liv_tele', 'zones.zonename as liv_zone')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_F = factures.id_F) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_F = factures.id_F) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id_F', $id)->get();
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
        $dompdf = new Dompdf();
        // 
        //     // Load the HTML content into Dompdf
        $html = view('pages.admin.Factures.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon' . $bon->id_F . '.pdf');
    }

}
