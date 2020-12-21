<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    protected $table = "advances";
    protected $fillable = ['user_id', 'amount', 'received_at','debit_at', 'paid_by'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
