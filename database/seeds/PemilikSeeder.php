<?php

use Illuminate\Database\Seeder;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('pemilik')->count() == 0){
            DB::table('pemilik')->insert([
                'first_name'    => 'Bank',
                'last_name'     => 'BTN',
                'email'         => 'btn@btn.co.id',
                'created_at'    => '2019-10-11 12:17:36',
                'updated_at'    => '2019-10-11 12:17:36'
            ]);
            DB::table('pemilik')->insert([
                'first_name'    => 'Dapenbun',
                'last_name'     => '',
                'email'         => 'email@dapenbun.co.id',
                'created_at'    => '2019-10-11 12:22:17',
                'updated_at'    => '2019-10-11 12:22:17'
            ]);
        }
    }
}