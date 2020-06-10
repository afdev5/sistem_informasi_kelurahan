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
            $table->string('nama_pegawai');
            $table->string('nip_pegawai');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('gambar');
            $table->enum('level_jabatan', ['0','1','2','3','4','5']); // 0.Lurah, 1.Sekretaris, 2.Kase Pemerintahan, 3.Kasie Pembangungan, 4.Kasie Keuangan, 5.Kasie Kesra
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
