<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblKegiatanKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kegiatan_kelurahan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kelurahan_id')->unsigned();
            $table->foreign('kelurahan_id')->references('id')->on('tbl_kelurahan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('gambar');
            $table->string('judul');
            $table->text('desc');
            $table->date('tgl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kegiatan_kelurahan');
    }
}
