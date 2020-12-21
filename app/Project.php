<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table = 'projects';
    protected $fillable = ['client_id', 'title', 'number', 'description', 'category_id', 'department_id', 'budget', 'spent', 'start_date', 'deadline', 'status', 'vacation', 'default'];

    // function members(){
    //     return $this->hasMany(ProjectMember::class, 'project_id', 'ProjeID')->with('member_detail');
    // }
    // function tasks(){
    //     return $this->hasMany(Task::class, 'project_id', 'ProjeID')->with('assigned');
    // }

    // function tasks_completed(){
    //     return $this->hasMany(Task::class, 'project_id', 'ProjeID')->where('status','completed'); 
    // }

    // function timelogs(){
    //     return $this->hasMany(Watches::class, 'ProjeID', 'ProjeID')->with('user');
    // }

    // function activities(){
    //     return $this->hasMany(ProjectActivity::class, 'project_id', 'ProjeID')->with('user');
    // }
}
