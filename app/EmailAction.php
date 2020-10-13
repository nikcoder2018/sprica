<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailAction extends Model
{
    protected $table = "email_actions";
    protected $fillable = ['command_id','description'];

    function command(){
        return $this->hasOne(EmailCommand::class, 'id', 'command_id');
    }
}
