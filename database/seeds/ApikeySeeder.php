<?php

use Illuminate\Database\Seeder;

class ApikeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('apikey')->count() == 0){
            DB::table('apikey')->insert([
                'nama'    => 'Google',
                'key'     => 'AIzaSyAI3teHsTtMtBRrHiHG07PXaOH99ZuME30',
            ]);
        }
    }
}
