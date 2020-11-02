<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeRead extends Model
{
    protected $table = 'notices_read';
    protected $fillable  = ['notice_id', 'user_id'];

    function notice(){
        return $this->hasOne(Notice::class, 'id', 'notice_id');
    }

    function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
