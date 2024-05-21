<?php

namespace App\Http\Controllers;

use App\Models\BonDistribution;
use App\Models\BonEnvois;
use App\Models\BonLivraison;
use App\Models\BonPaymentLivreur;
use App\Models\BonPaymentZone;
use App\Models\BonRetourClient;
use App\Models\BonRetourLivreur;
use App\Models\BonRetourZone;
use App\Models\Client;
use App\Models\Colis;
use App\Models\Facture;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    
    public function index(Request $request)
    {
        $colisStatus = Colis::query()
        ->select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->orderBy('status')
        ->get();;

    //   dd($colis);
        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.statistic.index' ,compact('breads',
        
        'colisStatus',));
    }
}
