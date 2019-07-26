<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTlaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlaporans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('tanggal');
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
        Schema::dropIfExists('tlaporans');
    }
}
