<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function advertisement(){
        return $this->belongsTo('App\Advertisement');
    }
}
