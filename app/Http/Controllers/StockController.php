<?php

namespace App\Http\Controllers;

use App\Models\Colis;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function nouveau()
    {
        $colis = Colis::query()->where('status','nouveau')->orderBy('created_at','desc')->get();
        $status = Colis::query()->select('status')->distinct()->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Liste des Nouvelle Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.stock.nouveau', compact('colis','status','breads'));
    }
    public function pres()
    {
        $colis = Colis::query()->where('status','pres pour preparation')->orderBy('created_at','desc')->get();
        $status = Colis::query()->select('status')->distinct()->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Liste des Nouvelle Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.stock.nouveau', compact('colis','status','breads'));
    }
}
