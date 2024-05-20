<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id('id_Op')->autoIncrement();
            $table->string('code');
            // [
            //     'Nouveau', 'Mise en distribution',
            //     'Expedie', 'En livraison',
            //     'Attente de Ramassage', 'Ramasse',
            //     'En voyage', 'Recu', 'Livraison',
            //     'Distribution', 'Retourne', 'Livre',
            //     'Reporte', 'Pas de Reponse', 'Injoignable',
            //     'Hors-Zone', 'Annule', 'Refuse',
            //     'Numero Errone', 'Deuxieme Appel',
            //     'Programme', 'Boite vocale',
            //     'Client interesse',
            //     'Expedier vers Centre Retour',
            //     'Recu par Centre Retour',
            //     'Expedier vers Centre Principale',
            //     'Recu par Centre Principale',
            //     'Expedier vers Client',
            //     'Recu par Client'
            // ]
            $table->string('nom');
            $table->string('couleur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
