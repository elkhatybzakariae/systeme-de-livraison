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
        Schema::create('clients', function (Blueprint $table) {
            $table->string('id_Cl')->primary();
            $table->string('logo');
            $table->string('nommagasin');
            $table->string('nomcomplet');
            $table->string('typeentreprise');
            $table->string('cin');
            $table->string('email')->unique();
            $table->string('Phone')->nullable();
            $table->string('ville');
            $table->string('villeRamassage')->nullable();
            $table->string('adress');
            $table->string('siteweb')->nullable();
            $table->string('nombanque')->nullable();
            $table->string('numerocompte')->nullable();
            $table->boolean('isAdmin');
            $table->string('password');
            $table->string('cinrecto');
            $table->string('cinverso');
            $table->string('RIB');
            $table->boolean('valider')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
