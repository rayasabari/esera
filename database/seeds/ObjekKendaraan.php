<?php

use Illuminate\Database\Seeder;

class ObjekKendaraan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('objek_kendaraan')->count() == 0){
            DB::table('objek_kendaraan')->insert(
                [
                    'id_kategori'       => 2,
                    'id_sub_kategori'   => 4,
                    'nama'              => 'Honda BR-V E Prestige',
                    'alamat'            => 'Jln. Karet Karya VII No. 8',
                    'id_kelurahan'      => 25456,
                    'id_kecamatan'      => 3171100,
                    'id_kota'           => 3171,
                    'id_provinsi'       => 31,
                    'kode_pos'          => '12920',
                    'id_jenis_kendaraan'=> 1,
                    'merk'              => 'Honda',
                    'model'             => 'BR-V',
                    'varian'            => 'E Prestige',
                    'tahun'             => 2016,
                    'transmisi'         => 'Automatic',
                    'cakupan_mesin'     => 1497,
                    'penumpang'         => 7,
                    'kilometer'         => '65000-70000',
                    'warna'             => 'Hitam',
                    'id_pemilik'        => 2,
                    'deskripsi'         => '',
                    'harga_limit'       => 150000000,
                    'jaminan'           => 30000000
                ]
            );
            DB::table('objek_kendaraan')->insert(
                [
                    'id_kategori'       => 2,
                    'id_sub_kategori'   => 4,
                    'nama'              => 'Mazda CX-5 Touring',
                    'alamat'            => 'Jln. Karet Karya VII No. 7',
                    'id_kelurahan'      => 25456,
                    'id_kecamatan'      => 3171100,
                    'id_kota'           => 3171,
                    'id_provinsi'       => 31,
                    'kode_pos'          => '12920',
                    'id_jenis_kendaraan'=> 1,
                    'merk'              => 'Mazda',
                    'model'             => 'CX-5',
                    'varian'            => 'Touring',
                    'tahun'             => 2014,
                    'transmisi'         => 'Automatic',
                    'cakupan_mesin'     => 2488,
                    'penumpang'         => 5,
                    'kilometer'         => '75000-80000',
                    'warna'             => 'Putih',
                    'id_pemilik'        => 2,
                    'deskripsi'         => '',
                    'harga_limit'       => 215000000,
                    'jaminan'           => 43000000
                ]
            );
        }
    }
}
