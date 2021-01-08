<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table = 'projects';
    protected $fillable = ['client_id', 'title', 'number', 'description', 'category_id', 'department_id', 'budget', 'spent', 'start_date', 'deadline', 'status', 'vacation', 'default'];
    protected $appends = ['hours'];

    function members(){
        return $this->belongsToMany(User::class);
    }

    function tasks(){
        return $this->hasMany(Task::class, 'project_id', 'id')->with('assigned');
    }

    function tasks_completed(){
        return $this->hasMany(Task::class, 'project_id', 'id')->where('status','completed'); 
    }

    function timelogs(){
        return $this->hasMany(Timelog::class, 'project_id', 'id');
    }

    function client(){
        return $this->belongsTo(Client::class);
    }

    function getHoursAttribute(){
        return $this->timelogs()->sum('duration');
    }

    function activities(){
        return $this->hasMany(ProjectActivity::class, 'project_id', 'id')->with('user');
    }
}
