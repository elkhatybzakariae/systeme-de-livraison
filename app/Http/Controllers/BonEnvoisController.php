<?php

namespace App\Http\Controllers;

use App\Models\BonEnvois;
use App\Models\BonLivraison;
use App\Models\Colis;
use App\Models\Zone;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Writer;

class BonEnvoisController extends Controller
{
    public function index(Request $request ,$id_BE=null) 
    {
        $id_Z = $request->input('zone');
        if($id_Z == null){
            $id_Z=session('zone');
        }else{
            session(['zone'=>$id_Z]);
        }
        // dd(session('zone'));
        $user=session('user');
        $colis =Colis::query()->with('ville')->whereNull('id_BE')->where('zone',$id_Z)->get();

        $colisBon=[];
        // dd($colis);
        if (!$id_BE) {
            if($user ){
                $bonLivraison= BonEnvois::create([
                    'id_BE'=>'BE-'.Str::random(12),
                    'reference'=>'BE-'.Str::random(10),
                    'status'=>'nouveau',
                    // 'id_Cl'=>$user['id_Cl']
                ]);
            }else{
                return redirect(route('auth.client.signIn'));
            }
        }else{
            $bonLivraison= BonEnvois::query()->with('colis')->where('id_BE',$id_BE)->first();
            $colisBon= DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BE =?',[$id_BE]);
        // dd($colisBon)  ;

        }
        // dd($colis,$colisBon);
        $breads = [
            ['title' => 'créer un Bon Envoi', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonEnvoi.index',compact("colis", "bonLivraison",'colisBon','breads'));
    }
    public function list()
    {
        $user=session('user');
        if(!$user){
            return redirect(route('auth.admin.signIn'));
        }
   
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
            ->with('colis','colis.ville')
            ->distinct()
            ->get();

    // $bons=BonEnvois::all();
    // dd($bons);
    $breads = [
        ['title' => 'Liste des Bons d\'Envoi', 'url' => null],
        ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
    ];
        return view('pages.admin.bonEnvoi.list',compact("bons",'breads'));
    } 
    public function create()
    {
        $user=session('user');
        if(!$user){
            return redirect(route('auth.client.signIn'));
        }

  
$zones = Zone::whereHas('colis', function ($query) {
    $query->where('status', 'recu');
})->with('colis')->withCount('colis')->get();

        

        $breads = [
            ['title' => 'créer un Bon Envoi', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        // dd($zones);
        return view('pages.admin.bonEnvoi.create',compact("zones",'breads'));
    } 
       
    public function update($id,$id_BE)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BE' => $id_BE,'status'=>'distribution']);
        return redirect()->route('bon.envoi.index',$id_BE);
    }    
    public function updateDelete($id,$id_BE)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BE' => null]);

        // dd($colis);
        return redirect()->route('bon.envoi.index',$id_BE);
    
    }  
     
    public function updateAll(Request $request,$id_BE)
    {
        // dd($request);
        foreach($request->colis as $colis){

            $colis = Colis::where('id', $colis)
            ->update(['id_BE' => $id_BE]);
        }
        return redirect()->route('bon.envoi.index',$id_BE);
    }    
    public function updateDeleteAll(Request $request,$id_BE)
    {
        foreach($request->colisDelete as $colis){

            $colis = Colis::where('id', $colis)
            ->update(['id_BE' => null]);
        }
        return redirect()->route('bon.envoi.index',$id_BE);
    
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
    
    public function getPdf($id)
    {
        $bon = BonEnvois::where('id_BE', $id)->first();
        $colis = Colis::query()->where('id_BE', $id)->get();
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
//         $pdf = PDF::loadView();
        $dompdf = new Dompdf();
// 
//     // Load the HTML content into Dompdf
        $html = view('pages.admin.bonEnvoi.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon'.$bon->id_BE . '.pdf');
    }
}
