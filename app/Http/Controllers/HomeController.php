<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
        $breads = [
            ['title' => 'Liste des Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.landing.index');
    }
    public function tarifs() {
        return view('pages.landing.tarifs');
    }
    public function option() {
        $breads = [
            ['title' => 'Liste des options', 'url' => null],
            ['text' => 'Options', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.option.index',compact('breads'));
    }
}
