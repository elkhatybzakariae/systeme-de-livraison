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
        Schema::create('messages', function (Blueprint $table) {
            $table->string('id_Mess')->primary();
            $table->string('message');
            $table->string('id_Rec');
            $table->foreign('id_Rec')->references('id_Rec')->on('reclamations');
            $table->string('id_Ad')->nullable();
            // $table->foreign('id_Ad')->references('id_Ad')->on('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
