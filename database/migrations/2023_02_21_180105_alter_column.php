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
        Schema::table('tb_fuzzyfikasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_fuzzy')->foreign('id_fuzzy')->references('id')->on('tb_fuzzy')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_fuzzyfikasi', function (Blueprint $table) {
            //
        });
    }
};
