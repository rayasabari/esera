<?php

use Illuminate\Database\Seeder;

class StatusObjekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('status_objek')->count() == 0){
            DB::table('status_objek')->insert([
                'nama'    => 'Unlisted'
            ]);
            DB::table('status_objek')->insert([
                'nama'    => 'Listed'
            ]);
            DB::table('status_objek')->insert([
                'nama'    => 'Sold'
            ]);
        }
    }
}
