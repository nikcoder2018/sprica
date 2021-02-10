<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";
    protected $fillable = ['project_id','title', 'description', 'start_date', 'due_date', 'status', 'priority'];

    function assigned(){
        return $this->belongsToMany(User::class);
    }

    function project(){
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
