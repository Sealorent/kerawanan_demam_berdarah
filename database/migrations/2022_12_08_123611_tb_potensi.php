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
        Schema::create('tb_potensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kecamatan');
            $table->foreign('id_kecamatan')->references('id')->on('tm_kecamatan')->onDelete('cascade');
            $table->unsignedBigInteger('id_vektor');
            $table->foreign('id_vektor')->references('id')->on('tb_vektor')->onDelete('cascade');
            $table->unsignedBigInteger('id_klimatologi');
            $table->foreign('id_klimatologi')->references('id')->on('tb_klimatologi')->onDelete('cascade');
            $table->unsignedBigInteger('id_fuzzy');
            $table->foreign('id_fuzzy')->references('id')->on('tb_fuzzy');
            $table->unsignedBigInteger('id_ga');
            $table->foreign('id_ga')->references('id')->on('tb_ga');
            $table->date('date');
            $table->integer('triwulan');
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
        //
    }
};
