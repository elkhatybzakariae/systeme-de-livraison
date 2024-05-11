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
        // dd($request);
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
        // dd($request->id_Liv);
        if (!$id_BPL) {
            if($user ){
                $bonLivraison= BonPaymentLivreur::create([
                    'id_BPL'=>'BD-'.Str::random(12),
                    'reference'=>'BD-'.Str::random(10),
                    'status'=>'nouveau',
                    'id_Z'=>$id_Z,
                    'id_Liv'=>$request->id_Liv,
                ]);
            }else{
                return redirect(route('auth.client.signIn'));
            }
        }else{
            $bonLivraison= BonPaymentLivreur::query()->with('colis')->where('id_BPL',$id_BPL)->first();
            $colisBon= DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BPL =?',[$id_BPL]);
        // dd($colisBon)  ;

        }
        $breads = [
            ['title' => 'créer un Bon Envoi', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonPaymentLivreur.index',compact("colis", "bonLivraison",'colisBon','breads'));
    }
    public function list()
    {
        $user=session('user');
        if(!$user){
            return redirect(route('auth.admin.signIn'));
        }
        $bons = DB::table('bon_payment_livreurs')
        ->select(
            'bon_payment_livreurs.id_BPL', 
            'bon_payment_livreurs.reference',  
            'bon_payment_livreurs.status', 
            'bon_payment_livreurs.created_at',
            'livreurs.nomcomplet as liv_nomcomplet',
            'zones.zonename as zone',
            // DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BPL = bon_payment_livreurs.id_BPL) as colis_count'),
            // DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BPL = bon_payment_livreurs.id_BPL) as total_prix')
        )
        // ->leftJoin('colis', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
        ->leftJoin('livreurs', 'bon_payment_livreurs.id_Liv', '=', 'livreurs.id_Liv')
        ->leftJoin('zones', 'bon_payment_livreurs.id_Z', '=', 'zones.id_Z')
        ->get();
    // $bons=BonPaymentLivreur::all();
    // dd($bons);
    $breads = [
        ['title' => 'Liste des Bons de distributions ', 'url' => null],
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
        ->update(['id_BPL' => $id_BPL,'status'=>'distribution']);
        return redirect()->route('bon.payment.livreur.index',$id_BPL);
    }    
    public function updateDelete($id,$id_BPL)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BPL' => null,'status'=>'recu']);

        // dd($colis);
        return redirect()->route('bon.payment.livreur.index',$id_BPL);
    
    }  
}
