<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('colis', function (Blueprint $table) {
            $table->string('id_C')->primary();
            $table->string('code_d_envoi');
            $table->date('date_d_expedition')->nullable();
            $table->string('destinataire');
            $table->string('id_Cl');
            $table->foreign('id_Cl')->on('clients')->references('id_Cl');
            $table->string('telephone');
            $table->string('marchandise');
            $table->string('etat')->default('Nouveau colis');
            $table->string('status')->default('Nouveau colis');
            $table->string('zone');
            $table->foreign('zone')->on('zones')->references('id_Z');
            $table->string('ville_id');
            $table->foreign('ville_id')->on('villes')->references('id_V');
            $table->decimal('prix', 8, 2);
            $table->integer('quantite');
            $table->text('commentaire')->nullable();
            $table->string('adresse');
            $table->boolean('fragile')->default(false);
            $table->boolean('ouvrir')->default(false);
            $table->boolean('colis_a_remplacer')->default(false);
            $table->timestamps();

        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};
