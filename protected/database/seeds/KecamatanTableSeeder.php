<?php

use Illuminate\Database\Seeder;

class KecamatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kec = [
        	['kecamatan' => 'Tomohon Tengah',],
        ];

        DB::table('tbl_kecamatan')->insert($kec);
    }
}
