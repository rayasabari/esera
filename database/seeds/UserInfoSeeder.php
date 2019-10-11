<?php

use Illuminate\Database\Seeder;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('user_info')->count() == 0){
            DB::table('user_info')->insert([
                'id_status_user'    => 1,
                'id_user'           => 1,
                'alamat'            => 'Jl. Raya Jatinegara Timur No.91, RT.6/RW.6',
                'id_kelurahan'      => 25492,
                'id_kecamatan'      => 3172060,
                'id_kota'           => 3172,
                'id_provinsi'       => 31,
                'kode_pos'          => '13310',
                'no_telepon'        => '(021) 2801314',
                'no_fax'            => null,
                'no_ktp'            => '0123123123123',
                'npwp'              => '191239019283',
                'no_rekening'       => '9817239786917',
                'nama_bank'         => 'BTN',
                'cabang_bank'       => 'Jatinegara',
                'atas_nama_bank'    => 'Bank Tabungan Negara',
                'created_at'        => '2019-10-11 12:17:36',
                'updated_at'        => '2019-10-11 12:17:36'
            ]);
            DB::table('user_info')->insert([
                'id_status_user'    => 1,
                'id_user'           => 2,
                'alamat'            => 'Gedung Agro Plaza Lt. 10, Jl. H. R. Rasuna Said No.1, RT.7/RW.4',
                'id_kelurahan'      => 25455,
                'id_kecamatan'      => 3171100,
                'id_kota'           => 3171,
                'id_provinsi'       => 31,
                'kode_pos'          => '12950',
                'no_telepon'        => '(021) 57938897',
                'no_fax'            => null,
                'no_ktp'            => '0123123123123',
                'npwp'              => null,
                'no_rekening'       => '981721233123',
                'nama_bank'         => 'BCA',
                'cabang_bank'       => 'Kuningan',
                'atas_nama_bank'    => 'Dapenbun',
                'created_at'        => '2019-10-11 12:22:17',
                'updated_at'        => '2019-10-11 12:22:17'
            ]);
        }
    }
}
