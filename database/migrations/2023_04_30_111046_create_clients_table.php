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
            $table->string('logo')->nullable();
            $table->string('nommagasin');
            $table->string('nomcomplet');
            $table->string('typeentreprise');
            $table->string('cin');
            $table->string('email')->unique();
            $table->string('Phone')->nullable();
            $table->string('ville')->nullable();
            $table->foreign('ville')->on('villes')->references('id_V');
            // $table->string('villeRamassage')->nullable();
            // $table->foreign('villeRamassage')->on('villes')->references('id_V');
            $table->string('adress');
            $table->string('siteweb')->nullable();
            $table->string('nombanque')->nullable();
            $table->string('numerocompte')->nullable();
            $table->boolean('isActive')->default(0);
            $table->boolean('isAdmin')->default(0);
            $table->boolean('isAccepted')->default(0);
            $table->string('password');
            $table->text('token')->nullable();
            $table->string('user')->nullable();
            $table->foreign('user')->references('id_Cl')->on('clients');
            $table->string('acceptedBy')->nullable();
            $table->foreign('acceptedBy')->references('id_Ad')->on('admins');
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
