<?php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\Colis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BonLivraisonController extends Controller
{
    public function index()
    {
        $colis = Colis::query()->where('status','nouveau')->get();
       $bonLivraison= BonLivraison::create([
            'id_BL'=>'BL-'.Str::random(10),
            'reference'=>'BL-'.Str::random(10),
            'status'=>'nouveau',
            'id_Cl'=>session('user')['id_Cl']
        ]);

        return view('pages.clients.bonLivraison.index',compact("colis", "bonLivraison"));
    }
    public function create()
    {
        $colis = Colis::query()->where('status','nouveau')->get()->count();
        return view('pages.clients.bonLivraison.create',compact("colis"));
    }    
}
