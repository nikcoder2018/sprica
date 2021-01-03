<?php

namespace App;

use App\Casts\Trim;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = ['user_id', 'key', 'value'];

    protected $casts = [
        'key' => Trim::class,
    ];
}
