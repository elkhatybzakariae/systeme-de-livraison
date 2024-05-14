<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('colis', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('code_d_envoi');
            $table->date('date_d_expedition')->nullable();
            $table->string('destinataire');
            $table->string('id_Cl');
            $table->foreign('id_Cl')->on('clients')->references('id_Cl');
            $table->string('telephone');
            $table->string('marchandise');
            $table->string('etat')->default('non paye');
            $table->enum('status',['nouveau','en livraison','Attente de Ramassage','Ramasse','en voyage','recu','livraison','distribution','livre'])->default('nouveau');
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

            $table->string('id_BL')->nullable();
            $table->foreign('id_BL')->on('bon_livraisons')->references('id_BL');
            $table->string('id_BE')->nullable();
            $table->foreign('id_BE')->on('bon_envois')->references('id_BE');
            $table->string('id_BD')->nullable();
            $table->foreign('id_BD')->on('bon_distributions')->references('id_BD');
            $table->string('id_BPL')->nullable();
            $table->foreign('id_BPL')->on('bon_payment_livreurs')->references('id_BPL');
            // $table->string('id_BD')->nullable();
            // $table->foreign('id_BD')->on('bon_distributions')->references('id_BD');

            $table->timestamps();

        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};
