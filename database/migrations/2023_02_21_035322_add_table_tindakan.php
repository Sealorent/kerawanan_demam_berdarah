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
        Schema::create('tb_tindakan', function (Blueprint $table) {
            $table->id();
            $table->enum('potensi',['rendah','sedang','tinggi']);
            $table->longText('tindakan');
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
        Schema::table('tb_tindakan', function (Blueprint $table) {
            //
        });
    }
};
