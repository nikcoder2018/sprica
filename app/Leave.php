<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LeaveDate;
class Leave extends Model
{
    //
    protected $table = 'leaves';
    
    protected $fillable = ['user_id', 'type_id', 'status', 'date', 'reason'];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function type(){
        return $this->hasOne(LeaveType::class, 'id', 'type_id');
    }
}
