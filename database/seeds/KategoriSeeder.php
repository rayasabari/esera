<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            [
                'nama' => 'Tanah & Bangunan',
            ],
            [
                'nama'  => 'Kendaraan',
            ]
        ];

        if(DB::table('kategori')->count() == 0){
            foreach($kategori as $kt){
                DB::table('kategori')->insert([
                    'nama' => $kt['nama'],
                ]);
            }
        }
        

    }
}
