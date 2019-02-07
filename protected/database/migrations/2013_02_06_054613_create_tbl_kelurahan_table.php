<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelurahan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kecamatan_id')->unsigned();
            $table->foreign('kecamatan_id')->references('id')->on('tbl_kecamatan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kelurahan');
            $table->integer('kode_pos');
            $table->string('alamat_kantor');
            $table->string('email')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('tbl_kelurahan');
    }
}
