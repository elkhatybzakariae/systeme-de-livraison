<?php

namespace App\Http\Controllers;

use App\Models\BonRetourClient;
use App\Models\Client;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Etat;
use App\Models\Option;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Writer;

class BonRetourClientController extends Controller
{
    public function index(Request $request, $id_BRC = null)
    {
        $id_Cl = $request->input('client');
        if ($id_Cl == null) {
            $id_Cl = session('client');
        } else {
            session(['client' => $id_Cl]);
        }
        $user = session('user');
        $colis = Colis::query()->with('ville')
            ->whereNull('id_BRC')
            ->where(
                'status',
                ['Recu par Centre Principale']
            )
            ->where('id_Cl', $id_Cl)
            ->get();

        $colisBon = [];
        if (!$id_BRC) {
            $bonLivraison = BonRetourClient::create([
                'id_BRC' => 'BRC-' . Str::random(10),
                'reference' => 'BRC-' . Str::random(10),
                'status' => 'Nouveau',
                'id_Cl' => $id_Cl,
            ]);
        } else {
            $bonLivraison = BonRetourClient::query()->with('colis')->where('id_BRC', $id_BRC)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BRC =?', [$id_BRC]);

        }
        $breads = [
            ['title' => 'créer un Bon retour client', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonRetourClient.index', compact("colis", "bonLivraison", 'colisBon', 'breads'));
    }
    public function list()
    {


        $bons = BonRetourClient::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'bon_retour_clients.id_Cl', '=', 'clients.id_Cl')
            ->select('bon_retour_clients.*', 'clients.nomcomplet as nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BRC = bon_retour_clients.id_BRC) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BRC = bon_retour_clients.id_BRC) as total_prix')) // Corrected table name (BL -> BD)
            ->leftJoin('colis', 'bon_retour_clients.id_BRC', '=', 'colis.id_BRC')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->get();
            
            $cl=Option::all();
            $etat=Etat::all();
        $breads = [
            ['title' => 'Liste des Bons de retour de client ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonRetourClient.list', compact("bons",'cl','etat', 'breads'));
    }
    public function getClientBons()
    {


        $bons = BonRetourClient::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'bon_retour_clients.id_Cl', '=', 'clients.id_Cl')
            ->select('bon_retour_clients.*', 'clients.nomcomplet as nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BRC = bon_retour_clients.id_BRC) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BRC = bon_retour_clients.id_BRC) as total_prix')) // Corrected table name (BL -> BD)
            ->leftJoin('colis', 'bon_retour_clients.id_BRC', '=', 'colis.id_BRC')
            ->with('colis', 'colis.ville')
            ->where('clients.id_Cl', session('user')['id_Cl'])
            ->distinct()
            ->get();
        
        $cl=Option::all();
        $etat=Etat::all();
        $breads = [
            ['title' => 'Liste des Bons de retour de client ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.bonRetourClient.list', compact("bons",'cl','etat', 'breads'));
    }
    public function create()
    {
        $clients = Client::withCount([
            'colis' => function ($query) {
                $query->where('status', 'Recu par Centre Principale');
            }
        ])->with(['colis'])->get();

        $breads = [
            ['title' => 'créer un Bon Retour Client', 'url' => null],
            ['text' => 'Bons', 'url' => null],
        ];
        return view('pages.admin.bonRetourClient.create', compact("clients", 'breads'));
    }

    public function destroy($id)
    {
        $bon = BonRetourClient::find($id);
        $bon->delete();
        return redirect()->route('bon.retour.client.list')->with('success', 'bon deleted successfully.');
    }
    public function update($id, $id_BRC)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BRC' => $id_BRC, 'status' => 'Expedier vers Client']);
        $coli = Colis::where('id', $id)->first();
        $colisinfo = colisinfo::where('id', $id)->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Expedier vers Client,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.retour.client.list', $id_BRC);
    }
    public function recu($id_BRC)
    {
        Colis::where('id_BRC', $id_BRC)
            ->update(['status' => 'Recu par Client']);
        BonRetourClient::where('id_BRC', $id_BRC)
            ->update(['status' => 'Recu']);
        $coli = Colis::where('id_BRC', $id_BRC)->first();
        $colisinfo = colisinfo::where('id', $coli['id'])->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Recu par Client,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.retour.client.list');
    }
    public function updateDelete($id, $id_BRC)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BRC' => null, 'status' => 'Recu par Centre Principale']);

        // dd($colis);
        return redirect()->route('bon.retour.client.index', $id_BRC);
    }


    public function updateAll(Request $request, $id_BRC)
    {
        // dd($request->input('query'));
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BRC' => $id_BRC, 'status' => 'Expedier vers Client']);
        } else {


            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BRC' => $id_BRC, 'status' => 'Expedier vers Client']);
            }
        }
        return redirect()->route('bon.retour.client.index', $id_BRC);
    }
    public function updateDeleteAll(Request $request, $id_BRC)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BRC' => null, 'status' => 'Recu par Centre Principale']);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BRC' => null, 'status' => 'Recu par Centre Principale']);
            }
        }
        return redirect()->route('bon.retour.client.index', $id_BRC);
    }
    public function exportColis($id_BRC)
    {
        $colis = Colis::where('id_BRC', $id_BRC)->get();
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
        $fileName = 'colis_' . $id_BRC . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }
    public function getPdf($id)
    {
        // $bon = BonDistribution::where('id_BRC', $id)->first();
        $bon = BonRetourClient::where('bon_retour_clients.id_BRC', $id) // Specify the table for id_BRC
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            // ->leftJoin('livreurs', 'bon_retour_clients.id_Liv', '=', 'livreurs.id_Liv')
            // ->leftJoin('zones', 'bon_retour_clients.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_retour_clients.id_BRC', '=', 'colis.id_BRC')
            ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
            ->select('bon_retour_clients.*',
            //  'livreurs.nomcomplet as liv_nom',
            //   'livreurs.fraislivraison as frais', 
            //   'livreurs.Phone as liv_tele', 
              'clients.nomcomplet as nomcomplet', 
              'colis.status as status', 
            //   'zones.zonename as liv_zone'
              
              )
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BRC = bon_retour_clients.id_BRC) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BRC = bon_retour_clients.id_BRC) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id_BRC', $id)
        ->with('client','BRZ',)
        ->get();
        // dd($colis[0]->bonPaymentLivreur->livreur->fraislivraison);
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
        $dompdf = new Dompdf();
        $html = view('pages.admin.bonRetourClient.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BRC . '.pdf');
    }
}
