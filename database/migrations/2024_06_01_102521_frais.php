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
        Schema::create('frais', function (Blueprint $table) {
            $table->string('id_Fr')->primary();            
            $table->string('title');
            $table->integer('quntite');            
            $table->decimal('prix', 8, 2);            
            $table->string('id_F');
            $table->foreign('id_F')->on('factures')->references('id_F');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frais');
    }
};
