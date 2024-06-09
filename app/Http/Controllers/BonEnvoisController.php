<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\BonEnvois;
use App\Models\BonLivraison;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Etat;
use App\Models\Option;
use App\Models\Zone;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Writer;
use PDF;

class BonEnvoisController extends Controller
{
    public function index(Request $request, $id_BE = null)
    {
        $id_Z = $request->input('zone');
        if ($id_Z == null) {
            $id_Z = session('zone');
        } else {
            session(['zone' => $id_Z]);
        }
        $user = session('admin');
        $colis = Colis::query()->with('ville')
            ->whereNull('id_BE')->where('status', 'Ramasse')
            ->where('zone', $id_Z)->get();

        $colisBon = [];
        if (!$id_BE) {
            if ($user) {
                $bonLivraison = BonEnvois::create([
                    'id_BE' => 'BE-' . Str::random(12),
                    'reference' => 'BE-' . Str::random(10),
                    'status' => 'Nouveau',
                    // 'id_Cl'=>$user['id_Cl']
                ]);
            } else {
                return redirect(route('auth.client.signIn'));
            }
        } else {
            $bonLivraison = BonEnvois::query()->with('colis')->where('id_BE', $id_BE)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BE =?', [$id_BE]);
            // dd($colisBon)  ;

        }
        // dd($colis,$colisBon);
        $breads = [
            ['title' => 'créer un Bon Envoi', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonEnvoi.index', compact("colis", "bonLivraison", 'colisBon', 'breads'));
    }
    public function list()
    {
        

        $bons = BonEnvois::select(
            'bon_envois.id_BE',
            'bon_envois.reference',
            'bon_envois.status',
            'bon_envois.created_at',
            'clients.nomcomplet as client_nomcomplet',
        )
            ->withCount('colis') // Count the number of related colis
            ->withSum('colis', 'prix') // Sum the prices of related colis
            ->leftJoin('colis', 'bon_envois.id_BE', '=', 'colis.id_BE')
            ->leftJoin('clients', 'colis.id_Cl', '=', 'clients.id_Cl')
            ->with('colis', 'colis.ville')
            ->orderBy('created_at','desc')
            ->distinct()
            ->get();

            $cl=Option::all();
            $etat=Etat::all();
        $breads = [
            ['title' => 'Liste des Bons d\'Envoi', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonEnvoi.list', compact("bons",'cl','etat', 'breads'));
    }
    public function create()
    {
       

        $zones = Zone::withCount([
            'colis' => function ($query) {
                $query->where('status', 'Ramasse')
            ->orderBy('created_at','desc') ;
            }
        ])->get();
        $breads = [
            ['title' => 'créer un Bon Envoi', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        // dd($zones);
        return view('pages.admin.bonEnvoi.create', compact("zones", 'breads'));
    }
    public function destroy($id)
    {
        $bon = BonEnvois::find($id);
        $bon->delete();
        return redirect()->route('bon.envoi.list')->with('success', 'bon deleted successfully.');
    }
    public function update($id, $id_BE)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BE' => $id_BE, 'status' => 'Expedie']);
        $coli = Colis::where('id', $id)->first();
        $colisinfo = colisinfo::where('id', $id)->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Expedie,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.envoi.index', $id_BE);
    }
    public function recu($id_BE)
    {
        Colis::where('id_BE', $id_BE)
            ->update(['status' => 'Recu']);
        BonEnvois::where('id_BE', $id_BE)
            ->update(['status' => 'Recu']);
        $coli = Colis::where('id_BE', $id_BE)->first();
        $colisinfo = colisinfo::where('id', $coli['id'])->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Recu,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.envoi.list');
    }
    public function nonrecu($id_BE)
    {
        Colis::where('id_BE', $id_BE)
            ->update(['status' => 'Expedie']);
        BonEnvois::where('id_BE', $id_BE)
            ->update(['status' => 'Nouveau']);
        $coli = Colis::where('id_BE', $id_BE)->first();
        $colisinfo = colisinfo::where('id', $coli['id'])->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Expedie,' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.envoi.list');
    }

    public function updateDelete($id, $id_BE)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BE' => null, 'status' => 'Ramasse']);

        // dd($colis);
        return redirect()->route('bon.envoi.index', $id_BE);
    }

    public function updateAll(Request $request, $id_BE)
    {
        // dd($request->input('query'));
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BE' => $id_BE, 'status' => 'Expedie']);
        } else {


            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BE' => $id_BE, 'status' => 'Expedie']);
            }
        }
        return redirect()->route('bon.envoi.index', $id_BE);
    }
    public function updateDeleteAll(Request $request, $id_BE)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BE' => null, 'status' => 'Ramasse']);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BE' => null, 'status' => 'Ramasse']);
            }
        }
        return redirect()->route('bon.envoi.index', $id_BE);
    }
    public function exportColis($id_BE)
    {
        $colis = Colis::where('id_BE', $id_BE)->get();
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
        $fileName = 'colis_' . $id_BE . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }

    public function getPdfColis($id,$idC)
    {
        $bon = BonEnvois::where('bon_envois.id_BE', $id) // Specify the table for id_BL
            ->withCount('colis') 
            ->withSum('colis', 'prix')
            // ->leftJoin('clients', 'clients.id_Cl', '=', 'bon_envois.id_Cl')
            ->leftJoin('colis', 'bon_envois.id_BE', '=', 'colis.id_BE')
            // ->select('clients.nomcomplet as nomcomplet','clients.Phone as telephone','bon_envois.*')
             ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BE = bon_envois.id_BE) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BE = bon_envois.id_BE) as prix_total')) // Corrected table name (BL -> BD)
            ->first();
            // dd($bon);
        $colis = Colis::query()->where('id', $idC)
        ->with('client')
        ->get();
        // dd($colis);
        $img = Helpers::base64Image();
        $data = [
            'bon' => $bon,
            'colis' => $colis,
            'img'=>$img
        ];
        $dompdf = new Dompdf();
        
        $html = view('pages.admin.bonEnvoi.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BE . '.pdf');
    }
    public function getPdf($id)
    {
        $bon = BonEnvois::where('bon_envois.id_BE', $id) // Specify the table for id_BL
            ->withCount('colis') 
            ->withSum('colis', 'prix')
            // ->leftJoin('clients', 'clients.id_Cl', '=', 'bon_envois.id_Cl')
            ->leftJoin('colis', 'bon_envois.id_BE', '=', 'colis.id_BE')
            // ->select('clients.nomcomplet as nomcomplet','clients.Phone as telephone','bon_envois.*')
             ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BE = bon_envois.id_BE) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BE = bon_envois.id_BE) as prix_total')) // Corrected table name (BL -> BD)
            ->first();
            // dd($bon);
        $colis = Colis::query()->where('id_BE', $id)
        ->with('client')
        ->get();
        // dd($colis);
        $img = Helpers::base64Image();
        $data = [
            'bon' => $bon,
            'colis' => $colis,
            'img'=>$img
        ];
        $dompdf = new Dompdf();
        
        $html = view('pages.admin.bonEnvoi.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BE . '.pdf');
    }
}
