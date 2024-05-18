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
        Schema::create('bon_retour_clients', function (Blueprint $table) {
            $table->string('id_BRC', 15)->primary();
            $table->string('reference');
            $table->string('id_CL');
            $table->foreign('id_CL')->references('id_CL')->on('clients');
           
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_retour_clients');
    }
};
