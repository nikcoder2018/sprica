<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacationDay extends Model
{
    protected $primaryKey = "GunID";
    protected $table = "tatilgunleri";
    protected $fillable = ['Tarih','GunBASLIK'];

    public $timestamps = false;
}
