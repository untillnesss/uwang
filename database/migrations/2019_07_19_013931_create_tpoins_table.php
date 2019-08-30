<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTpoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpoins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('jenis');
            $table->text('nama');
            $table->text('banyak');
            $table->text('harga');
            $table->text('jumlah');
            $table->text('saldo')->nullable();
            $table->unsignedBigInteger('idLaporan');
            $table->unsignedBigInteger('idUser');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idLaporan')->references('id')->on('tlaporans')->onDelete('cascade');
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
        Schema::dropIfExists('tpoins');
    }
}
