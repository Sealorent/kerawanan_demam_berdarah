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
        Schema::create('tb_kasus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kecamatan');
            $table->foreign('id_kecamatan')->references('id')->on('tm_kecamatan')->onDelete('cascade');
            $table->integer('total_kasus');
            $table->date('date');
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
        Schema::table('kasus', function (Blueprint $table) {
            //
        });
    }
};
