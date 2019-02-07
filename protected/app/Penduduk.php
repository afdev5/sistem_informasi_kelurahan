<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'tbl_penduduk';
    protected $fillable = ['kelurahan_id', 'nik', 'nama', 'no_kk', 'nama_ayah', 'nama_ibu', 'alamat', 'lingkungan', 'rt', 'rw', 'pendidikan', 'umur', 'pekerjaan', 'status_kawin'];


    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

}
