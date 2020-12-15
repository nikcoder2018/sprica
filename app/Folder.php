<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Folder extends Model
{
    //
    protected $fillable = ['user_id','name','folder','accessibility','departments','password'];

    public function files(){
        return $this->hasMany(File::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getSizeAttribute(){
        return $this->files()->sum('size');
    }
}
