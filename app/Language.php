<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'dilayarlari';
    protected $fillable = ['DilBASLIK', 'DilKARSILIK'];
    protected $primaryKey  = 'DilID';

    public $timestamps = false;
}