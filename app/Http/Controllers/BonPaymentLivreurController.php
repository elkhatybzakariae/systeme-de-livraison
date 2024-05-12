<?php

namespace App\Http\Controllers;

use App\Models\BonPaymentLivreur;
use App\Models\Colis;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BonPaymentLivreurController extends Controller
{
    
    public function index(Request $request ,$id_BPL=null) 
    {
        $id_Z = $request->input('zone');
        if($id_Z == null){
            $id_Z=session('zone');
        }else{
            session(['zone'=>$id_Z]);
        }
        // dd(session('zone'));
        $user=session('user');
        $colis =Colis::query()->with('ville')->whereNull('id_BPL')->where('zone',$id_Z)->get();

        $colisBon=[];
        if (!$id_BPL) {
            // dd($id_BPL);
            if($user ){
                $bon= BonPaymentLivreur::create([
                    'id_BPL'=>'BPL-'.Str::random(10),
                    'reference'=>'BPL-'.Str::random(10),
                    'status'=>'nouveau',
                    'id_Z'=>$id_Z,
                    'id_Liv'=>$request->id_Liv,
                ]);
            }else{
                return redirect(route('auth.client.signIn'));
            }
        }else{
            $bon= BonPaymentLivreur::query()->with('colis')->where('id_BPL',$id_BPL)->first();
            $colisBon= DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BPL =?',[$id_BPL]);
        // dd($colisBon)  ;

        }
        $breads = [
            ['title' => 'créer un Bon payment pour livreur', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonPaymentLivreur.index',compact("colis", "bon",'colisBon','breads'));
    }
    public function list()
    {
        $user=session('user');
        if(!$user){
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
        ->with('colis','colis.ville')
        ->distinct()
        ->get();
    // $bons=BonPaymentLivreur::all();
    // dd($bons);
    $breads = [
        ['title' => 'Liste des Bons de payment livreur ', 'url' => null],
        ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
    ];
        return view('pages.admin.bonPaymentLivreur.list',compact("bons",'breads'));
    } 
    public function create()
    {
        $user=session('user');
      
        $zones = Zone::whereHas('colis', function ($query) {
            $query->where('status', 'livre')->where('etat', 'non paye');
        })
        ->with(['colis', 'livreurs']) 
        ->withCount('colis')
        ->get();

        // dd($zones);

        $breads = [
            ['title' => 'créer un Bon Payement', 'url' => null],
            ['text' => 'Bons', 'url' => null], 
        ];
        return view('pages.admin.bonPaymentLivreur.create',compact("zones",'breads'));
    } 
       
    public function update($id,$id_BPL)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BPL' => $id_BPL,'etat'=>'paye']);
        return redirect()->route('bon.payment.livreur.index',$id_BPL);
    }    
    public function updateDelete($id,$id_BPL)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BPL' => null,'etat'=>'non paye']);

        // dd($colis);
        return redirect()->route('bon.payment.livreur.index',$id_BPL);
    
    }  
    public function updateAll(Request $request,$id_BPL)
    {
        // dd($request);
        foreach($request->colis as $colis){

            $colis = Colis::where('id', $colis)
            ->update(['id_BPL' => $id_BPL]);
        }
        return redirect()->route('bon.payment.livreur.index',$id_BPL);
    }    
    public function updateDeleteAll(Request $request,$id_BPL)
    {
        foreach($request->colisDelete as $colis){

            $colis = Colis::where('id', $colis)
            ->update(['id_BPL' => null]);
        }
        return redirect()->route('bon.payment.livreur.index',$id_BPL);
    
    }  
}
