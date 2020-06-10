<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblWilayahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_wilayah', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kelurahan_id')->unsigned();
            $table->foreign('kelurahan_id')->references('id')->on('tbl_kelurahan')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('bagian', ['1','2','3','4']); // 1.Utara, 2.Timur, 3.Selatan, 4.Barat
            $table->string('batas');
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
        Schema::dropIfExists('tbl_wilayah');
    }
}
