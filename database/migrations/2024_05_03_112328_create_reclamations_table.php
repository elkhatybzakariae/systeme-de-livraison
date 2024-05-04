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
        Schema::create('reclamations', function (Blueprint $table) {
            $table->string('id_Rec')->primary();
            $table->string('objet');
            $table->boolean('etat')->default(0);
            $table->string('id_C');
            $table->foreign('id_C')->references('id')->on('colis');
            $table->string('id_Cl');
            $table->foreign('id_Cl')->references('id_Cl')->on('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamations');
    }
};
