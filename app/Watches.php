<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watches extends Model
{   
    protected $primaryKey = 'SaatID';
    protected $table = 'saatler';
    protected $fillable = ['UyeID','ProjeID','ProjeBASLIK','Tarih','Saat','Onay', 'Odenecek', 'Gunduz','Kod','Calisti'];

    public $timestamps = false;

    function project(){
        return $this->belongsTo(Project::class, 'ProjeID', 'ProjeID');
    }
    function user(){
        return $this->hasOne(User::class, 'id', 'UyeID');
    }
}
