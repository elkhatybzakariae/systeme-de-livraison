<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Livreur;
use App\Models\Ramassagecoli;
use App\Models\Reclamation;
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
            $numberOfClients = Client::where('isAccepted', 0)->count();
            $numberOfLivreurs = Livreur::where('isAccepted', 0)->count();
            $numberOfRC = Ramassagecoli::where('etat', 'Nouvelle demande')->count();
            $view->with(['numberOfItems'=> $numberOfItems,'numberOfLivreurs'=> $numberOfLivreurs,'numberOfClients'=> $numberOfClients,'numberOfRC'=> $numberOfRC]);
        });
    }
}
