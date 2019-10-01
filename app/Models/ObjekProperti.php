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

    public function pemilik()
    {
        return $this->hasOne('App\Models\Pemilik','id','id_pemilik');
    }
}
