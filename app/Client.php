<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //

    function projects(){
        return $this->hasMany(Projects::class);
    }
}
