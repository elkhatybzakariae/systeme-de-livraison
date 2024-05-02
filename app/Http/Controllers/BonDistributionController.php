<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BonDistributionController extends Controller
{
    public function create()
    {
        return view('pages.clients.bonLivraison.create');
    }
}
