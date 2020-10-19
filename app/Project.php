<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $primaryKey = 'ProjeID';
    protected $table = 'projeler';
    protected $fillable = ['ProjeBASLIK', 'ProjeKODU'];

    function tasks(){
        return $this->hasMany(Task::class, 'project_id', 'ProjeID')->with('assigned');
    }

    function tasks_completed(){
        return $this->hasMany(Task::class, 'project_id', 'ProjeID')->where('status','completed'); 
    }
}
