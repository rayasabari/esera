<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'listing';

    public function kategori()
    {
        return $this->hasOne('App\Models\Kategori','id','id_kategori');
    }

    public function sub_kategori()
    {
        return $this->hasOne('App\Models\SubKategori','id','id_sub_kategori');
    }

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

    public function sertifikat()
    {
        return $this->hasOne('App\Models\JenisSertifikat','id','id_sertifikat');
    }

    public function pemilik()
    {
        return $this->hasOne('App\Models\Pemilik','id', 'id_pemilik' );
    }

    public function status_objek()
    {
        return $this->hasOne('App\Models\StatusObjek','id','id_status_objek');
    }

    public function objek_properti()
    {
        return $this->hasOne('App\Models\ObjekProperti','id','id_objek');
    }

    public function last_bid()
    {
        return $this->hasOne('App\Models\Bid','id_listing','id');
    }

    public function bid()
    {
        return $this->hasMany('App\Models\Bid','id_listing','id');
    }

}
