<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_penduduk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kelurahan_id')->unsigned()->nullable();
            $table->foreign('kelurahan_id')->references('id')->on('tbl_kecamatan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nik');
            $table->string('nama');
            $table->string('no_kk');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->text('alamat');
            $table->integer('lingkungan');
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->string('pendidikan');
            $table->integer('umur');
            $table->string('pekerjaan');
            $table->enum('status_kawin', ['0', '1', '2', '3']); // 0.Belum Kawin, 1.Kawin, 2.Cerai Hidup, 3.Cerai Mati
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
        Schema::dropIfExists('tbl_penduduk');
    }
}
