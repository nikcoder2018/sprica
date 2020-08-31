<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "genelayarlar";
    protected $primaryKey = 'GenelID';
    
    public $timestamps = false;
}
