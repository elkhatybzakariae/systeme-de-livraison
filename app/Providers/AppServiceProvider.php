<?php

namespace App\Providers;

use App\Models\BonDistribution;
use App\Models\BonEnvois;
use App\Models\BonLivraison;
use App\Models\BonPaymentLivreur;
use App\Models\BonPaymentZone;
use App\Models\BonRetourClient;
use App\Models\BonRetourLivreur;
use App\Models\BonRetourZone;
use App\Models\Client;
use App\Models\DemandeModificationColi;
use App\Models\Facture;
use App\Models\Livreur;
use App\Models\Ramassagecoli;
use App\Models\Reclamation;
use App\Models\Remarque;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('layouts.admin.sidebar', function ($view) {
            $numberOfItems = Reclamation::where('etat', 0)->count();
            $numberOfClients = Client::where('isAccepted', 0)->where('isAdmin', 1)->count();
            $numberOfLivreurs = Livreur::where('isAccepted', 0)->count();
            $numberOfRem = Remarque::count();
            $numberOfRC = Ramassagecoli::where('etat', 'Nouvelle demande')->count();
            $numberOfBL = BonLivraison::where('status', 'nouveau')->count();
            $numberOfBE = BonEnvois::where('status', 'nouveau')->count();
            $numberOfBD = BonDistribution::where('status', 'nouveau')->count();
            $numberOfDMC = DemandeModificationColi::where('isAccepted', 'Nouveau')->count();
            $numberOfBRL = BonRetourLivreur::where('status', 'Nouveau')->count();
            $numberOfBRC = BonRetourClient::where('status', 'Nouveau')->count();
            $numberOfBRZ = BonRetourZone::where('status', 'Nouveau')->count();
            $numberOfF = Facture::where('status', 'Brouillon')->count();
            $numberOfBPL = BonPaymentLivreur::where('status', 'Nouveau')->count();
            $numberOfBPZ = BonPaymentZone::where('status', 'Nouveau')->count();
            $view->with([
                'numberOfItems' => $numberOfItems,
                'numberOfLivreurs' => $numberOfLivreurs,
                'numberOfClients' => $numberOfClients,
                'numberOfRem' => $numberOfRem,
                'numberOfRC' => $numberOfRC,
                'numberOfBL' => $numberOfBL,
                'numberOfBE' => $numberOfBE,
                'numberOfBD' => $numberOfBD,
                'numberOfDMC' => $numberOfDMC,
                'numberOfBRL' => $numberOfBRL,
                'numberOfBRC' => $numberOfBRC,
                'numberOfBRZ' => $numberOfBRZ,
                'numberOfF' => $numberOfF,
                'numberOfBPL' => $numberOfBPL,
                'numberOfBPZ' => $numberOfBPZ
            ]);
        });
    }
}
