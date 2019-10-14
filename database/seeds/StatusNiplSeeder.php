<?php

use Illuminate\Database\Seeder;

class StatusNiplSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('status_nipl')->count() == 0){
            DB::table('status_nipl')->insert([
                'nama'          => 'Aktif',
                'created_at'    => '2019-10-11 12:17:36',
                'updated_at'    => '2019-10-11 12:17:36'
            ]);
            DB::table('status_nipl')->insert([
                'nama'          => 'Nonaktif',
                'created_at'    => '2019-10-11 12:22:17',
                'updated_at'    => '2019-10-11 12:22:17'
            ]);
        }
    }
}
