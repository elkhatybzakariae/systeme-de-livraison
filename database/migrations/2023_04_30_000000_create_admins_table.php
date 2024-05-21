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
        Schema::create('admins', function (Blueprint $table) {
            $table->string('id_Ad')->primary();
            $table->string('nommagasin')->nullable();
            $table->string('nomcomplet');
            $table->string('email')->unique();
            $table->string('Phone')->nullable();
            $table->string('cin')->nullable();
            $table->string('ville');
            $table->string('adress');
            $table->string('nombanque')->nullable();
            $table->string('numerocompte')->nullable();
            $table->boolean('isAdmin')->default(0);
            $table->string('password');
            $table->string('user')->nullable();
            $table->foreign('user')->references('id_Ad')->on('admins');
            $table->enum('role',['Equipe de suivi','Admin','Moderateur'])->default('Equipe de suivi');
            $table->boolean('valider')->default(0);
            $table->string('photo')->nullable();
            $table->text('token')->nullable();
            $table->string('cinrecto')->nullable();
            $table->string('cinverso')->nullable();
            $table->string('RIB')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
