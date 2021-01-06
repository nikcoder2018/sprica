<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function set($key, $value)
    {
        $setting = static::where('key', $key)->first();
        if (!$setting) {
            $setting = new static([
                'key' => $key,
            ]);
        }
        $setting->value = $value;
        $setting->save();
    }

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function has($key)
    {
        return static::get($key) !== null;
    }
}
