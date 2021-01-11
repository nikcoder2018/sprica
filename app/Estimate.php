<?php

namespace App;

use App\Casts\JSON;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $fillable = ['valid_until', 'estimate_number', 'items'];
    protected $dates = ['valid_until'];
    protected $casts = [
        'items' => JSON::class,
    ];
    protected $appends = ['total'];

    protected static function booted()
    {
        static::saving(function ($estimate) {
            $estimate->items = collect($estimate->items)->map(function ($item) {
                $item->cost = (float)$item->cost;
                $item->quantity = (float)$item->quantity;
                return $item;
            })->toArray();
        });
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->cost * $item->quantity;
        }
        return $total;
    }
}
