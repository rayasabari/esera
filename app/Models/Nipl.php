<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nipl extends Model
{
    protected $table = 'nipl';

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }

    public function status_nipl(){
        return $this->hasOne('App\Models\StatusNipl', 'id', 'id_status_nipl');
    }
}
