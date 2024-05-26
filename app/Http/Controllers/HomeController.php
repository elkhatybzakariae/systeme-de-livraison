<?php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\Colis;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use TCPDF;

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
        $tarifs = Tarif::query()->with('villle', 'villleRamassage')->orderBy('created_at','desc')->get();
        return view('pages.landing.tarifs', compact('tarifs'));
    }
    public function option() {
        $breads = [
            ['title' => 'Liste des options', 'url' => null],
            ['text' => 'Options', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.option.index',compact('breads'));
    }
}