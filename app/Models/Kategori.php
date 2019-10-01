<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $table = 'kategori';

    public function subkategori()
    {
        return $this->hasMany('App\Models\SubKategori','id_kategori','id');
    }
}
