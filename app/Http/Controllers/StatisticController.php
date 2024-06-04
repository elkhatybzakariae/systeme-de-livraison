<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
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
use App\Models\Depense;
use App\Models\Facture;
use App\Models\Livreur;
use App\Models\Reclamation;
use App\Models\Zone;
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
        ;

        $colisStatus=Helpers::applyDateFilter($colisStatus,$request,'colis.');
        $colisStatus=$colisStatus->get();

        $query = Facture::select( 'factures.status',
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status')
        ->where('factures.status', 'Paye');

        $facturesPaye=Helpers::applyDateFilter($query,$request,'factures.');
        $facturesPaye=$facturesPaye->first();

        $facturesEnregistre = Facture::select( 'factures.status',
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status')
        ->where('factures.status', 'Enregistre');

        $facturesEnregistre=Helpers::applyDateFilter($facturesEnregistre,$request,'factures.');
        $facturesEnregistre=$facturesEnregistre->first();
        
        $facturesBrouillon = Facture::select( 'factures.status',
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status')
        ->where('factures.status', 'Brouillon');

        $facturesBrouillon=Helpers::applyDateFilter($facturesBrouillon,$request,'factures.');
        $facturesBrouillon=$facturesBrouillon->first();

        $total = Facture::select( 
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F');

        $total=Helpers::applyDateFilter($total,$request,'factures.');
        $total=$total->first();

        $livBonAttent = BonPaymentLivreur::select( 'bon_payment_livreurs.status',
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->groupBy(  'bon_payment_livreurs.status')
        ->where('bon_payment_livreurs.status', 'Attente Payment');

        $livBonAttent=Helpers::applyDateFilter($livBonAttent,$request,'bon_payment_livreurs.');
        $livBonAttent=$livBonAttent->first();

        $livBonPaye = BonPaymentLivreur::select( 'bon_payment_livreurs.status',
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),        
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')

        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')

        ->groupBy(  'bon_payment_livreurs.status')
        ->where('bon_payment_livreurs.status', 'Paye');

        $livBonPaye=Helpers::applyDateFilter($livBonPaye,$request,'bon_payment_livreurs.');
        $livBonPaye=$livBonPaye->first();
        
        $livBonTotal = BonPaymentLivreur::select( 
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv');

        $livBonTotal=Helpers::applyDateFilter($livBonTotal,$request,'bon_payment_livreurs.');
        $livBonTotal=$livBonTotal->first();

        $zoneBonAttent = BonPaymentZone::select( 'bon_payment_zones.status',
        DB::raw('COUNT(bon_payment_zones.id_BPZ) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )

        ->leftJoin('colis', 'colis.id_BPZ', '=', 'bon_payment_zones.id_BPZ')
        ->leftJoin('bon_payment_livreurs', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->groupBy(  'bon_payment_zones.status')
        ->where('bon_payment_zones.status', 'Attente Payment');

        $zoneBonAttent=Helpers::applyDateFilter($zoneBonAttent,$request,'bon_payment_zones.');
        $zoneBonAttent=$zoneBonAttent->first();
        $zoneBonPaye = BonPaymentZone::select( 'bon_payment_zones.status',
        DB::raw('COUNT(bon_payment_zones.id_BPZ) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),        
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')

        )
        ->leftJoin('colis', 'colis.id_BPZ', '=', 'bon_payment_zones.id_BPZ')
        ->leftJoin('bon_payment_livreurs', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->groupBy(  'bon_payment_zones.status')
        ->where('bon_payment_zones.status', 'Paye');

        $zoneBonPaye=Helpers::applyDateFilter($zoneBonPaye,$request,'bon_payment_zones.');
        $zoneBonPaye=$zoneBonPaye->first();
        
        $zoneBonTotal = BonPaymentZone::select( 
        DB::raw('COUNT(bon_payment_zones.id_BPZ) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPZ', '=', 'bon_payment_zones.id_BPZ')
        ->leftJoin('bon_payment_livreurs', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv');

        $zoneBonTotal=Helpers::applyDateFilter($zoneBonTotal,$request,'bon_payment_zones.');
        $zoneBonTotal=$zoneBonTotal->first();

        $depenses = Depense::select(DB::raw('count(id_Dep) as dep_count'), DB::raw('sum(montant) as dep_prix'))
    ;

        $depenses=Helpers::applyDateFilter($depenses,$request,'depenses.');
        $depenses=$depenses->first();
    //   dd($depenses);
        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], 
        ];
        return view('pages.admin.statistic.index' ,compact('breads',
        'facturesBrouillon','facturesEnregistre','facturesPaye','total',
        'livBonAttent','livBonPaye','livBonTotal',
        'zoneBonAttent','zoneBonPaye','zoneBonTotal','depenses',
        'colisStatus',));
    }
    public function zone(Request $request)
    {
        $colisStatus = Colis::query()
        ->select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->orderBy('status')
        ;

        $colisStatus=Helpers::applyDateFilter($colisStatus,$request,'colis.');
        $colisStatus=$colisStatus->get();

       
        $zoneBonAttent = BonPaymentZone::select( 'bon_payment_zones.status',
        DB::raw('COUNT(bon_payment_zones.id_BPZ) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )

        ->leftJoin('colis', 'colis.id_BPZ', '=', 'bon_payment_zones.id_BPZ')
        ->leftJoin('bon_payment_livreurs', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->groupBy(  'bon_payment_zones.status')
        ->where('bon_payment_zones.status', 'Attente Payment');

        $zoneBonAttent=Helpers::applyDateFilter($zoneBonAttent,$request,'bon_payment_zones.');
        $zoneBonAttent=$zoneBonAttent->first();
        $zoneBonPaye = BonPaymentZone::select( 'bon_payment_zones.status',
        DB::raw('COUNT(bon_payment_zones.id_BPZ) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),        
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')

        )
        ->leftJoin('colis', 'colis.id_BPZ', '=', 'bon_payment_zones.id_BPZ')
        ->leftJoin('bon_payment_livreurs', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->groupBy(  'bon_payment_zones.status')
        ->where('bon_payment_zones.status', 'Paye');

        $zoneBonPaye=Helpers::applyDateFilter($zoneBonPaye,$request,'bon_payment_zones.');
        $zoneBonPaye=$zoneBonPaye->first();
        
        $zoneBonTotal = BonPaymentZone::select( 
        DB::raw('COUNT(bon_payment_zones.id_BPZ) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPZ', '=', 'bon_payment_zones.id_BPZ')
        ->leftJoin('bon_payment_livreurs', 'bon_payment_livreurs.id_BPL', '=', 'colis.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv');

        $zoneBonTotal=Helpers::applyDateFilter($zoneBonTotal,$request,'bon_payment_zones.');
        $zoneBonTotal=$zoneBonTotal->first();
        $zones=Zone::all();
        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], 
        ];
        return view('pages.admin.statistic.zone' ,compact('breads',
        'zoneBonAttent','zoneBonPaye','zoneBonTotal','zones',
        'colisStatus',));
    }
    public function livreur(Request $request)
    {
        
        $colisStatus = Colis::query()
        ->select('colis.status', DB::raw('count(*) as total'))
        ->leftJoin('bon_payment_livreurs','colis.id_BPL','bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs','bon_payment_livreurs.id_Liv','livreurs.id_Liv')
        ->groupBy('colis.status')
        ;
        if ($request->has('liv_id') && $request->liv_id) {
            $colisStatus->where('livreurs.id_Liv', $request->liv_id);
        }

        $colisStatus=Helpers::applyDateFilter($colisStatus,$request,'colis.');
        $colisStatus=$colisStatus->get();


        $livBonAttent = BonPaymentLivreur::select( 'bon_payment_livreurs.status',
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->groupBy(  'bon_payment_livreurs.status')
        ->where('bon_payment_livreurs.status', 'Attente Payment');
        if ($request->has('liv_id') && $request->liv_id) {
            $livBonAttent->where('livreurs.id_Liv', $request->liv_id);
        }
        $livBonAttent=Helpers::applyDateFilter($livBonAttent,$request,'bon_payment_livreurs.');
        $livBonAttent=$livBonAttent->first();

        $livBonPaye = BonPaymentLivreur::select( 'bon_payment_livreurs.status',
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),        
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->groupBy(  'bon_payment_livreurs.status')
        ->where('bon_payment_livreurs.status', 'Paye');

        if ($request->has('liv_id') && $request->liv_id) {
            $livBonPaye->where('livreurs.id_Liv', $request->liv_id);
        }
        $livBonPaye=Helpers::applyDateFilter($livBonPaye,$request,'bon_payment_livreurs.');
        $livBonPaye=$livBonPaye->first();
        
        $livBonTotal = BonPaymentLivreur::select( 
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv');

        if ($request->has('liv_id') && $request->liv_id) {
            $livBonTotal->where('livreurs.id_Liv', $request->liv_id);
        }
        $livBonTotal=Helpers::applyDateFilter($livBonTotal,$request,'bon_payment_livreurs.');
        $livBonTotal=$livBonTotal->first();
        $livs=Livreur::all();
       
    //   dd($depenses);
        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], 
        ];
        return view('pages.admin.statistic.livreur' ,compact('breads','colisStatus','livs',
        'livBonAttent','livBonPaye','livBonTotal'));
    }
    public function client(Request $request)
    {
        $colisStatus = Colis::query()
        ->select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->orderBy('status')
        ;
        if ($request->has('client_id') && $request->client_id) {
            $colisStatus->where('id_Cl', $request->client_id);
        }
        $colisStatus=Helpers::applyDateFilter($colisStatus,$request,'colis.');
        $colisStatus=$colisStatus->get();

        $query = Facture::select( 'factures.status',
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status')
        ->where('factures.status', 'Paye');
        if ($request->has('client_id') && $request->client_id) {
            $query->where('factures.id_Cl', $request->client_id);
        }
        $facturesPaye=Helpers::applyDateFilter($query,$request,'factures.');
        $facturesPaye=$facturesPaye->first();

        $facturesEnregistre = Facture::select( 'factures.status',
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status')
        ->where('factures.status', 'Enregistre');
        if ($request->has('client_id') && $request->client_id) {
            $facturesEnregistre->where('factures.id_Cl', $request->client_id);
        }
        $facturesEnregistre=Helpers::applyDateFilter($facturesEnregistre,$request,'factures.');
        $facturesEnregistre=$facturesEnregistre->first();
        
        $facturesBrouillon = Facture::select( 'factures.status',
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status')
        ->where('factures.status', 'Brouillon');
        if ($request->has('client_id') && $request->client_id) {
            $facturesBrouillon->where('factures.id_Cl', $request->client_id);
        }
        $facturesBrouillon=Helpers::applyDateFilter($facturesBrouillon,$request,'factures.');
        $facturesBrouillon=$facturesBrouillon->first();

        $total = Facture::select( 
        DB::raw('COUNT(factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(frais.prix * frais.quntite) AS frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F');
        if ($request->has('client_id') && $request->client_id) {
            $total->where('factures.id_Cl', $request->client_id);
        }
        $total=Helpers::applyDateFilter($total,$request,'factures.');
        $total=$total->first();

        $clients = Client::all();
        $breads = [
            ['title' => 'Statistiques de Client', 'url' => null],
            ['text' => 'Tableau', 'url' => null], 
        ];
        return view('pages.admin.statistic.client' ,compact('breads',
        'facturesBrouillon','facturesEnregistre','facturesPaye','total','clients',
        'colisStatus',));
    }
}
