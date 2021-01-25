<?php

namespace App;

use App\Casts\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Expense extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'project_id',
        'purchased_from',
        'purchase_date',
        'category_id',
        'price',
        'currency',
        'bill'
    ];

    protected $dates = ['purchase_date'];

    protected $casts = [
        'bill' => File::class,
    ];

    protected $with = ['user', 'project', 'category'];

    protected static function booted()
    {
        static::deleted(function (Expense $expense) {
            Storage::delete($expense->getAttributes()['bill']);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }
}
