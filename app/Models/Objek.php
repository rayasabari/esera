<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objek extends Model
{
    //
    protected $table = 'master_objek';
    protected $fillable = ['nama', 'id_kategori','id_pemilik','luas_tanah','luas_bangunan','harga_limit','jaminan','deskripsi'];
}
