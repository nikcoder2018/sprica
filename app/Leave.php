<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LeaveDate;
class Leave extends Model
{
    //
    protected $fillable = ['user_id', 'type_id', 'status', 'duration_type', 'reason'];
    
    public function sync_dates($id, $dates){
        LeaveDate::where('leave_id', $id)->delete();
        foreach($dates as $date){
            LeaveDate::create(['leave_id' => $id, 'date' => $date]);
        }
    }
}
