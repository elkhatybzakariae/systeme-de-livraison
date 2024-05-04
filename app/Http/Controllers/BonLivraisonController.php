<?php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\Colis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BonLivraisonController extends Controller
{
    public function index($id_BL=null) 
    {
        // dd($id_BL);
        
        $colis = DB::select('select * from colis 
                     inner join villes on villes.id_V = colis.ville_id 
                     where id_BL is null');

        $user=session('user');
        $colisBon=[];
        if (!$id_BL) {
            if($user ){
                // dd($user['id_Cl']);
                $bonLivraison= BonLivraison::create([
                    'id_BL'=>'BL-'.Str::random(10),
                    'reference'=>'BL-'.Str::random(10),
                    'status'=>'nouveau',
                    'id_Cl'=>$user['id_Cl']
                ]);
            }else{
                return redirect(route('auth.client.signIn'));
            }
        }else{
            $bonLivraison= BonLivraison::query()->with('colis')->where('id_BL',$id_BL)->first();
            $colisBon= DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BL =?',[$id_BL]);
            // dd($colisBon)  ;

        }
        return view('pages.clients.bonLivraison.index',compact("colis", "bonLivraison",'colisBon'));
    }
    public function create()
    {
        $colis = Colis::query()->where('status','nouveau')->get()->count();
        return view('pages.clients.bonLivraison.create',compact("colis"));
    }    
    public function update($id,$id_BL)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BL' => $id_BL]);
        return redirect()->route('bon.livraison.index',$id_BL);
    }    
    public function updateDelete($id,$id_BL)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BL' => null]);
        return redirect()->route('bon.livraison.index',$id_BL);
    }    
}
