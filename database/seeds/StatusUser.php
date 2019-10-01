<?php

use Illuminate\Database\Seeder;

class StatusUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'nama' => 'Pemilik',
            ],
            [
                'nama'  => 'Bidder',
            ],
        ];
        
        if(DB::table('status_user')->count() ==  0){
            foreach($status  as $stt){
                DB::table('status_user')->insert([
                    'nama'          => $stt['nama'],
                ]);
            }
        }
    }
}
