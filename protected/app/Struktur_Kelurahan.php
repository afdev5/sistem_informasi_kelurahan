<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Struktur_Kelurahan extends Model
{
    protected $table = 'tbl_struktur_kelurahan';
    protected $fillable = ['kelurahan_id', 'nama_pegawai', 'nip_pegawai', 'jenis_kelamin', 'agama', 'level_jabatan', 'gambar'];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }
}
