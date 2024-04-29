<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
        return view('pages.landing.index');
    }
    public function tarifs() {
        return view('pages.landing.tarifs');
    }
    public function option() {
        return view('pages.option.index');
    }
}
