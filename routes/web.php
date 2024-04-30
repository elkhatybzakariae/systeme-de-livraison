<?php

use App\Http\Controllers\ColisController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/tarifs', [HomeController::class,'tarifs'])->name('tarifs');
Route::get('/option', [HomeController::class,'option'])->name('option');

Route::get('/signup', [UserController::class, 'signuppage'])->name('auth.signUp');
Route::post('/register', [UserController::class, 'signup'])->name('auth.signUp.store');
Route::get('/signin', [UserController::class, 'signinpage'])->name('auth.signIn');
Route::post('/login', [UserController::class, 'signin'])->name('auth.signIn.store');


Route::get('/livreur-signup', [LivreurController::class, 'signuppage'])->name('auth.livreur.signUp');
Route::post('/livreur-register', [LivreurController::class, 'signup'])->name('auth.livreur.signUp.store');
Route::get('/livreur-signin', [LivreurController::class, 'signinpage'])->name('auth.livreur.signIn');
Route::post('/livreur-login', [LivreurController::class, 'signin'])->name('auth.livreur.signIn.store');

// Route::get('/signup', [UserController::class, 'signuppage'])->name('auth.signUp');
// Route::post('/register', [UserController::class, 'signup'])->name('auth.signUp.store');
// Route::get('/signin', [UserController::class, 'signinpage'])->name('auth.signIn');
// Route::post('/login', [UserController::class, 'signin'])->name('auth.signIn.store');

Route::group(['middleware' => 'authen'], function () {
    Route::get('/index', [UserController::class, 'index'])->name('index');
    // Route::get('/teach', [UserController::class, 'teach'])->name('teach');
    // Route::get('/teachdashboard', [UserController::class, 'teachdashboard'])->name('teachdashboard')->middleware('formateur');
    // Route::get('/management', [UserController::class, 'management'])->name('management')->middleware('moderateur');
    // // Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    // Route::get('/dashboard', [UserController::class, 'index2'])->name('home2');
    Route::get('/profile/', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [UserController::class, 'update'])->name('update');
    Route::get('/signout', [UserController::class, 'signout'])->name('signout');
});


Route::group(['prefix' => 'zones', 'middleware' => 'authen'], function () {
    Route::get('/', [ZoneController::class, 'index'])->name('zone.index');
    Route::get('/create', [ZoneController::class, 'create'])->name('zone.create');
    Route::post('/store', [ZoneController::class, 'store'])->name('zone.store');
    Route::get('/edit/{id}', [ZoneController::class, 'edit'])->name('zone.edit');
    Route::post('/update/{id}', [ZoneController::class, 'update'])->name('zone.update');
    Route::delete('/destroy/{id}', [ZoneController::class, 'destroy'])->name('zone.destroy');
});
Route::group(['prefix' => 'villes', 'middleware' => 'authen'], function () {
    Route::get('/', [VilleController::class, 'index'])->name('villes.index');
    Route::get('/create', [VilleController::class, 'create'])->name('villes.create');
    Route::post('/store', [VilleController::class, 'store'])->name('villes.store');
    Route::get('/edit/{id}', [VilleController::class, 'edit'])->name('villes.edit');
    Route::post('/update/{id}', [VilleController::class, 'update'])->name('villes.update');
    Route::delete('/destroy/{id}', [VilleController::class, 'destroy'])->name('villes.destroy');
});
Route::group(['prefix' => 'tarifs', 'middleware' => 'authen'], function () {
    Route::get('/aa', [TarifController::class, 'index'])->name('tarif.index');
    Route::get('/create', [TarifController::class, 'create'])->name('tarif.create');
    Route::post('/store', [TarifController::class, 'store'])->name('tarif.store');
    Route::get('/edit/{id}', [TarifController::class, 'edit'])->name('tarif.edit');
    Route::put('/update/{id}', [TarifController::class, 'update'])->name('tarif.update');
    Route::delete('/destroy/{id}', [TarifController::class, 'destroy'])->name('tarif.destroy');
});
Route::group(['prefix' => 'depenses', 'middleware' => 'authen'], function () {
    Route::get('/', [DepenseController::class, 'index'])->name('depense.index');
    Route::get('/create', [DepenseController::class, 'create'])->name('depense.create');
    // Route::post('/store', function(){dd('edd');})->name('depense.store');
    Route::post('/store', [DepenseController::class, 'store'])->name('depense.store');
    Route::get('/edit/{id}', [DepenseController::class, 'edit'])->name('depense.edit');
    Route::put('/update/{id}', [DepenseController::class, 'update'])->name('depense.update');
    Route::delete('/destroy/{id}', [DepenseController::class, 'destroy'])->name('depense.destroy');
});
Route::group(['prefix' => 'colis', 'middleware' => 'authen'], function () {
    Route::get('/', [ColisController::class, 'index'])->name('colis.index');
    Route::get('/create', [ColisController::class, 'create'])->name('colis.create');
    Route::post('/store', [ColisController::class, 'store'])->name('colis.store');
    Route::get('/edit/{id}', [ColisController::class, 'edit'])->name('colis.edit');
    Route::put('/update/{id}', [ColisController::class, 'update'])->name('colis.update');
    Route::delete('/destroy/{id}', [ColisController::class, 'destroy'])->name('colis.destroy');
});