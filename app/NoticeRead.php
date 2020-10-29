<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeRead extends Model
{
    protected $table = 'notices_read';
    protected $fillable  = ['notice_id', 'user_id'];
}
