<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveDate extends Model
{
    protected $table = 'leave_dates';
    protected $fillable = ['leave_id', 'date'];
    public $timestamps = false;
    public function leaves(){
        return $this->belongsToMany(Leave::class);
    }
}
