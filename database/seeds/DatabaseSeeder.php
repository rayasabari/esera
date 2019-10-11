<?php

use App\Models\StatusObjek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(SubKategoriSeeder::class);
        $this->call(StatusUser::class);
        $this->call(JenisSertifikat::class);
        $this->call(ObjekPropertiSeeder::class);
        $this->call(PemilikSeeder::class);
        $this->call(ObjekKendaraan::class);
        $this->call(StatusObjekSeeder::class);
        $this->call(UserInfoSeeder::class);

        Model::reguard();
    }
}
