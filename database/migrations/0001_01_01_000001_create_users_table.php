<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id_U')->primary();
            // $table->string('FirstName');
            // $table->string('LastName');
            $table->string('email')->unique();
            // $table->string('Phone')->nullable();
            $table->string('password');
            $table->string('id_R'); // Foreign key column
            $table->foreign('id_R')->references('id_R')->on('roles'); // Updated to 'id_R'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
