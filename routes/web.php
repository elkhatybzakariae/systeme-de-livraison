<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BonDistributionController;
use App\Http\Controllers\BonEnvoisController;
use App\Http\Controllers\BonLivraisonController;
use App\Http\Controllers\BonPaymentLivreurController;
use App\Http\Controllers\BonPaymentZoneController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewClientController;
use App\Http\Controllers\NewLivreurController;
use App\Http\Controllers\Option;
use App\Http\Controllers\RamassagecoliController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\RemarqueController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\typeBankController;
use App\Http\Controllers\typeClientController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\ZoneController;
use App\Models\Etat;
use App\Models\typeBank;
use App\Models\typeClient;
use Illuminate\Support\Facades\Route;

Route::middleware('check.admin')->group(function () {
    Route::controller(AdminController::class)->prefix('admin')->group(function () {
        Route::get('/index',  'index')->name('admin.index');
        Route::get('/clients',  'clients')->name('admin.clients');
        Route::get('/new-user',  'newuser')->name('admin.newuser');
        Route::post('/store/new-user',  'storenewuser')->name('admin.newuser.store');
        Route::post('/update/user/{id}',  'updatenewuser')->name('admin.newuser.update');
        Route::delete('/delete/user/{id}',  'deletenewuser')->name('admin.newuser.delete');
        Route::get('/signout',  'signout')->name('admin.signout');
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
    Route::group(['prefix' => 'depenses', 'midleware' => 'auth'], function () {
        Route::get('/', [DepenseController::class, 'index'])->name('depense.index');
        Route::get('/create', [DepenseController::class, 'create'])->name('depense.create');
        Route::post('/store', [DepenseController::class, 'store'])->name('depense.store');
        Route::get('/edit/{id}', [DepenseController::class, 'edit'])->name('depense.edit');
        Route::post('/update/{id}', [DepenseController::class, 'update'])->name('depense.update');
        Route::delete('/destroy/{id}', [DepenseController::class, 'destroy'])->name('depense.destroy');
    });

    Route::group(['prefix' => 'admin/bon-envoi'], function () {
        Route::get('/bon/{id_BE?}', [BonEnvoisController::class, 'index'])->name('bon.envoi.index');
        Route::get('/', [BonEnvoisController::class, 'list'])->name('bon.envoi.list');
        Route::get('/create', [BonEnvoisController::class, 'create'])->name('bon.envoi.create');
        Route::post('/store', [BonEnvoisController::class, 'store'])->name('bon.envoi.store');
        Route::get('/edit/{id}', [BonEnvoisController::class, 'edit'])->name('bon.envoi.edit');
        Route::get('/update/{id}/bl/{id_BE}', [BonEnvoisController::class, 'update'])->name('bon.envoi.update');
        Route::get('/updateDelete/{id}/bl/{id_BE}', [BonEnvoisController::class, 'updateDelete'])->name('bon.envoi.updateDelete');
        Route::delete('/destroy/{id}', [BonEnvoisController::class, 'destroy'])->name('bon.envoi.destroy');
        Route::post('/update/all/{id_BE}', [BonEnvoisController::class, 'updateAll'])->name('bon.envoi.update.all');
        Route::post('/update/delete/all/{id_BE}', [BonEnvoisController::class, 'updateDeleteAll'])->name('bon.envoi.updateDelete.all');
        Route::get('/export/colis/{id_BE}', [BonEnvoisController::class, 'exportColis'])->name('bon.envoi.exportColis');
        Route::get('/get/pdf/{id_BE}', [BonEnvoisController::class, 'getPdf'])->name('bon.envoi.getPdf');
    });
    Route::group(['prefix' => 'admin/bon-payment-livreur'], function () {
        Route::get('/bon/{id_BPL?}', [BonPaymentLivreurController::class, 'index'])->name('bon.payment.livreur.index');
        Route::get('/', [BonPaymentLivreurController::class, 'list'])->name('bon.payment.livreur.list');
        Route::get('/create', [BonPaymentLivreurController::class, 'create'])->name('bon.payment.livreur.create');
        Route::post('/store', [BonPaymentLivreurController::class, 'store'])->name('bon.payment.livreur.store');
        Route::get('/edit/{id}', [BonPaymentLivreurController::class, 'edit'])->name('bon.payment.livreur.edit');
        Route::get('/update/{id}/bl/{id_BPL}', [BonPaymentLivreurController::class, 'update'])->name('bon.payment.livreur.update');
        Route::get('/updateDelete/{id}/bl/{id_BPL}', [BonPaymentLivreurController::class, 'updateDelete'])->name('bon.payment.livreur.updateDelete');
        Route::delete('/destroy/{id}', [BonPaymentLivreurController::class, 'destroy'])->name('bon.payment.livreur.destroy');
        Route::post('/update/all/{id_BL}', [BonPaymentLivreurController::class, 'updateAll'])->name('bon.payment.livreur.update.all');
        Route::post('/update/delete/all/{id_BL}', [BonPaymentLivreurController::class, 'updateDeleteAll'])->name('bon.payment.livreur.updateDelete.all');
        Route::get('/export/colis/{id}', [BonPaymentLivreurController::class, 'exportColis'])->name('bon.payment.livreur.exportColis');
    });

    Route::group(['prefix' => 'admin/bon-payment-zone'], function () {
        Route::get('/bon/{id_BD?}', [BonPaymentZoneController::class, 'index'])->name('bon.payment.zone.index');
        Route::get('/', [BonPaymentZoneController::class, 'list'])->name('bon.payment.zone.list');
        Route::get('/create', [BonPaymentZoneController::class, 'create'])->name('bon.payment.zone.create');
        Route::post('/store', [BonPaymentZoneController::class, 'store'])->name('bon.payment.zone.store');
        Route::get('/edit/{id}', [BonPaymentZoneController::class, 'edit'])->name('bon.payment.zone.edit');
        Route::get('/update/{id}/bl/{id_BD}', [BonPaymentZoneController::class, 'update'])->name('bon.payment.zone.update');
        Route::get('/updateDelete/{id}/bl/{id_BD}', [BonPaymentZoneController::class, 'updateDelete'])->name('bon.payment.zone.updateDelete');
        Route::delete('/destroy/{id}', [BonPaymentZoneController::class, 'destroy'])->name('bon.payment.zone.destroy');
        Route::get('/export/colis/{id}', [BonPaymentLivreurController::class, 'exportColis'])->name('bon.payment.livreur.exportColis');
    });
    Route::group(['prefix' => 'admin/bon-distribution'], function () {
        Route::get('/bon/{id_BD?}', [BonDistributionController::class, 'index'])->name('bon.distribution.index');
        Route::get('/', [BonDistributionController::class, 'list'])->name('bon.distribution.list');
        Route::get('/create', [BonDistributionController::class, 'create'])->name('bon.distribution.create');
        Route::post('/store', [BonDistributionController::class, 'store'])->name('bon.distribution.store');
        Route::get('/edit/{id}', [BonDistributionController::class, 'edit'])->name('bon.distribution.edit');
        Route::get('/update/{id}/bl/{id_BD}', [BonDistributionController::class, 'update'])->name('bon.distribution.update');
        Route::get('/updateDelete/{id}/bl/{id_BD}', [BonDistributionController::class, 'updateDelete'])->name('bon.distribution.updateDelete');
        Route::delete('/destroy/{id}', [BonDistributionController::class, 'destroy'])->name('bon.distribution.destroy');
        Route::post('/update/all/{id_BL}', [BonDistributionController::class, 'updateAll'])->name('bon.distribution.update.all');
        Route::post('/update/delete/all/{id_BL}', [BonDistributionController::class, 'updateDeleteAll'])->name('bon.distribution.updateDelete.all');
        Route::get('/export/colis/{id}', [BonDistributionController::class, 'exportColis'])->name('bon.distribution.exportColis');
        Route::get('/get/pdf/{id_BE}', [BonDistributionController::class, 'getPdf'])->name('bon.distribution.getPdf');
    });
    Route::group(['prefix' => 'admin/reclamation'], function () {
        Route::get('/all', [ReclamationController::class, 'all'])->name('reclamation.all');
        Route::post('/traiteRec/{id}', [ReclamationController::class, 'traiteRec'])->name('reclamation.traiteRec');
    });
    Route::get('/admin/colis', [ColisController::class, 'indexAdmin'])->name('colis.indexAdmin');
    Route::get('admin/bon-livraisons/', [BonLivraisonController::class, 'list'])->name('bon.livraison.list');
    Route::get('/get/pdf/{id_BL}', [BonLivraisonController::class, 'getPdf'])->name('bon.livraison.getPdf');

    Route::post('admin/bon-livraisons/bl/{id_BL}', [BonLivraisonController::class, 'recu'])->name('bon.livraison.recu');
    Route::post('admin/bon-envoies/be/{id_BE}', [BonEnvoisController::class, 'recu'])->name('bon.envoie.recu');
    Route::post('admin/bon-distributions/bd/{id_BD}', [BonDistributionController::class, 'recu'])->name('bon.distribution.recu');
    Route::get('admin/bon-livraisons//export/colis/{id}', [BonLivraisonController::class, 'exportColis'])->name('bon.livraison.exportColis');
});
Route::middleware('check.client')->group(function () {
    Route::controller(ClientController::class)->prefix('clients')->group(function () {
        Route::get('/index',  'index')->name('client.index');
        Route::get('/profile',  'profile')->name('profile');
        Route::put('/profile/update',  'update')->name('update');
        Route::get('/signout',  'signout')->name('signout');
        Route::get('/new-user',  'newuser')->name('newuser');
        Route::post('/store/new-user',  'storenewuser')->name('newuser.store');
        Route::post('/update/user/{id}',  'updatenewuser')->name('newuser.update');
        Route::put('/update/etat/user/{id}',  'updateetatnewuser')->name('newuser.etat.update');
        Route::put('/update/valider/user/{id}',  'validernewuser')->name('newuser.valider.update');
        Route::put('/update/nonvalider/user/{id}',  'nonvalidernewuser')->name('newuser.nonvalider.update');
        Route::delete('/delete/user/{id}',  'deletenewuser')->name('newuser.delete');
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
        Route::post('/update/all/{id_BL}', [BonLivraisonController::class, 'updateAll'])->name('bon.livraison.update.all');

        Route::post('/update/delete/all/{id_BL}', [BonLivraisonController::class, 'updateDeleteAll'])->name('bon.livraison.updateDelete.all');
        Route::post('/update/barCode/{id_BL}', [BonLivraisonController::class, 'updateBarCode'])->name('bon.livraison.update.barCode');
        Route::post('/update/delete/barCode/{id_BL}', [BonLivraisonController::class, 'updateDeleteBarCode'])->name('bon.livraison.updateDelete.barCode');
    });
    Route::group(['prefix' => 'reclamation'], function () {
        Route::get('/', [ReclamationController::class, 'index'])->name('reclamation.index');
        Route::post('/store', [ReclamationController::class, 'store'])->name('reclamation.store');
        Route::get('/edit/{id}', [ReclamationController::class, 'edit'])->name('reclamation.edit');
        Route::post('/update/{id}', [ReclamationController::class, 'update'])->name('reclamation.update');
        Route::delete('/destroy/{id}', [ReclamationController::class, 'destroy'])->name('reclamation.destroy');
    });
});
Route::middleware('check.livreur')->group(function () {

    Route::controller(LivreurController::class)->prefix('livreurs')->group(function () {
        Route::get('/dashboard',  'index')->name('livreur.index');
        Route::get('/signoutr',  'signout')->name('signout.livreur');
        Route::get('/colis',  'allcolis')->name('livreur.colis');
        Route::get('/bons_distributions',  'allBD')->name('livreur.BD');
    });
});
Route::get('/generate-stikers/{id}', [BonLivraisonController::class, 'generateStikers'])->name('generate.stikers');
Route::get('/generate-etiqueteuse/{id}', [BonLivraisonController::class, 'generateEtiqueteuse'])->name('generate.etiqueteuse');
Route::get('/generate-facture/{id}', [BonLivraisonController::class, 'generateFacture'])->name('generate.facture');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tarifs', [HomeController::class, 'tarifs'])->name('tarifs');


Route::controller(Option::class)->prefix('options')->group(function () {
    Route::get('/', 'index')->name('option.index');
    Route::post('/store', 'store')->name('option.store');
    Route::post('/update/{id}', 'update')->name('option.update');
    Route::delete('/delete/{id}', 'delete')->name('option.delete');
});
Route::controller(EtatController::class)->prefix('etat')->group(function () {
    Route::post('/store', 'store')->name('etat.store');
    Route::post('/update/{id}', 'update')->name('etat.update');
    Route::delete('/delete/{id}', 'delete')->name('etat.delete');
});
Route::controller(typeClientController::class)->prefix('typeclient')->group(function () {
    Route::post('/store', 'store')->name('typeclient.store');
    Route::post('/update/{id}', 'update')->name('typeclient.update');
    Route::delete('/delete/{id}', 'delete')->name('typeclient.delete');
});
Route::controller(typeBankController::class)->prefix('bank')->group(function () {
    Route::post('/store', 'store')->name('bank.store');
    Route::post('/update/{id}', 'update')->name('bank.update');
    Route::delete('/delete/{id}', 'delete')->name('bank.delete');
});

Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::get('/signup',  'signuppage')->name('auth.admin.signUp');
    Route::post('/register',  'signup')->name('auth.admin.signUp.store');
    Route::get('/signin',  'signinpage')->name('auth.admin.signIn');
    Route::post('/login',  'signin')->name('auth.admin.signIn.store');
});


