<?php

namespace App\Http\Controllers;

use App\Models\BonDistribution;
use App\Models\Colis;
use App\Models\Zone;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BonDistributionController extends Controller
{
    public function index(Request $request ,$id_BD=null) 
    {
        // dd($request);
        $id_Z = $request->input('zone');
        if($id_Z == null){
            $id_Z=session('zone');
        }else{
            session(['zone'=>$id_Z]);
        }
        // dd(session('zone'));
        $user=session('user');
        $colis =Colis::query()->with('ville')->whereNull('id_BD')->where('zone',$id_Z)->get();

        $colisBon=[];
        // dd($colis);
        if (!$id_BD) {
            if($user ){
                $bonLivraison= BonDistribution::create([
                    'id_BD'=>'BD-'.Str::random(12),
                    'reference'=>'BD-'.Str::random(10),
                    'status'=>'nouveau',
                    'id_Z'=>$id_Z,
                    'id_Liv'=>$request->input('id_Liv'),
                ]);
            }else{
                return redirect(route('auth.client.signIn'));
            }
        }else{
            $bonLivraison= BonDistribution::query()->with('colis')->where('id_BD',$id_BD)->first();
            $colisBon= DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BD =?',[$id_BD]);
        // dd($colisBon)  ;

        }
        $breads = [
            ['title' => 'créer un Bon Distribution', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonDistribution.index',compact("colis", "bonLivraison",'colisBon','breads'));
    }
    public function list()
    {
        $user=session('user');
        if(!$user){
            return redirect(route('auth.admin.signIn'));
        }
        $bons = DB::table('bon_distributions')
        ->select(
            'bon_distributions.id_BD', 
            'bon_distributions.reference',  
            'bon_distributions.status', 
            'bon_distributions.created_at',
            'livreurs.nomcomplet as liv_nomcomplet',
            'zones.zonename as zone',
            DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BD = bon_distributions.id_BD) as colis_count'),
            DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BD = bon_distributions.id_BD) as total_prix')
        )
        ->leftJoin('colis', 'bon_distributions.id_BD', '=', 'colis.id_BD')
        ->leftJoin('livreurs', 'bon_distributions.id_Liv', '=', 'livreurs.id_Liv')
        ->leftJoin('zones', 'bon_distributions.id_Z', '=', 'zones.id_Z')
        ->get();
    // $bons=BonDistribution::all();
    // dd($bons);
    $breads = [
        ['title' => 'Liste des Bons de distributions ', 'url' => null],
        ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
    ];
        return view('pages.admin.bonDistribution.list',compact("bons",'breads'));
    } 
    public function create()
    {
        $user=session('user');
        if(!$user){
            return redirect(route('auth.client.signIn'));
        }

        $zones = Zone::whereHas('colis', function ($query) {
            $query->where('status', 'recu');
        })
        ->with(['colis', 'livreurs']) 
        ->withCount('colis')
        ->get();

        

        $breads = [
            ['title' => 'créer un Bon Distribution', 'url' => null],
            ['text' => 'Bons', 'url' => null], 
        ];
        return view('pages.admin.bonDistribution.create',compact("zones",'breads'));
    } 
       
    public function update($id,$id_BD)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BD' => $id_BD,'status'=>'distribution']);
        return redirect()->route('bon.distribution.index',$id_BD);
    }    
    public function updateDelete($id,$id_BD)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BD' => null,'status'=>'recu']);

        // dd($colis);
        return redirect()->route('bon.distribution.index',$id_BD);
    
    }  
     
    public function updateAll(Request $request,$id_BD)
    {
        // dd($request);
        foreach($request->colis as $colis){

            $colis = Colis::where('id', $colis)
            ->update(['id_BD' => $id_BD]);
        }
        return redirect()->route('bon.distribution.index',$id_BD);
    }    
    public function updateDeleteAll(Request $request,$id_BD)
    {
        foreach($request->colisDelete as $colis){

            $colis = Colis::where('id', $colis)
            ->update(['id_BD' => null]);
        }
        return redirect()->route('bon.distribution.index',$id_BD);
    
    }  
   
}
