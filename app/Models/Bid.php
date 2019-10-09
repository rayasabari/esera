<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bid';

    public function nipl(){
        return $this->hasOne('App\Models\Nipl', 'id', 'id_nipl');
    }

}
