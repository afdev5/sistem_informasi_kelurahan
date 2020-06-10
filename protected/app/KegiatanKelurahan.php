<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KegiatanKelurahan extends Model
{
    protected $table = 'tbl_kegiatan_kelurahan';
    protected $fillable = ['kelurahan_id', 'gambar', 'judul', 'desc', 'tgl'];
    public $timestamps = false;

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }
}
