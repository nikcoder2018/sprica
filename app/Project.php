<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $primaryKey = 'ProjeID';
    protected $table = 'projeler';
    protected $fillable = ['ProjeBASLIK', 'ProjeKODU'];

    // function members(){
    //     return $this->hasMany(User::class, 'ProjeID', '')
    // }
}
