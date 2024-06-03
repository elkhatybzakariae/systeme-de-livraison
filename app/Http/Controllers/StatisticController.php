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

        $facturesPaye = Facture::select( 'factures.status',
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status')
        ->where('factures.status', 'Paye')
        ->first();

        $facturesEnregistre = Facture::select( 'factures.status',
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status')
        ->where('factures.status', 'Enregistre')
        ->first();
        $facturesBrouillon = Facture::select( 'factures.status',
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status')
        ->where('factures.status', 'Brouillon')
        ->first();
        $total = Facture::select( 
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->first();
        $livBonAttent = BonPaymentLivreur::select( 'bon_payment_livreurs.status',
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->groupBy(  'bon_payment_livreurs.status')
        ->where('bon_payment_livreurs.status', 'Attente Payment')
        ->first();
        $livBonPaye = BonPaymentLivreur::select( 'bon_payment_livreurs.status',
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),        
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')

        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')

        ->groupBy(  'bon_payment_livreurs.status')
        ->where('bon_payment_livreurs.status', 'Paye')
        ->first();
        
        $livBonTotal = BonPaymentLivreur::select( 
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->first();


      dd($livBonTotal);
        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.statistic.index' ,compact('breads',
        'facturesBrouillon','facturesEnregistre','facturesPaye','total',
        'colisStatus',));
    }
}
