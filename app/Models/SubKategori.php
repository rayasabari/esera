<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    //
    protected $table = 'sub_kategori';
    public function kategori()
    {
        return $this->hasOne('App\Models\Kategori','id','id_kategori');
    }

}
