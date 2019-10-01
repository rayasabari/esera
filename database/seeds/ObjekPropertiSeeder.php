<?php

use Illuminate\Database\Seeder;

class ObjekPropertiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('objek_properti')->count() == 0){
            DB::table('objek_properti')->insert(
                [
                    'id_kategori'       => 1,
                    'id_sub_kategori'   => 2,
                    'nama'              => 'Rumah Tinggal',
                    'alamat'            => 'Jln. Karet Karya VII No. 8',
                    'id_kelurahan'      => 25456,
                    'id_kecamatan'      => 3171100,
                    'id_kota'           => 3171,
                    'id_provinsi'       => 31,
                    'kode_pos'          => '12920',
                    'tipe'              => 'Tipe 36',
                    'luas_tanah'        => 72,
                    'luas_bangunan'     => 36,
                    'luas_unit'         => null,
                    'jumlah_lantai'     => 1,
                    'kamar_tidur'       => 2,
                    'kamar_mandi'       => 1,
                    'id_sertifikat'     => 1,
                    'id_pemilik'        => 1,
                    'deskripsi'         => '',
                    'harga_limit'       => 280000000,
                    'jaminan'           => 56000000
                ]
            );
            DB::table('objek_properti')->insert(
                [
                    'id_kategori'       => 1,
                    'id_sub_kategori'   => 2,
                    'nama'              => 'Rumah Tinggal',
                    'alamat'            => 'Jln. Karet Karya VII No. 7',
                    'id_kelurahan'      => 25456,
                    'id_kecamatan'      => 3171100,
                    'id_kota'           => 3171,
                    'id_provinsi'       => 31,
                    'kode_pos'          => '12920',
                    'tipe'              => 'Tipe 46',
                    'luas_tanah'        => 84,
                    'luas_bangunan'     => 46,
                    'luas_unit'         => null,
                    'jumlah_lantai'     => 1,
                    'kamar_tidur'       => 2,
                    'kamar_mandi'       => 1,
                    'id_sertifikat'     => 1,
                    'id_pemilik'        => 2,
                    'deskripsi'         => '',
                    'harga_limit'       => 370000000,
                    'jaminan'           => 74000000
                ]
            );
        }
    }
}
