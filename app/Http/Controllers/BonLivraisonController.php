<?php

namespace App\Http\Controllers;

use App\Models\Colis;
use Illuminate\Http\Request;

class BonLivraisonController extends Controller
{
    public function index()
    {
        $colis = Colis::query()->where('status','nouveau')->get();


        return view('pages.clients.bonLivraison.index',compact("colis"));
    }
    public function create()
    {
        $colis = Colis::query()->where('status','nouveau')->get()->count();


        return view('pages.clients.bonLivraison.create',compact("colis"));
    }
}
