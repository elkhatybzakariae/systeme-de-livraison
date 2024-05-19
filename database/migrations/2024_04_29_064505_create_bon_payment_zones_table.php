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
        Schema::create('bon_payment_zones', function (Blueprint $table) {
            $table->string('id_BPZ', 15)->primary();
            $table->string('reference');
            $table->string('id_Z');
            $table->foreign('id_Z')->references('id_Z')->on('zones');
        
            $table->string('status')->default('Attente Paiement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_payment_zones');
    }
};
