<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timelog extends Model
{
    protected $table = "timelogs";
    protected $fillable = ['user_id', 'project_id','expenses_id', 'start_date', 'end_date', 'duration', 'confirmation', 'payable', 'code', 'tags','note'];

    protected $dates = ['start_date','end_date','created_at', 'updated_at'];
    
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function expenses(){
        return $this->belongsTo(OtherExpenses::class);
    }
}
