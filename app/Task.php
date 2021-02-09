<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";
    protected $fillable = ['project_id','title', 'description', 'start_date', 'due_date', 'status', 'priority'];

    function assigned(){
        return $this->hasMany(TaskAssignment::class, 'task_id', 'id');
    }

    function project(){
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
