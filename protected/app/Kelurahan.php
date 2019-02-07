<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'tbl_kelurahan';
    protected $fillable = ['kecamatan_id', 'kelurahan', 'kode_pos', 'alamat_kantor', 'email', 'no_telp', 'website'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'kelurahan_id');
    }

    public function struktur_kelurahan()
    {
        return $this->hasMany(Struktur_Kelurahan::class, 'kelurahan_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'kelurahan_id');
    }
}
