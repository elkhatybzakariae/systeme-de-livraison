<?php

namespace App\Http\Controllers;

use App\Models\Colis;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function nouveau()
    {
        $colis = Colis::query()->where('status','nouveau')->get();
        // $status = Colis::query()->select('status')->distinct()->get();
        $status = DB::table(DB::raw('(SELECT DISTINCT status, created_at FROM colis) as sub'))
    ->select('status')
    ->orderBy('created_at', 'desc')
    ->get();
        $breads = [
            ['title' => 'Liste des Nouvelle Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.stock.nouveau', compact('colis','status','breads'));
    }
    public function pres()
    {
        $colis = Colis::query()->where('status','pres pour preparation')->get();
        $status = Colis::query()->select('status')->distinct()->get();
        $breads = [
            ['title' => 'Liste des Nouvelle Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.stock.nouveau', compact('colis','status','breads'));
    }
}
