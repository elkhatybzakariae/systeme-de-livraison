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
        Schema::create('villes', function (Blueprint $table) {
            $table->string('id_V')->primary();
            $table->string('ref');
            $table->string('villename');
            $table->boolean('statut')->default(1);
            $table->string('id_Z');
            $table->foreign('id_Z')->references('id_Z')->on('zones');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villes');
    }
};
