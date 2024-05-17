<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParamtreController extends Controller
{
    public function index(){

        return view('pages.admin.parametre.general.index');
    }
}
