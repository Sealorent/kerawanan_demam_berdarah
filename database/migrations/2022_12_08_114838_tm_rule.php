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
        Schema::create('tm_rule', function (Blueprint $table) {
            $table->id();
            $table->string('ch');
            $table->string('hh');
            $table->string('abj');
            $table->string('hi');
            $table->string('kelembaban');
            $table->string('suhu');
            $table->string('potensi');
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
