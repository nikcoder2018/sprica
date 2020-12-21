<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherExpenses extends Model
{
    //
    protected $table = 'other_expenses';
    protected $fillable = ['code', 'title', 'expenses_1', 'expenses_2', 'overnight'];
}
