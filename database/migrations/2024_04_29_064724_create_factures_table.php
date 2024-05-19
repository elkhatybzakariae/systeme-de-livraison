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
        Schema::create('factures', function (Blueprint $table) {
            $table->string('id_F', 15)->primary();
            $table->string('reference');
            $table->date('date_paiment');
            $table->string('id_CL');
            $table->foreign('id_CL')->references('id_CL')->on('clients');
            $table->string('id_Ad');
            $table->foreign('id_Ad')->references('id_Ad')->on('admins');
            $table->string('status')->default('Brouillon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
