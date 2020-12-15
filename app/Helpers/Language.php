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
    public static function get($key)
    {
        return Cache::get('settings')->where('DilBASLIK', $key)->first()->DilKARSILIK;
    }

    public static function settings($key) //TODO Remove this function soon
    {
        return Cache::get('settings')->where('DilBASLIK', $key)->first()->DilKARSILIK;
    }
}