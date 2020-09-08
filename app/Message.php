<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    function from(){
        return $this->hasOne(User::class, 'id', 'from_id');
    }
    function to(){
        return $this->hasOne(User::class, 'id', 'to_id');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];
}
