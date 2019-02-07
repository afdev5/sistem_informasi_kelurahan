<?php

use Illuminate\Database\Seeder;

class KelurahanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kel = [
        	[
             'kecamatan_id' => '1',
             'kelurahan' => 'Matani 1',
             'kode_pos' => '123',
             'alamat_kantor' => 'Sebelah kiri',
             'email' => 'matani1@gmail.com',
             'no_telp' => '123',
             'website' => 'matani1.tomohon.go.id'
            ],
        ];

        DB::table('tbl_kelurahan')->insert($kel);
    }
}
