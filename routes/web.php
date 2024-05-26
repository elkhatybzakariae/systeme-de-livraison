<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BonDistributionController;
use App\Http\Controllers\BonEnvoisController;
use App\Http\Controllers\BonLivraisonController;
use App\Http\Controllers\BonPaymentLivreurController;
use App\Http\Controllers\BonPaymentZoneController;
use App\Http\Controllers\BonRetourClientController;
use App\Http\Controllers\BonRetourLivreurController;
use App\Http\Controllers\BonRetourZoneController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\DemandeModificationColiController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewClientController;
use App\Http\Controllers\NewLivreurController;
use App\Http\Controllers\Option;
use App\Http\Controllers\ParamtreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RamassagecoliController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\RemarqueController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\typeBankController;
use App\Http\Controllers\typeClientController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::middleware('check.admin')->group(function () {

    Route::get('/admin/profile/',[ProfileController::class, 'overview'])->name('admin.profile.overview');
    Route::controller(AdminController::class)->prefix('admin')->group(function () {
        Route::get('/index',  'index')->name('admin.index');
        Route::get('/clients',  'clients')->name('admin.clients');
        Route::get('/new-user',  'newuser')->name('admin.newuser');
        Route::post('/store/new-user',  'storenewuser')->name('admin.newuser.store');
        Route::post('/update/user/{id}',  'updatenewuser')->name('admin.newuser.update');
        Route::put('/update/client/{id}',  'updateclient')->name('admin.client.update');
        Route::delete('/delete/user/{id}',  'deletenewuser')->name('admin.newuser.delete');
        Route::get('/signout',  'signout')->name('admin.signout');
        Route::post('/coli/{id}',  'changestatus')->name('admin.changestatus');
        Route::put('/client/activer/{id}',  'ActiverClient')->name('admin.client.activer');
        Route::put('/client/desactiver/{id}',  'DesactiverClient')->name('admin.client.desactiver');
    });

    Route::controller(StatisticController::class)->prefix('admin/statistiques')->group(function () {
        Route::get('/tous',  'index')->name('admin.statistic.index');
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
        Route::get('/destroy/{id}', [BonEnvoisController::class, 'destroy'])->name('bon.envoi.destroy');
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
        Route::get('/destroy/{id}', [BonPaymentLivreurController::class, 'destroy'])->name('bon.payment.livreur.destroy');
        Route::get('/get/pdf/{id_BPL}', [BonPaymentLivreurController::class, 'getPdf'])->name('bon.payment.livreur.getPdf');

    });

    Route::group(['prefix' => 'admin/bon-payment-zone'], function () {
        Route::get('/bon/{id_BPZ?}', [BonPaymentZoneController::class, 'index'])->name('bon.payment.zone.index');
        Route::get('/', [BonPaymentZoneController::class, 'list'])->name('bon.payment.zone.list');
        Route::get('/create', [BonPaymentZoneController::class, 'create'])->name('bon.payment.zone.create');
        Route::post('/store', [BonPaymentZoneController::class, 'store'])->name('bon.payment.zone.store');
        Route::get('/edit/{id}', [BonPaymentZoneController::class, 'edit'])->name('bon.payment.zone.edit');
        Route::get('/update/{id}/bl/{id_BPZ}', [BonPaymentZoneController::class, 'update'])->name('bon.payment.zone.update');
        Route::get('/updateDelete/{id}/bl/{id_BPZ}', [BonPaymentZoneController::class, 'updateDelete'])->name('bon.payment.zone.updateDelete');
        Route::post('/update/all/{id_BPZ}', [BonPaymentZoneController::class, 'updateAll'])->name('bon.payment.zone.update.all');
        Route::post('/update/delete/all/{id_BPZ}', [BonPaymentZoneController::class, 'updateDeleteAll'])->name('bon.payment.zone.updateDelete.all');
        Route::delete('/destroy/{id}', [BonPaymentZoneController::class, 'destroy'])->name('bon.payment.zone.destroy');
        Route::get('/export/colis/{id}', [BonPaymentZoneController::class, 'exportColis'])->name('bon.payment.zone.exportColis');
        Route::get('/destroy/{id}', [BonPaymentZoneController::class, 'destroy'])->name('bon.payment.zone.destroy');
        Route::post('admin/bon-payment/{id}', [BonPaymentZoneController::class, 'recu'])->name('bon.payment.zone.recu');
        Route::get('/get/pdf/{id_BPZ}', [BonPaymentZoneController::class, 'getPdf'])->name('bon.payment.zone.getPdf');



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
    Route::group(['prefix' => 'admin/bon-retour-livreur'], function () {
        Route::get('/bon/{id_BRL?}', [BonRetourLivreurController::class, 'index'])->name('bon.retour.livreur.index');
        Route::get('/', [BonRetourLivreurController::class, 'list'])->name('bon.retour.livreur.list');
        Route::get('/create', [BonRetourLivreurController::class, 'create'])->name('bon.retour.livreur.create');
        Route::post('/store', [BonRetourLivreurController::class, 'store'])->name('bon.retour.livreur.store');
        Route::get('/edit/{id}', [BonRetourLivreurController::class, 'edit'])->name('bon.retour.livreur.edit');
        Route::get('/update/{id}/bl/{id_BRL}', [BonRetourLivreurController::class, 'update'])->name('bon.retour.livreur.update');
        Route::get('/updateDelete/{id}/bl/{id_BRL}', [BonRetourLivreurController::class, 'updateDelete'])->name('bon.retour.livreur.updateDelete');
        Route::delete('/destroy/{id}', [BonRetourLivreurController::class, 'destroy'])->name('bon.retour.livreur.destroy');
        Route::post('/update/all/{id_BRL}', [BonRetourLivreurController::class, 'updateAll'])->name('bon.retour.livreur.update.all');
        Route::post('/update/delete/all/{id_BRL}', [BonRetourLivreurController::class, 'updateDeleteAll'])->name('bon.retour.livreur.updateDelete.all');
        Route::get('/export/colis/{id}', [BonRetourLivreurController::class, 'exportColis'])->name('bon.retour.livreur.exportColis');
        Route::get('/get/pdf/{id_BRL}', [BonRetourLivreurController::class, 'getPdf'])->name('bon.retour.livreur.getPdf');
        Route::post('admin/bon-retour/bd/{id}', [BonRetourLivreurController::class, 'recu'])->name('bon.retour.livreur.recu');
        Route::get('/destroy/{id}', [BonRetourLivreurController::class, 'destroy'])->name('bon.retour.livreur.destroy');


    });
    Route::group(['prefix' => 'admin/bon-retour-zone'], function () {
        Route::get('/bon/{id_BRZ?}', [BonRetourZoneController::class, 'index'])->name('bon.retour.zone.index');
        Route::get('/', [BonRetourZoneController::class, 'list'])->name('bon.retour.zone.list');
        Route::get('/create', [BonRetourZoneController::class, 'create'])->name('bon.retour.zone.create');
        Route::post('/store', [BonRetourZoneController::class, 'store'])->name('bon.retour.zone.store');
        Route::get('/edit/{id}', [BonRetourZoneController::class, 'edit'])->name('bon.retour.zone.edit');
        Route::get('/update/{id}/bl/{id_BRZ}', [BonRetourZoneController::class, 'update'])->name('bon.retour.zone.update');
        Route::get('/updateDelete/{id}/bl/{id_BRZ}', [BonRetourZoneController::class, 'updateDelete'])->name('bon.retour.zone.updateDelete');
        Route::delete('/destroy/{id}', [BonRetourZoneController::class, 'destroy'])->name('bon.retour.zone.destroy');
        Route::post('/update/all/{id_BRZ}', [BonRetourZoneController::class, 'updateAll'])->name('bon.retour.zone.update.all');
        Route::post('/update/delete/all/{id_BRZ}', [BonRetourZoneController::class, 'updateDeleteAll'])->name('bon.retour.zone.updateDelete.all');
        Route::get('/export/colis/{id}', [BonRetourZoneController::class, 'exportColis'])->name('bon.retour.zone.exportColis');
        Route::get('/get/pdf/{id_BRZ}', [BonRetourZoneController::class, 'getPdf'])->name('bon.retour.zone.getPdf');
        Route::post('admin/bon-retour/bd/{id}', [BonRetourZoneController::class, 'recu'])->name('bon.retour.zone.recu');
        Route::get('/destroy/{id}', [BonRetourZoneController::class, 'destroy'])->name('bon.retour.zone.destroy');


    });
    Route::group(['prefix' => 'admin/bon-retour-client'], function () {
        Route::get('/bon/{id_BRC?}', [BonRetourClientController::class, 'index'])->name('bon.retour.client.index');
        Route::get('/', [BonRetourClientController::class, 'list'])->name('bon.retour.client.list');
        Route::get('/create', [BonRetourClientController::class, 'create'])->name('bon.retour.client.create');
        Route::post('/store', [BonRetourClientController::class, 'store'])->name('bon.retour.client.store');
        Route::get('/edit/{id}', [BonRetourClientController::class, 'edit'])->name('bon.retour.client.edit');
        Route::get('/update/{id}/bl/{id_BRC}', [BonRetourClientController::class, 'update'])->name('bon.retour.client.update');
        Route::get('/updateDelete/{id}/bl/{id_BRC}', [BonRetourClientController::class, 'updateDelete'])->name('bon.retour.client.updateDelete');
        Route::delete('/destroy/{id}', [BonRetourClientController::class, 'destroy'])->name('bon.retour.client.destroy');
        Route::post('/update/all/{id_BRC}', [BonRetourClientController::class, 'updateAll'])->name('bon.retour.client.update.all');
        Route::post('/update/delete/all/{id_BRC}', [BonRetourClientController::class, 'updateDeleteAll'])->name('bon.retour.client.updateDelete.all');
        Route::get('/export/colis/{id}', [BonRetourClientController::class, 'exportColis'])->name('bon.retour.client.exportColis');
        Route::get('/get/pdf/{id_BRC}', [BonRetourClientController::class, 'getPdf'])->name('bon.retour.client.getPdf');
        Route::post('admin/bon-retour/bd/{id}', [BonRetourClientController::class, 'recu'])->name('bon.retour.client.recu');
        Route::get('/destroy/{id}', [BonRetourClientController::class, 'destroy'])->name('bon.retour.client.destroy');


    });
    Route::group(['prefix' => 'admin/factures'], function () {
        Route::get('/bon/{id_F?}', [FactureController::class, 'index'])->name('factures.index');
        Route::get('/', [FactureController::class, 'list'])->name('factures.list');
        Route::get('/create', [FactureController::class, 'create'])->name('factures.create');
        Route::post('/store', [FactureController::class, 'store'])->name('factures.store');
        Route::get('/edit/{id}', [FactureController::class, 'edit'])->name('factures.edit');
        Route::get('/update/{id}/bl/{id_F}', [FactureController::class, 'update'])->name('factures.update');
        Route::get('/updateDelete/{id}/bl/{id_F}', [FactureController::class, 'updateDelete'])->name('factures.updateDelete');
        Route::delete('/destroy/{id}', [FactureController::class, 'destroy'])->name('factures.destroy');
        Route::post('/update/all/{id_F}', [FactureController::class, 'updateAll'])->name('factures.update.all');
        Route::post('/update/delete/all/{id_F}', [FactureController::class, 'updateDeleteAll'])->name('factures.updateDelete.all');
        Route::get('/export/colis/{id}', [FactureController::class, 'exportColis'])->name('factures.exportColis');
        Route::get('/get/pdf/{id_F}', [FactureController::class, 'getPdf'])->name('factures.getPdf');
        Route::post('admin/bon-retour/bd/{id}', [FactureController::class, 'recu'])->name('factures.recu');
        Route::get('/destroy/{id}', [FactureController::class, 'destroy'])->name('factures.destroy');


    });
    Route::controller(StockController::class)->prefix('admin/stock')->group(function () {
        Route::get('/nouveau/colis', 'nouveau')->name('stock.colis.nouveau');
        Route::get('/pres/preparation/colis', 'pres')->name('stock.colis.pres');
        // Route::get('/nouveau/colis', 'nouveau')->name('stock.colis.nouveau');
    });

    Route::group(['prefix' => 'admin/reclamation'], function () {
        Route::get('/all', [ReclamationController::class, 'all'])->name('reclamation.all');
        Route::post('/traiteRec/{id}', [ReclamationController::class, 'traiteRec'])->name('reclamation.traiteRec');
    });
    Route::group(['prefix' => 'admin/demandemodificationcolis'], function () {
        Route::get('/all', [DemandeModificationColiController::class, 'all'])->name('demandemodificationcolis.all');
        Route::post('/traiteRec/{id}', [DemandeModificationColiController::class, 'traiteRec'])->name('demandemodificationcolis.traiteRec');
        
        Route::post('/accepte/{id}', [DemandeModificationColiController::class, 'accepte'])->name('demandemodificationcolis.accepte');
        Route::delete('/refuse/{id}', [DemandeModificationColiController::class, 'refuse'])->name('demandemodificationcolis.refuse');
    });
    Route::get('/admin/colis', [ColisController::class, 'indexAdmin'])->name('colis.indexAdmin');
    Route::get('/admin/colis/export', [ColisController::class, 'exportColis'])->name('colis.export');
    Route::post('/admin/colis/prix/{id}', [ColisController::class, 'changePrix'])->name('colis.change.prix');
    Route::get('admin/bon-livraisons/', [BonLivraisonController::class, 'list'])->name('bon.livraison.list');
    
    Route::post('admin/bon-livraisons/blr/{id_BL}', [BonLivraisonController::class, 'recu'])->name('bon.livraison.recu');
    Route::post('admin/bon-livraisons/blnr/{id_BL}', [BonLivraisonController::class, 'nonrecu'])->name('bon.livraison.nonrecu');
    Route::post('admin/bon-envoies/ber/{id_BE}', [BonEnvoisController::class, 'recu'])->name('bon.envoie.recu');
    Route::post('admin/bon-envoies/benr/{id_BE}', [BonEnvoisController::class, 'nonrecu'])->name('bon.envoie.nonrecu');
    Route::post('admin/bon-distributions/bdr/{id_BD}', [BonDistributionController::class, 'recu'])->name('bon.distribution.recu');
    Route::post('admin/bon-distributions/bdnr/{id_BD}', [BonDistributionController::class, 'nonrecu'])->name('bon.distribution.nonrecu');
    Route::post('admin/bon-payment-livreur/bplr/{id_BPL}', [BonPaymentLivreurController::class, 'recu'])->name('bon.payment.livreur.recu');
    Route::post('admin/bon-payment-livreur/bplnr/{id_BPL}', [BonPaymentLivreurController::class, 'nonrecu'])->name('bon.payment.livreur.nonrecu');
    Route::get('admin/bon-livraisons/export/colis/{id}', [BonLivraisonController::class, 'exportColis'])->name('bon.livraison.exportColis');
    Route::get('admin/paramete/generale', [ParamtreController::class, 'index'])->name('parametre.index');
});

Route::get('/get/pdf/{id_BL}', [BonLivraisonController::class, 'getPdf'])->name('bon.livraison.getPdf');

Route::get('liv/get/pdf/{id}/{idC}', [BonLivraisonController::class, 'getPdfColis'])->name('bon.livraison.getPdf.colis');
Route::get('env/get/pdf/{id}/{idC}', [BonEnvoisController::class, 'getPdfColis'])->name('bon.envoi.getPdf.colis');
Route::get('dis/get/pdf/{id}/{idC}', [BonDistributionController::class, 'getPdfColis'])->name('bon.distribution.getPdf.colis');
Route::get('bpl/get/pdf/{id}/{idC}', [BonPaymentLivreurController::class, 'getPdfColis'])->name('bon.payment.livreur.getPdf.colis');
Route::get('bpz/get/pdf/{id}/{idC}', [BonPaymentZoneController::class, 'getPdfColis'])->name('bon.payment.zone.getPdf.colis');
Route::get('rl/get/pdf/{id}/{idC}', [BonRetourLivreurController::class, 'getPdfColis'])->name('bon.retour.livreur.getPdf.colis');
Route::get('rz/get/pdf/{id}/{idC}', [BonRetourZoneController::class, 'getPdfColis'])->name('bon.retour.zone.getPdf.colis');
Route::get('rc/get/pdf/{id}/{idC}', [BonRetourClientController::class, 'getPdfColis'])->name('bon.retour.client.getPdf.colis');




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
    
        Route::get('/import', [ColisController::class, 'showImportPage'])->name('colis.importPage');
        Route::post('/import', [ColisController::class, 'import'])->name('colis.import');
        Route::get('
        /template/download', [ColisController::class, 'downloadTemplate'])->name('colis.downloadTemplate');

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
        Route::get('/bon/livraison/list', [BonLivraisonController::class, 'getClientBons'])->name('bon.livraison.client.list');
    
    });
    Route::group(['prefix' => 'reclamation'], function () {
        Route::get('/', [ReclamationController::class, 'index'])->name('reclamation.index');
        Route::post('/store', [ReclamationController::class, 'store'])->name('reclamation.store');
        Route::get('/edit/{id}', [ReclamationController::class, 'edit'])->name('reclamation.edit');
        Route::post('/update/{id}', [ReclamationController::class, 'update'])->name('reclamation.update');
        Route::delete('/destroy/{id}', [ReclamationController::class, 'destroy'])->name('reclamation.destroy');
    });

    Route::get('/bon/retour', [BonRetourClientController::class, 'getClientBons'])->name('bon.retour.client.getClientBons');

    Route::group(['prefix' => 'demandemodificationcolis'], function () {
        // Route::get('/', [DemandeModificationColiController::class, 'index'])->name('demandemodificationcolis.index');
        Route::post('/store/{id}', [DemandeModificationColiController::class, 'store'])->name('demandemodificationcolis.store');
        // Route::post('/update/{id}', [DemandeModificationColiController::class, 'update'])->name('demandemodificationcolis.update');
        // Route::post('/traiteRec/{id}', [DemandeModificationColiController::class, 'traiteRec'])->name('demandemodificationcolis.traiteRec');
        
    });

});






