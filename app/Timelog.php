<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timelog extends Model
{
    protected $table = "timelogs";
    protected $fillable = ['user_id', 'project_id','task_id','expenses_id', 'start_date', 'start_time', 'end_date', 'end_time', 'duration', 'break', 'confirmation', 'payable', 'code', 'tags','note', 'logged_from'];

    protected $dates = ['created_at', 'updated_at'];
    
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    function logged_from(){
        return $this->hasOne(User::class, 'id', 'logged_from');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function expenses(){
        return $this->belongsTo(OtherExpenses::class);
    }

    public function getDateStartAttribute(){
        return $this->start_date->format('Y-m-d h:i');
    }
}
