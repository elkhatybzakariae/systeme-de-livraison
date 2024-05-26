<?php

namespace App\Http\Controllers;

use App\Models\BonRetourZone;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Etat;
use App\Models\Option;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use Dompdf\Dompdf;

class BonRetourZoneController extends Controller
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
        $colis = Colis::query()->with('ville')->whereNull('id_BRZ')->where('zone', $id_Z)->get();

        $colisBon = [];
        if (!$id_BRZ) {
            $BonRetourZone = BonRetourZone::create([
                'id_BRZ' => 'BRC-' . Str::random(10),
                'reference' => 'BRC-' . Str::random(10),
                'status' => 'Nouveau',
                'id_Z' => $id_Z,
            ]);
           
        } else {
            $BonRetourZone = BonRetourZone::query()->with('colis')->where('id_BRZ', $id_BRZ)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BRZ =?', [$id_BRZ]);
                }
        $breads = [
            ['title' => 'créer un Bon retour zone', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonRetourZone.index', compact("colis", "BonRetourZone", 'colisBon', 'breads'));
    }
    public function list()
    {
      

        $bons = BonRetourZone::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('zones', 'bon_retour_zones.id_Z', '=', 'zones.id_Z')
            ->select('bon_retour_zones.*', 'zones.zonename as zonename')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BRZ = bon_retour_zones.id_BRZ) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BRZ = bon_retour_zones.id_BRZ) as total_prix')) // Corrected table name (BL -> BD)
            ->leftJoin('colis', 'bon_retour_zones.id_BRZ', '=', 'colis.id_BRZ')
            ->with('colis', 'colis.ville')
            ->with('zone')
            ->distinct()
            ->get();
            
            $cl=Option::all();
            $etat=Etat::all();
        $breads = [
            ['title' => 'Liste des Bons de retour zone ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonRetourZone.list', compact("bons",'cl','etat', 'breads'));
    }
    public function getClientBons()
    {
      

        $bons = BonRetourZone::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('zones', 'bon_retour_zones.id_Z', '=', 'zones.id_Z')
            ->select('bon_retour_zones.*', 'zones.nomcomplet as nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BRZ = bon_retour_zones.id_BRZ) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BRZ = bon_retour_zones.id_BRZ) as total_prix')) // Corrected table name (BL -> BD)
            ->leftJoin('colis', 'bon_retour_zones.id_BRZ', '=', 'colis.id_BRZ')
            ->with('colis', 'colis.ville')
            ->where('zones.id_Z',session('user')['id_Z'])
            ->distinct()
            ->orderBy('created_at','desc')

            ->get();
        // $bons=BonRetourClient::all();
        // dd($bons);
        $breads = [
            ['title' => 'Liste des Bons de retour de client ', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.zones.bonRetourZone.list', compact("bons", 'breads'));
    }
    public function create()
    {     
        $zones = Zone::withCount([
            'colis' => function ($query) {
                $query->where('status', 'Recu par Centre Retour');
            }
        ])->with(['colis'])->get();
        $breads = [
            ['title' => 'créer un Bon de Retour Zone', 'url' => null],
            ['text' => 'Bons', 'url' => null],
        ];
        return view('pages.admin.bonRetourZone.create', compact("zones", 'breads'));
    }

    public function destroy($id)
    {
        $bon = BonRetourZone::find($id);
        $bon->delete();
        return redirect()->route('bon.retour.zone.list')->with('success', 'bon deleted successfully.');
    }
    public function update($id, $id_BRZ)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BRZ' => $id_BRZ, 'status' => 'Expedier vers Centre Principale']);
        $coli = Colis::where('id', $id)->first();
        $colisinfo = colisinfo::where('id', $id)->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Expedier vers Centre Principale,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.retour.zone.index', $id_BRZ);
    }
    public function recu($id_BRZ)
    {
        Colis::where('id_BRZ', $id_BRZ)
            ->update(['status' => 'Recu par Centre Principale']);
            BonRetourZone::where('id_BRZ', $id_BRZ)
            ->update(['status' => 'Recu']);
        $coli = Colis::where('id_BRZ', $id_BRZ)->first();
        $colisinfo = colisinfo::where('id', $coli['id'])->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Recu par Centre Principale,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.retour.zone.list');
    }
    public function nonrecu($id_BRZ)
    {
        Colis::where('id_BRZ', $id_BRZ)
            ->update(['status' => 'Recu par Centre Retour']);
            BonRetourZone::where('id_BRZ', $id_BRZ)
            ->update(['status' => 'Nouveau']);
        $coli = Colis::where('id_BRZ', $id_BRZ)->first();
        $colisinfo = colisinfo::where('id', $coli['id'])->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Recu par Centre Retour,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.retour.zone.list');
    }
    public function updateDelete($id, $id_BRZ)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BRZ' => null, 'status' => 'Recu par Centre Retour']);

        // dd($colis);
        return redirect()->route('bon.retour.zone.index', $id_BRZ);
    }


    public function updateAll(Request $request, $id_BRZ)
    {
        // dd($request->input('query'));
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BRZ' => $id_BRZ, 'status' => 'Expedier vers Centre Principale']);
        } else {


            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BRZ' => $id_BRZ, 'status' => 'Expedier vers Centre Principale']);
            }
        }
        return redirect()->route('bon.retour.zone.index', $id_BRZ);
    }
    public function updateDeleteAll(Request $request, $id_BRZ)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BRZ' => null, 'status' => 'Recu par Centre Retour']);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BRZ' => null, 'status' => 'Recu par Centre Retour']);
            }
        }
        return redirect()->route('bon.retour.zone.index', $id_BRZ);
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
    public function getPdfColis($id,$idC)
    {
        // $bon = BonDistribution::where('id_BRZ', $id)->first();
        $bon = BonRetourZone::where('bon_retour_zones.id_BRZ', $id) // Specify the table for id_BRZ
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix')
            ->leftJoin('zones', 'bon_retour_zones.id_Z', '=', 'zones.id_Z')
            ->leftJoin('colis', 'bon_retour_zones.id_BRZ', '=', 'colis.id_BRZ')
            ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
            ->select('bon_retour_zones.*',
              'clients.nomcomplet as nomcomplet', 
              'colis.status as status', 
              'zones.zonename as liv_zone'
              
              )
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BRZ = bon_retour_zones.id_BRZ) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BRZ = bon_retour_zones.id_BRZ) as prix_total')) // Corrected table name (BL -> BD)
            ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id', $idC)
        ->with('client','BRL')
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
    public function getPdf($id)
    {
        // $bon = BonDistribution::where('id_BRZ', $id)->first();
        $bon = BonRetourZone::where('bon_retour_zones.id_BRZ', $id) // Specify the table for id_BRZ
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
        ->with('client','BRL')
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