Route::controller(ClientController::class)->prefix('clients')->group(function () {
    Route::get('/signup',  'signuppage')->name('auth.client.signUp');
    Route::post('/register',  'signup')->name('auth.client.signUp.store');
    Route::get('/signin',  'signinpage')->name('auth.client.signIn');
    Route::post('/login',  'signin')->name('auth.client.signIn.store');

    Route::get('forgot-password', 'showLinkRequestForm')->name('auth.client.password.request');
    Route::post('forgot-password', 'sendResetLinkEmail')->name('auth.client.password.email');

    Route::get('reset-password/{token}', 'showResetForm')->name('auth.client.password.reset');
    Route::post('reset-password', 'reset')->name('auth.client.password.update');
});


Route::controller(LivreurController::class)->prefix('livreurs')->group(function () {
    Route::get('/signup',  'signuppage')->name('auth.livreur.signUp');
    Route::post('/register',  'signup')->name('auth.livreur.signUp.store');
    Route::get('/signin',  'signinpage')->name('auth.livreur.signIn');
    Route::post('/login',  'signin')->name('auth.livreur.signIn.store');
});

Route::get('/generate-pdf', [HomeController::class, 'generatePDF'])->name('generate.pdf');


Route::group(['prefix' => 'messages'], function () {
    Route::get('/', [MessageController::class, 'index'])->name('message.index');
    Route::get('/create', [MessageController::class, 'create'])->name('message.create');
    Route::post('/store/{id}', [MessageController::class, 'store'])->name('message.store');
    Route::get('/edit/{id}', [MessageController::class, 'edit'])->name('message.edit');
    Route::post('/update/{id}', [MessageController::class, 'update'])->name('message.update');
    Route::delete('/destroy/{id}', [MessageController::class, 'destroy'])->name('message.destroy');
});

