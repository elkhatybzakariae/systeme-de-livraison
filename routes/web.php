<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', [UserController::class, 'signuppage'])->name('signuppage');
Route::post('/register', [UserController::class, 'signup'])->name('signup');
Route::get('/signin', [UserController::class, 'signinpage'])->name('signinpage');
Route::post('/login', [UserController::class, 'signin'])->name('signin');

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