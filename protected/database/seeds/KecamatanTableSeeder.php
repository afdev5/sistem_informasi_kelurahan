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
            ['kecamatan' => 'Tomohon Barat',],
            ['kecamatan' => 'Tomohon Selatan',],
            ['kecamatan' => 'Tomohon Timur',],
            ['kecamatan' => 'Tomohon Utara',],
        ];

        DB::table('tbl_kecamatan')->insert($kec);
    }
}
