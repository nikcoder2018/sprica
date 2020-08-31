<?php 

namespace App\Helpers;

use Cache;

class Language
{
    /**
     * Fetch Cached settings from database
     *
     * @return string
     */
    public static function settings($DilBASLIK)
    {
        return Cache::get('settings')->where('DilBASLIK', $DilBASLIK)->first()->DilKARSILIK;
    }
}