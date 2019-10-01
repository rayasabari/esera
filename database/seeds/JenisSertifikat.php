<?php

use Illuminate\Database\Seeder;

class JenisSertifikat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sertifikat = [
            [
                'nama'      => 'Sertifikat Hak Milik',
                'singkatan' => 'SHM'
            ],
            [
                'nama'      => 'Sertifikat Hak Guna Bangunan',
                'singkatan' => 'SHGB'
            ],
            [
                'nama'      => 'Sertifikat Hak Guna Usaha',
                'singkatan' => 'SHGU'
            ],
            [
                'nama'      => 'Sertifikat Hak Satuan Rumah Susun',
                'singkatan' => 'SHSRS'
            ],
            [
                'nama'      => 'Sertifikat Hak Pakai',
                'singkatan' => 'SHP'
            ],
            [
                'nama'      => 'Sertifikat Hak Pengelolaan',
                'singkatan' => 'SHPL'
            ],
            [
                'nama'      => 'Surat Perjanjian Pengikatan Jual Beli',
                'singkatan' => 'PPJB'
            ],
            [
                'nama'      => 'Akta Jual Beli',
                'singkatan' => 'AJB'
            ],
            [
                'nama'      => 'Surat Girik',
                'singkatan' => ''
            ],
            [
                'nama'      => 'Lainnya',
                'singkatan' => ''
            ]
        ];

        if(DB::table('jenis_sertifikat')->count() == 0){
            foreach($sertifikat as $sert){
                DB::table('jenis_sertifikat')->insert([
                    'nama'          => $sert['nama'],
                    'singkatan'     => $sert['singkatan'],
                ]);
            }
        }
        
    }
}
