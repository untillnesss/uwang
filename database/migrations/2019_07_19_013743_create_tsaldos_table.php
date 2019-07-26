<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsaldos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('jumlah');
            $table->unsignedBigInteger('idUser');
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('tusers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tsaldos');
    }
}
