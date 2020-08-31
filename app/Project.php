<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table = 'projeler';
    protected $fillable = ['ProjeBASLIK', 'ProjeKODU'];

    public $timestamps = false;
}
