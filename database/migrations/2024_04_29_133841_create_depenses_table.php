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
        Schema::create('depenses', function (Blueprint $table) {
            $table->string('id_Dep')->primary();
            $table->string('depense');
            $table->text('description');
            $table->integer('montant');
            $table->date('datedep');
            $table->string('id_Ad');
            $table->foreign('id_Ad')->references('id_Ad')->on('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
