<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoKelurahan extends Model
{
    protected $table = 'tbl_infokelurahan';
    protected $fillable = ['kelurahan_id', 'visi', 'misi', 'sejarah','luas_wilayah'];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }
}
