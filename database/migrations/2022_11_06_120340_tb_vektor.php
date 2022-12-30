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
        Schema::create('tb_vektor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kecamatan');
            $table->foreign('id_kecamatan')->references('id')->on('tm_kecamatan')->onDelete('cascade');
            $table->integer('rumah_diperiksa');
            $table->integer('rumah_positif');
            $table->float('hi');
            $table->float('abj');
            $table->integer('kasus_dbd');
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
