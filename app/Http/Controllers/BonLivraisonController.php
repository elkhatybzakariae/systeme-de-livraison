<?php

namespace App\Http\Controllers;

use App\Models\Colis;
use Illuminate\Http\Request;

class BonLivraisonController extends Controller
{
    public function create()
    {
        $colis=Colis::all()->count();

        return view('pages.clients.bonLivraison.create',compact("colis"));
    }
}
