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
use App\Models\Frais;
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

        $query = Facture::select(
            'factures.status',
            DB::raw('COUNT(DISTINCT factures.id_F) AS factures_count'),
            DB::raw('COUNT(colis.id) AS colis_count'),
            DB::raw('SUM(colis.prix) AS prix_total'),
            DB::raw('SUM(tarifs.prixliv) as frais'),
        
        )
        ->addSelect(DB::raw('(SELECT SUM(frais.prix * frais.quntite) FROM frais WHERE frais.id_F = factures.id_F) as frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
        ->leftJoin('villes as ville_colis', 'ville_colis.id_V', '=', 'colis.ville_id')
        ->leftJoin('tarifs', function ($join) {
            $join->on('tarifs.villeRamassage', '=', 'clients.ville')
                 ->on('tarifs.ville', '=', 'ville_colis.id_V');
        })
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->where('factures.status', 'Paye')
        ->groupBy('factures.status','factures.id_F');
        
        $facturesPaye = Helpers::applyDateFilter($query, $request, 'factures.');
        $facturesPaye = $facturesPaye->first();
        // dd($facturesPaye);
        $facturesEnregistre = Facture::select( 'factures.status',
            DB::raw('COUNT(DISTINCT factures.id_F) AS factures_count'),
            DB::raw('COUNT(colis.id) AS colis_count'),
            DB::raw('SUM(colis.prix) AS prix_total'),
            DB::raw('SUM(tarifs.prixliv) as frais'),
        
        )
        ->addSelect(DB::raw('(SELECT SUM(frais.prix * frais.quntite) FROM frais WHERE frais.id_F = factures.id_F) as frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
        ->leftJoin('villes as ville_colis', 'ville_colis.id_V', '=', 'colis.ville_id')
        ->leftJoin('tarifs', function ($join) {
            $join->on('tarifs.villeRamassage', '=', 'clients.ville')
                 ->on('tarifs.ville', '=', 'ville_colis.id_V');
        })
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status','factures.id_F')
        ->where('factures.status', 'Enregistre');

        $facturesEnregistre=Helpers::applyDateFilter($facturesEnregistre,$request,'factures.');
        $facturesEnregistre=$facturesEnregistre->first();
        
        $facturesBrouillon = Facture::select('factures.status',
            DB::raw('COUNT(DISTINCT factures.id_F) AS factures_count'),
            DB::raw('COUNT(colis.id) AS colis_count'),
            DB::raw('SUM(colis.prix) AS prix_total'),
            DB::raw('SUM(tarifs.prixliv) as frais'),
        )
        ->addSelect(DB::raw('(SELECT SUM(frais.prix * frais.quntite) FROM frais WHERE frais.id_F = factures.id_F) as frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
        ->leftJoin('villes as ville_colis', 'ville_colis.id_V', '=', 'colis.ville_id')
        ->leftJoin('tarifs', function ($join) {
            $join->on('tarifs.villeRamassage', '=', 'clients.ville')
                 ->on('tarifs.ville', '=', 'ville_colis.id_V');
        })
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->groupBy(  'factures.status','factures.id_F')
        ->where('factures.status', 'Brouillon');

        $facturesBrouillon=Helpers::applyDateFilter($facturesBrouillon,$request,'factures.');
        $facturesBrouillon=$facturesBrouillon->first();

        $total =Facture::select(
            DB::raw('COUNT(factures.id_F) AS factures_count'),
            DB::raw('COUNT(colis.id) AS colis_count'),
            DB::raw('SUM(colis.prix) AS prix_total'),
            DB::raw('SUM(tarifs.prixliv) as frais'),
            
        )
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
        ->leftJoin('villes as ville_colis', 'ville_colis.id_V', '=', 'colis.ville_id')
        ->leftJoin('tarifs', function ($join) {
            $join->on('tarifs.villeRamassage', '=', 'clients.ville')
                 ->on('tarifs.ville', '=', 'ville_colis.id_V');
        })
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
       
        ;
        $frais_total = Frais::select(DB::raw('SUM(prix * quntite) as total_frais'))->first()->total_frais;

        // dd($frais);
        // Apply date filter if needed
        $total = Helpers::applyDateFilter($total, $request, 'factures.');
        $total = $total->first();
        

        $livBonAttent = BonPaymentLivreur::select( 'bon_payment_livreurs.status',
        DB::raw('COUNT(bon_payment_livreurs.id_BPL) AS bons_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(livreurs.fraislivraison) AS frais_total')
        )
        ->leftJoin('colis', 'colis.id_BPL', '=', 'bon_payment_livreurs.id_BPL')
        ->leftJoin('livreurs', 'livreurs.id_Liv', '=', 'bon_payment_livreurs.id_Liv')
        ->groupBy(  'bon_payment_livreurs.status')
        ->where('bon_payment_livreurs.status', 'Nouveau');

        $q=Helpers::applyDateFilter($livBonAttent,$request,'bon_payment_livreurs.');
        $livBonAttent=$q->first();
        // dd($livBonAttent);
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
        ->where('bon_payment_zones.status', 'Nouveau');

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
        'facturesBrouillon','facturesEnregistre','facturesPaye','total','frais_total',
        'livBonAttent','livBonPaye','livBonTotal',
        'zoneBonAttent','zoneBonPaye','zoneBonTotal','depenses',
        'colisStatus',));
    }
    public function zone(Request $request)
    {
        $colisStatus = Colis::query()
        ->select('colis.status', DB::raw('count(*) as total'))
        ->leftJoin('bon_payment_zones','colis.id_BPZ','bon_payment_zones.id_BPZ')
        ->leftJoin('zones','bon_payment_zones.id_Z','zones.id_Z')
        ->groupBy('colis.status')
        ;
        if ($request->has('zone_id') && $request->zone_id) {
            $colisStatus->where('zones.id_Z', $request->zone_id);
        }

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
        if ($request->has('zone_id') && $request->zone_id) {
            $zoneBonAttent->where('bon_payment_zones.id_Z', $request->zone_id);
        }
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
        if ($request->has('zone_id') && $request->zone_id) {
            $zoneBonPaye->where('bon_payment_zones.id_Z', $request->zone_id);
        }
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
        if ($request->has('zone_id') && $request->zone_id) {
            $zoneBonTotal->where('bon_payment_zones.id_Z', $request->zone_id);
        }
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
        $q=Helpers::applyDateFilter($livBonAttent,$request,'bon_payment_livreurs.');
        $livBonAttent=$q->first();

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

        $query = Facture::select(
            'factures.status',
            DB::raw('COUNT(DISTINCT factures.id_F) AS factures_count'),
            DB::raw('COUNT(colis.id) AS colis_count'),
            DB::raw('SUM(colis.prix) AS prix_total'),
            DB::raw('SUM(tarifs.prixliv) as frais'),
        
        )
        ->addSelect(DB::raw('(SELECT SUM(frais.prix * frais.quntite) FROM frais WHERE frais.id_F = factures.id_F) as frais_total'))
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
        ->leftJoin('villes as ville_colis', 'ville_colis.id_V', '=', 'colis.ville_id')
        ->leftJoin('tarifs', function ($join) {
            $join->on('tarifs.villeRamassage', '=', 'clients.ville')
                 ->on('tarifs.ville', '=', 'ville_colis.id_V');
        })
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ->where('factures.status', 'Paye')
        ->groupBy('factures.status','factures.id_F');
        if ($request->has('client_id') && $request->client_id) {
            $query->where('factures.id_Cl', $request->client_id);
        }
        $facturesPaye=Helpers::applyDateFilter($query,$request,'factures.');
        $facturesPaye=$facturesPaye->first();

        $facturesEnregistre = Facture::select( 'factures.status',
        DB::raw('COUNT(DISTINCT factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(tarifs.prixliv) as frais'),
    
    )
    ->addSelect(DB::raw('(SELECT SUM(frais.prix * frais.quntite) FROM frais WHERE frais.id_F = factures.id_F) as frais_total'))
    ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
    ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
    ->leftJoin('villes as ville_colis', 'ville_colis.id_V', '=', 'colis.ville_id')
    ->leftJoin('tarifs', function ($join) {
        $join->on('tarifs.villeRamassage', '=', 'clients.ville')
             ->on('tarifs.ville', '=', 'ville_colis.id_V');
    })
    ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
    ->groupBy(  'factures.status','factures.id_F')
    ->where('factures.status', 'Enregistre');
        if ($request->has('client_id') && $request->client_id) {
            $facturesEnregistre->where('factures.id_Cl', $request->client_id);
        }
        $facturesEnregistre=Helpers::applyDateFilter($facturesEnregistre,$request,'factures.');
        $facturesEnregistre=$facturesEnregistre->first();
        
        $facturesBrouillon = Facture::select('factures.status',
        DB::raw('COUNT(DISTINCT factures.id_F) AS factures_count'),
        DB::raw('COUNT(colis.id) AS colis_count'),
        DB::raw('SUM(colis.prix) AS prix_total'),
        DB::raw('SUM(tarifs.prixliv) as frais'),
    
    )
    ->addSelect(DB::raw('(SELECT SUM(frais.prix * frais.quntite) FROM frais WHERE frais.id_F = factures.id_F) as frais_total'))
    ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
    ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
    ->leftJoin('villes as ville_colis', 'ville_colis.id_V', '=', 'colis.ville_id')
    ->leftJoin('tarifs', function ($join) {
        $join->on('tarifs.villeRamassage', '=', 'clients.ville')
             ->on('tarifs.ville', '=', 'ville_colis.id_V');
    })
    ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
    ->groupBy(  'factures.status','factures.id_F')
    ->where('factures.status', 'Brouillon');
        if ($request->has('client_id') && $request->client_id) {
            $facturesBrouillon->where('factures.id_Cl', $request->client_id);
        }
        $facturesBrouillon=Helpers::applyDateFilter($facturesBrouillon,$request,'factures.');
        $facturesBrouillon=$facturesBrouillon->first();

        $total =Facture::select(
            DB::raw('COUNT(factures.id_F) AS factures_count'),
            DB::raw('COUNT(colis.id) AS colis_count'),
            DB::raw('SUM(colis.prix) AS prix_total'),
            DB::raw('SUM(tarifs.prixliv) as frais'),
            
        )
        ->leftJoin('colis', 'colis.id_F', '=', 'factures.id_F')
        ->leftJoin('clients', 'clients.id_Cl', '=', 'colis.id_Cl')
        ->leftJoin('villes as ville_colis', 'ville_colis.id_V', '=', 'colis.ville_id')
        ->leftJoin('tarifs', function ($join) {
            $join->on('tarifs.villeRamassage', '=', 'clients.ville')
                 ->on('tarifs.ville', '=', 'ville_colis.id_V');
        })
        ->leftJoin('frais', 'frais.id_F', '=', 'factures.id_F')
        ;
        $frais_total = Frais::select(DB::raw('SUM(prix * quntite) as total_frais'))->first()->total_frais;

        if ($request->has('client_id') && $request->client_id) {
            $total->where('factures.id_Cl', $request->client_id);
            $id_Cl=$request->client_id;
            $frais_total = Frais::whereHas('facture', function ($query) use ($id_Cl) {
                $query->where('id_Cl', $id_Cl);
            })
            ->select(DB::raw('SUM(prix * quntite) as total_frais'))
            ->first()->total_frais;
        }
        $total=Helpers::applyDateFilter($total,$request,'factures.');
        $total=$total->first();

        $clients = Client::all();
        $breads = [
            ['title' => 'Statistiques de Client', 'url' => null],
            ['text' => 'Tableau', 'url' => null], 
        ];
        return view('pages.admin.statistic.client' ,compact('breads',
        'facturesBrouillon','facturesEnregistre','facturesPaye','total','clients','frais_total',
        'colisStatus',));
    }
}
