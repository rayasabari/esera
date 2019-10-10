<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table  = 'user_info';

    public function provinsi()
    {
        return $this->hasOne('App\Models\IndonesiaProvinsi','id','id_provinsi');
    }

    public function kota()
    {
        return $this->hasOne('App\Models\IndonesiaKota','id','id_kota');
    }

    public function kecamatan()
    {
        return $this->hasOne('App\Models\IndonesiaKecamatan','id','id_kecamatan');
    }

    public function kelurahan()
    {
        return $this->hasOne('App\Models\IndonesiaKelurahan','id','id_kelurahan');
    }
}
