<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('colis', function (Blueprint $table) {
            $table->string('id_C')->primary();
            $table->string('code_d_envoi');
            $table->date('date_d_expedition');
            // $table->foreignId('client_id')->constrained('clients');
            $table->string('etat');
            $table->string('status');
            $table->string('ville_id');
            $table->foreign('ville_id')->on('villes')->references('id_V');
            $table->decimal('prix', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};
