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
    // public function up()
    // {
    //     Schema::table('roles', function (Blueprint $table) {
    //         $table->id("id_R");
    //         // $table->id();
    //         $table->string('role_name');
    //     });
    // }
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->string('id_R')->primary();
            $table->string('role_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
