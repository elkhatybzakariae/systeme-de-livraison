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
        Schema::create('bon_envois', function (Blueprint $table) {
           
            $table->string('id_BE', 15)->primary();
            $table->string('reference');
            // $table->string('id_Cl');
            // $table->foreign('id_Cl')->references('id_Cl')->on('clients');
            $table->string('id_Liv')->nullable();
            $table->foreign('id_Liv')->references('id_Liv')->on('livreurs');
            $table->string('status');
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('bon_envois');
    }
};
