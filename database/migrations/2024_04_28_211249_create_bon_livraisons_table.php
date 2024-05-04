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
        Schema::create('bon_livraisons', function (Blueprint $table) {
            $table->string('id_BL', 15)->primary();
            $table->string('reference');
            $table->string('id_Cl');
            $table->foreign('id_Cl')->references('id_Cl')->on('clients');
            $table->string('status');
            // $table->string('id_C');
            // $table->foreign('id_C')->references('id_C')->on('colis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_livraisons');
    }
};
