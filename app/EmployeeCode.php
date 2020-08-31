<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeCode extends Model
{
    protected $table = 'personelkod';
    protected $fillable = ['PersonelID', 'KodID'];

    public $timestamps = false;
}
