<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleGroup extends Model
{
    protected $table = 'vehicles_group';
    protected $fillable = ['name','description'];
}
