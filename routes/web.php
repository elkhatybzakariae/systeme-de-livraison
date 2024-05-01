<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/tarifs', [HomeController::class,'tarifs'])->name('tarifs');
Route::get('/option', [HomeController::class,'option'])->name('option.index');


Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::get('/index',  'index')->name('admin.index');
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


Route::get('/new-clients', [AdminController::class, 'newclients'])->name('newclients');
Route::put('/accepteclient/{id}', [AdminController::class, 'accepteclient'])->name('accepteclient');
Route::delete('/deleteclient/{id}', [AdminController::class, 'deleteclient'])->name('deleteclient');




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
    Route::get('/aa', [TarifController::class, 'index'])->name('tarif.index');
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
    Route::get('/create', [ColisController::class, 'create'])->name('colis.create');
    Route::post('/store', [ColisController::class, 'store'])->name('colis.store');
    Route::get('/edit/{id}', [ColisController::class, 'edit'])->name('colis.edit');
    Route::put('/update/{id}', [ColisController::class, 'update'])->name('colis.update');
    Route::delete('/destroy/{id}', [ColisController::class, 'destroy'])->name('colis.destroy');
});