Route::middleware('check.livreur')->group(function () {

    Route::controller(LivreurController::class)->prefix('livreurs')->group(function () {
        Route::get('/dashboard',  'index')->name('livreur.index');
        Route::get('/signoutr',  'signout')->name('signout.livreur');
        Route::get('/colis',  'allcolis')->name('livreur.colis');
        Route::post('/coli/{id}',  'changestatus')->name('livreur.changestatus');
        Route::get('/bons_distributions',  'allBD')->name('livreur.BD');
    });
});
Route::get('colis/generate-stikers/{id}/{id_BL}', [BonLivraisonController::class, 'generateStikersColis'])->name('generate.stikers.colis');
Route::get('colis/generate-etiqueteuse/{id}/{id_BL}', [BonLivraisonController::class, 'generateEtiqueteuseColis'])->name('generate.etiqueteuse.colis');
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
    

    Route::get('forgot-password', 'showLinkRequestForm')->name('auth.admin.password.request');
    Route::post('forgot-password', 'sendResetLinkEmail')->name('auth.admin.password.email');

    Route::get('reset-password/{token}', 'showResetForm')->name('auth.admin.password.reset');
    Route::post('reset-password', 'reset')->name('auth.admin.password.update');
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

    Route::get('forgot-password', 'showLinkRequestForm')->name('auth.livreur.password.request');
    Route::post('forgot-password', 'sendResetLinkEmail')->name('auth.livreur.password.email');

    Route::get('reset-password/{token}', 'showResetForm')->name('auth.livreur.password.reset');
    Route::post('reset-password', 'reset')->name('auth.livreur.password.update');
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
