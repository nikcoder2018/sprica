<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";
    protected $fillable = ['requester_user_id','project_id','type','priority','subject','description','status'];

    function requester(){
        return $this->hasOne(User::class, 'id', 'requester_user_id');
    }
}
