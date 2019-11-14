<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjekProperti extends Model
{
    
    protected $table = 'objek_properti';

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
        return $this->hasOne('App\Models\Pemilik','id','id_pemilik');
    }

    public function status_objek()
    {
        return $this->hasOne('App\Models\StatusObjek','id','id_status_objek');
    }

    public function foto_utama()
    {
        return $this->hasOne('App\Models\AttachmentFoto','id_objek','id')->where('id_kategori', 1);
    }

    public function foto()
    {
        return $this->hasMany('App\Models\AttachmentFoto','id_objek','id')->where('id_kategori', 1);
    }

    public function dokumen()
    {
        return $this->hasMany('App\Models\AttachmentDokumen','id_objek','id')->where('id_kategori', 1);
    }
}