Route::group(['prefix' => 'ramassagecolis'], function () {
    Route::get('/', [RamassagecoliController::class, 'index'])->name('ramassagecolis.index');
    Route::get('/all', [RamassagecoliController::class, 'all'])->name('ramassagecolis.all');
    Route::post('/store', [RamassagecoliController::class, 'store'])->name('ramassagecolis.store');
    // Route::get('/edit/{id}', [RamassagecoliController::class, 'edit'])->name('ramassagecolis.edit');
    Route::post('/update-etat', [RamassagecoliController::class, 'update'])->name('ramassagecolis.update');
    // Route::delete('/destroy/{id}', [RamassagecoliController::class, 'destroy'])->name('ramassagecolis.destroy');
});

Route::group(['prefix' => 'remarque'], function () {
    Route::get('/', [RemarqueController::class, 'index'])->name('remarque.index');
    Route::post('/store', [RemarqueController::class, 'store'])->name('remarque.store');
    Route::post('/update/{id}', [RemarqueController::class, 'update'])->name('remarque.update');
    Route::delete('/destroy/{id}', [RemarqueController::class, 'destroy'])->name('remarque.destroy');
});

Route::group(['prefix' => 'livreur/bon-payment'], function () {
    Route::get('/', [BonPaymentLivreurController::class, 'livreurBP'])->name('bon.payment.list');
});


Route::get('/sms', [AdminController::class, 'getsendSMS'])->name('message.getsendSMS');
Route::post('/send-sms', [AdminController::class, 'sendSMS'])->name('message.sendSMS');
