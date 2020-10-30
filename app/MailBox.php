<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailBox extends Model
{
    protected $table = "mailbox";
    
    function receiver(){
        return $this->hasOne(User::class, 'id', 'to');
    }
    function sender(){
        return $this->hasOne(User::class, 'id', 'from');
    }
}
