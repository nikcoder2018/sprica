<?php

namespace App;

use App\Casts\JSON;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['name', 'email', 'address', 'invoice_number', 'date_of_issue', 'items'];
    protected $casts = [
        'items' => JSON::class,
    ];
    protected $dates = ['date_of_issue'];

    protected $appends = ['total'];

    protected static function booted()
    {
        static::saving(function ($invoice) {
            $invoice->items = collect($invoice->items)->map(function ($item) {
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
