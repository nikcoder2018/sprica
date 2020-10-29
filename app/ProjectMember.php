<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $table = "project_members";
    protected $fillable = ['project_id', 'user_id'];

    public $timestamps = false;

    function project(){
        return $this->hasOne(Project::class, 'ProjeID', 'project_id');
    }
    function member_detail(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
