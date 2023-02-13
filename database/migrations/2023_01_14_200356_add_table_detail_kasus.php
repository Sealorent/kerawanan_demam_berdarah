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
        Schema::create('tb_detail_kasus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kasus');
            $table->foreign('id_kasus')->references('id')->on('tb_kasus')->onDelete('cascade');
            $table->string('nama_penderita');
            $table->double('longitude',11,7);
            $table->double('latitude',11,7);
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
        Schema::table('tb_detail_kasus', function (Blueprint $table) {
            //
        });
    }
};
