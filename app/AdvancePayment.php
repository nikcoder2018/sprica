<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvancePayment extends Model
{
    //
    protected $table = "avanslar";
    protected $fillable = ['UyeID', 'Tutar', 'Tarih', 'Tarih2', 'Eldenmi'];

    public $timestamps = false;
}
