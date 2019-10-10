<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';

    public function user_info(){
        return $this->hasOne('App\Models\UserInfo', 'id_user', 'id');
    }
}
