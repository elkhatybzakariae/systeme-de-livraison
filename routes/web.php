<?php

use App\Http\Controllers\HomeController;
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

Route::get('/signup', [UserController::class, 'signuppage'])->name('auth.signUp');
Route::post('/register', [UserController::class, 'signup'])->name('auth.signUp.store');
Route::get('/signin', [UserController::class, 'signinpage'])->name('auth.signIn');
Route::post('/login', [UserController::class, 'signin'])->name('auth.signIn.store');

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