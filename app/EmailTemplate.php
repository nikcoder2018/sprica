<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $table = "email_templates";

    protected $fillable = [
        'title','subject', 'body', 'word_template'
    ];
}
