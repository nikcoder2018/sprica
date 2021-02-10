<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    protected $fillable = ['task_id', 'assign_to'];

    function user(){
        return $this->belongsToMany(User::class);
    }

    function task(){
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
