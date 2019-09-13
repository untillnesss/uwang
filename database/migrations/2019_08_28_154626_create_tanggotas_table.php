<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTanggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nama');
            $table->text('email');
            $table->text('password')->nullable();
            $table->unsignedBigInteger('idLevel');
            $table->text('status');
            $table->text('kode');
            $table->unsignedBigInteger('idUser');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idLevel')->references('id')->on('tlevels')->onDelete('cascade');
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
        Schema::dropIfExists('tanggotas');
    }
}
