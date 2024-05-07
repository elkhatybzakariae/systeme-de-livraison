<?php

namespace App\Providers;

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
            $view->with('numberOfItems', $numberOfItems);
        });
    }
}
