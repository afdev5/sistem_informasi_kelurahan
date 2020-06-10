<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblInfokelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_infokelurahan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kelurahan_id')->unsigned();
            $table->foreign('kelurahan_id')->references('id')->on('tbl_kelurahan')->onDelete('cascade')->onUpdate('cascade');
            $table->text('visi');
            $table->text('misi');
            $table->text('sejarah');
            $table->string('luas_wilayah');
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
        Schema::dropIfExists('tbl_infokelurahan');
    }
}
