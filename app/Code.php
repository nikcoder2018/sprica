<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    //
    protected $table = "kodlar";
    protected $fillable = ['Kod','KodBASLIK','Parabir','Paraiki','Yatti'];

    public $timestamps = false;
}
