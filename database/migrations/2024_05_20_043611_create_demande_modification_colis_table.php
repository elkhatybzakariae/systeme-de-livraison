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
        Schema::create('demande_modification_colis', function (Blueprint $table) {
            $table->string('id_DMC')->primary();            
            $table->string('destinataire');
            $table->string('telephone');
            $table->string('adresse');
            $table->text('commentaire')->nullable();
            $table->decimal('prix', 8, 2);
            $table->enum('isAccepted', [
                'Nouveau','Annule', 'Accepte'
            ])->default('Nouveau');;
            // $table->boolean('fragile');
            // $table->boolean('ouvrir');
            $table->string('id');
            $table->foreign('id')->on('colis')->references('id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_modification_colis');
    }
};
