<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblStrukturKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_struktur_kelurahan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kelurahan_id')->unsigned()->nullable();
            $table->foreign('kelurahan_id')->references('id')->on('tbl_kecamatan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('jabatan');
            $table->string('nama_pegawai');
            $table->string('nip_pegawai');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('masa_jabatan');
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
        Schema::dropIfExists('tbl_struktur_kelurahan');
    }
}
