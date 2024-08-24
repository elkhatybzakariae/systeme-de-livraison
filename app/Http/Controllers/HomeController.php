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
    // public function tarifs() {
    //     $tarifs = Tarif::query()->with('villle', 'villleRamassage')->orderBy('created_at','desc')->get();
    //     return view('pages.landing.tarifs', compact('tarifs'));
    // }
    public function tarifs(Request $request)
{
//         dd($request);
//     $query = Tarif::query();

//     if ($request->has('filterVilleRamassage') && !empty($request->input('filterVilleRamassage'))) {
//         $query->whereHas('villleRamassage', function ($q) use ($request) {
//             $q->where('villename', 'like', '%' . $request->input('filterVilleRamassage') . '%');
//         });
//     }

//     if ($request->has('filterVilles') && !empty($request->input('filterVilles'))) {
//         $query->whereHas('villle', function ($q) use ($request) {
//             $q->where('villename', 'like', '%' . $request->input('filterVilles') . '%');
//         });
//     }

//     $tarifs = $query->get();
// // dd($tarifs);, compact('tarifs')
    return view('pages.landing.tarifs');
}
    public function filtertarifs(Request $request)
{
        $query = Tarif::with(['villle', 'villleRamassage']) // Eager load relationships
        ->orderBy('created_at', 'desc'); // Order the main query by created_at
    
    if ($request->has('filterVilleRamassage') && !empty($request->input('filterVilleRamassage'))) {
        $query->whereHas('villleRamassage', function ($q) use ($request) {
            $q->where('villename', 'like', '%' . $request->input('filterVilleRamassage') . '%');
        });
    }

    if ($request->has('filterVilles') && !empty($request->input('filterVilles'))) {
        $query->whereHas('villle', function ($q) use ($request) {
            $q->where('villename', 'like', '%' . $request->input('filterVilles') . '%');
        });
    }

    $tarifs = $query->get();
    // return view('pages.landing.tarifs', compact('tarifs'));
    return response()->json($tarifs);
}

    public function option() {
        $breads = [
            ['title' => 'Liste des options', 'url' => null],
            ['text' => 'Options', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.option.index',compact('breads'));
    }
}