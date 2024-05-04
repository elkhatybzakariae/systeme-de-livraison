<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BonLivraisonController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewClientController;
use App\Http\Controllers\NewLivreurController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/tarifs', [HomeController::class,'tarifs'])->name('tarifs');
Route::get('/option', [HomeController::class,'option'])->name('option.index');


Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::get('/index',  'index')->name('admin.index')->middleware('check.admin');
    Route::get('/signup',  'signuppage')->name('auth.admin.signUp');
    Route::post('/register',  'signup')->name('auth.admin.signUp.store');
    Route::get('/signin',  'signinpage')->name('auth.admin.signIn');
    Route::post('/login',  'signin')->name('auth.admin.signIn.store');
    Route::get('/signout',  'signout')->name('admin.signout');

});

Route::controller(ClientController::class)->prefix('clients')->group(function () {
    Route::get('/signup',  'signuppage')->name('auth.client.signUp');
    Route::post('/register',  'signup')->name('auth.client.signUp.store');
    Route::get('/signin',  'signinpage')->name('auth.client.signIn');
    Route::post('/login',  'signin')->name('auth.client.signIn.store');
    Route::get('/index',  'index')->name('client.index');
    Route::get('/profile',  'profile')->name('profile');
    Route::put('/profile/update',  'update')->name('update');
    Route::get('/signout',  'signout')->name('signout');
    });


Route::controller(LivreurController::class)->prefix('livreurs')->group(function () {
    Route::get('/signup',  'signuppage')->name('auth.livreur.signUp');
    Route::post('/register',  'signup')->name('auth.livreur.signUp.store');
    Route::get('/signin',  'signinpage')->name('auth.livreur.signIn');
    Route::post('/login',  'signin')->name('auth.livreur.signIn.store');
    Route::get('/dashboard',  'index')->name('livreur.index');
    Route::get('/signoutr',  'signout')->name('signout.livreur');
});

Route::controller(NewClientController::class)->prefix('admin')->group(function () {
    
    Route::get('/new-clients', 'newclients')->name('newclients');
    Route::get('/accept/profile/client/{id}', 'profile')->name('accept.profile');
    Route::put('/accept/profile/client/{id}', 'accept')->name('accept.client');
    Route::delete('/deleteclient/{id}', 'deleteclient')->name('deleteclient');
});

Route::controller(NewLivreurController::class)->prefix('admin')->group(function () {
    Route::get('/new-livreurs', 'newlivreurs')->name('newlivreurs');
    Route::get('/accept/profile/{id}', 'profile')->name('accept.profile.livreur');
    Route::put('/accept/profile/livreur/{id}', 'accept')->name('accept.livreur');
    Route::delete('/deletelivreur/{id}', 'deletelivreur')->name('deletelivreur');   
});



Route::group(['prefix' => 'zones'], function () {
    Route::get('/', [ZoneController::class, 'index'])->name('zone.index');
    Route::get('/create', [ZoneController::class, 'create'])->name('zone.create');
    Route::post('/store', [ZoneController::class, 'store'])->name('zone.store');
    Route::get('/edit/{id}', [ZoneController::class, 'edit'])->name('zone.edit');
    Route::post('/update/{id}', [ZoneController::class, 'update'])->name('zone.update');
    Route::delete('/destroy/{id}', [ZoneController::class, 'destroy'])->name('zone.destroy');
});

Route::group(['prefix' => 'villes'], function () {
    Route::get('/', [VilleController::class, 'index'])->name('villes.index');
    Route::get('/create', [VilleController::class, 'create'])->name('villes.create');
    Route::post('/store', [VilleController::class, 'store'])->name('villes.store');
    Route::get('/edit/{id}', [VilleController::class, 'edit'])->name('villes.edit');
    Route::post('/update/{id}', [VilleController::class, 'update'])->name('villes.update');
    Route::delete('/destroy/{id}', [VilleController::class, 'destroy'])->name('villes.destroy');
});

Route::group(['prefix' => 'tarifs'], function () {
    Route::get('/all', [TarifController::class, 'index'])->name('tarif.index');
    Route::get('/create', [TarifController::class, 'create'])->name('tarif.create');
    Route::post('/store', [TarifController::class, 'store'])->name('tarif.store');
    Route::get('/edit/{id}', [TarifController::class, 'edit'])->name('tarif.edit');
    Route::post('/update/{id}', [TarifController::class, 'update'])->name('tarif.update');
    Route::delete('/destroy/{id}', [TarifController::class, 'destroy'])->name('tarif.destroy');
});

Route::group(['prefix' => 'depenses','midleware'=>'auth'], function () {
    Route::get('/', [DepenseController::class, 'index'])->name('depense.index');
    Route::get('/create', [DepenseController::class, 'create'])->name('depense.create');
    Route::post('/store', [DepenseController::class, 'store'])->name('depense.store');
    Route::get('/edit/{id}', [DepenseController::class, 'edit'])->name('depense.edit');
    Route::post('/update/{id}', [DepenseController::class, 'update'])->name('depense.update');
    Route::delete('/destroy/{id}', [DepenseController::class, 'destroy'])->name('depense.destroy');
});

Route::group(['prefix' => 'colis'], function () {
    Route::get('/', [ColisController::class, 'index'])->name('colis.index');
    Route::get('/ramassage', [ColisController::class, 'indexRamassage'])->name('colis.indexRamassage');
    Route::get('/create', [ColisController::class, 'create'])->name('colis.create');
    Route::post('/store', [ColisController::class, 'store'])->name('colis.store');
    Route::get('/edit/{id}', [ColisController::class, 'edit'])->name('colis.edit');
    Route::put('/update/{id}', [ColisController::class, 'update'])->name('colis.update');
    Route::delete('/destroy/{id}', [ColisController::class, 'destroy'])->name('colis.destroy');
});

Route::group(['prefix' => 'bon-livraison'], function () {
    Route::get('/bon/{id_BL?}', [BonLivraisonController::class, 'index'])->name('bon.livraison.index');
    Route::get('/create', [BonLivraisonController::class, 'create'])->name('bon.livraison.create');
    Route::post('/store', [BonLivraisonController::class, 'store'])->name('bon.livraison.store');
    Route::get('/edit/{id}', [BonLivraisonController::class, 'edit'])->name('bon.livraison.edit');
    Route::get('/update/{id}/bl/{id_BL}', [BonLivraisonController::class, 'update'])->name('bon.livraison.update');
    Route::get('/updateDelete/{id}/bl/{id_BL}', [BonLivraisonController::class, 'updateDelete'])->name('bon.livraison.updateDelete');
    Route::delete('/destroy/{id}', [BonLivraisonController::class, 'destroy'])->name('bon.livraison.destroy');
});

Route::group(['prefix' => 'reclamation'], function () {
    Route::get('/', [ReclamationController::class, 'index'])->name('reclamation.index');
    Route::get('/all', [ReclamationController::class, 'all'])->name('reclamation.all');
    Route::post('/store', [ReclamationController::class, 'store'])->name('reclamation.store');
    Route::get('/edit/{id}', [ReclamationController::class, 'edit'])->name('reclamation.edit');
    Route::put('/update/{id}', [ReclamationController::class, 'update'])->name('reclamation.update');
    Route::delete('/destroy/{id}', [ReclamationController::class, 'destroy'])->name('reclamation.destroy');
});
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/store', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/edit/{id}', [MessageController::class, 'edit'])->name('messages.edit');
    Route::put('/update/{id}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/destroy/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
});
