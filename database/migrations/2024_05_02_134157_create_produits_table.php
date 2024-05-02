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
        Schema::create('produits', function (Blueprint $table) {
            $table->string('id_Pro')->primary();
            $table->string('imgpro');
            $table->string('nompro');
            $table->string('refpro');
            $table->integer('quantitie');
            $table->text('description');
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
        Schema::dropIfExists('produits');
    }
};
