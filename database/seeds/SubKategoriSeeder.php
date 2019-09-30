<?php

use Illuminate\Database\Seeder;

class SubKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subkat = [
            [
                'id_kategori'   => '1',
                'nama'          => 'Tanah',
            ],
            [
                'id_kategori'   => '1',
                'nama'          => 'Rumah',
            ],
            [
                'id_kategori'   => '1',
                'nama'          => 'Ruko',
            ],
            [
                'id_kategori'   => '2',
                'nama'          => 'Mobil',
            ]
        ];

        if(DB::table('sub_kategori')->count() == 0 ){
            foreach($subkat  as $sb){
                DB::table('sub_kategori')->insert([
                    'id_kategori'   => $sb['id_kategori'],
                    'nama'          => $sb['nama'],
                ]);
            }
        }
    }
}
