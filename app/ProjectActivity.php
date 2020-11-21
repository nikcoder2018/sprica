<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{
    protected $table = "projects_activity";
    protected $fillable = ['project_id','user_id', 'details'];

    function project(){
        return $this->hasOne(Project::class, 'ProjeID', 'project_id');
    }

    function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
