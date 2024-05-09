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
        Schema::create('ramassagecolis', function (Blueprint $table) {
            $table->string('id_Ram')->primary();
            $table->string('remarque');
            $table->string('telephone');
            $table->string('adresse');
            $table->string('type')->default('Ramassage Colis');
            $table->string('ville');
            $table->enum('etat', ['Nouvelle demande', 'Demande recue', 'Demande traitee'])->default('Nouvelle demande');
            $table->string('id_Cl')->nullable();
            $table->foreign('id_Cl')->references('id_Cl')->on('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ramassagecolis');
    }
};
