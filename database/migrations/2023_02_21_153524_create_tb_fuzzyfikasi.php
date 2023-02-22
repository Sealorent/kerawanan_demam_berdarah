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
        Schema::create('tb_fuzzyfikasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_fuzzy');
            $table->string('curah_hujan');
            $table->string('hari_hujan');
            $table->string('abj');
            $table->string('suhu');
            $table->string('kelembaban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fuzzyfikasi', function (Blueprint $table) {
            //
        });
    }
};
