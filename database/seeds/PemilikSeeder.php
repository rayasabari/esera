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
                'email'         => 'email@btn.co.id'
            ]);
            DB::table('pemilik')->insert([
                'first_name'    => 'Dapenbun',
                'last_name'     => '',
                'email'         => 'email@dapenbun.co.id'
            ]);
        }
    }
}