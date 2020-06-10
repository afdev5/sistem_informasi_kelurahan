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
            $table->foreign('kelurahan_id')->references('id')->on('tbl_kelurahan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('jenis_kelamin', 1)->nullable(); // 1.Laki-Laki 2.Perempuan
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->text('alamat')->nullable();
            $table->string('lingkungan', 3)->nullable();
            $table->string('rt', 4)->nullable();
            $table->string('rw', 4)->nullable();
            $table->string('pendidikan', 2)->nullable(); // 1. Tidak/Belum Sekolah, 2.Belum Tamat SD/Sederajat, 3.Tamat SD/Sederajat, 4.SLTP/Sederajat, 5.SLTA/Sederajat, 6.Diploma I/II, 7.Akademi/Diploma III/S.Muda, 8.Diploma IV/Strata I, 9.Strata II, 10.Strata III
            $table->string('umur', 3)->nullable();
            $table->string('pekerjaan')->nullable(); 
            $table->string('agama', 2)->nullable(); //1.Islam, 2.Kristen, 3.Katolik, 4.Budha, 5.Hindu
            $table->string('tgl')->nullable(); //seharusnya date
            $table->string('tl')->nullable();
            $table->string('status_kawin', 2)->nullable(); // 0.Belum Kawin, 1.Kawin, 2.Cerai Hidup, 3.Cerai Mati
            $table->string('status', 1)->nullable(); // 0.Meninggal, 1.Hidup
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
