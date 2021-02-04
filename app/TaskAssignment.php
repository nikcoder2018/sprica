<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    protected $table = 'tasks_assignment';
    protected $fillable = ['task_id', 'assign_to'];

    function user(){
        return $this->belongsToMany(User::class, 'assign_to', 'id');
    }

    function task(){
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
