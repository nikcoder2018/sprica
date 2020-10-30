<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = "vehicles";
    protected $fillable = ['name','registration_no','model','chassis_no','engine_no','manufacturer','type','color','registration_expiry','group_id','is_active'];

    function group(){
        return $this->hasOne(VehicleGroup::class, 'id','group_id');
    }
}