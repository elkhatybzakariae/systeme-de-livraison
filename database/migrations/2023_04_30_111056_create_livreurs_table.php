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
        Schema::create('livreurs', function (Blueprint $table) {
            $table->string('id_Liv')->primary();
            $table->string('nomcomplet');
            $table->string('cin');
            $table->string('email')->unique();
            $table->string('Phone')->nullable();
            $table->string('ville');
            $table->string('adress');
            $table->integer('fraislivraison');
            $table->integer('fraisrefus');
            $table->string('nombanque')->nullable();
            $table->string('numerocompte')->nullable();
            $table->string('password');
            $table->string('cinrecto');
            $table->string('cinverso');
            $table->string('RIB');
            $table->boolean('isAccepted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livreurs');
    }
};
