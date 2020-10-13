<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $table = 'fuels';
    protected $fillable = ['vehicle_id','driver_id','fill_date','quantity','odometer_reading','amount','comment'];

    function driver(){
        return $this->hasOne(User::class, 'id', 'driver_id');
    }
    function vehicle(){
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }
}
