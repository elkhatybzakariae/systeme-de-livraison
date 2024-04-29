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
        Schema::create('tarifs', function (Blueprint $table) {
            $table->string('id_Tar')->primary();
            $table->string('villeRamassage');
            $table->string('ville');
            $table->foreign('villeRamassage')->on('villes')->references('id_V');
            $table->foreign('ville')->on('villes')->references('id_V');
            $table->float('prixliv');
            $table->float('prixret');
            $table->float('prixref');
            $table->string('delailiv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifs');
    }
};
