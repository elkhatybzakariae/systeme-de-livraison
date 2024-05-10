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
        Schema::create('remarques', function (Blueprint $table) {
            $table->string('id_Rem')->primary();
            $table->string('remarque');
            $table->enum('type', ['Information', 'Important', 'Urgence'])->default('Information');
            $table->enum('cible', ['Vendeur', 'Livreur', 'Equipe de suivi']);
            $table->enum('section', ['Accueil', 'Reclamations', 'List Colis',
            'Bons de livraison', 'Bon de retour', 'Factures'])->nullable();
            $table->string('id_Ad');
            $table->foreign('id_Ad')->references('id_Ad')->on('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remarques');
    }
};
