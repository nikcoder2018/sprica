<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name', 'username', 'password', 'number', 'department', 'hour_fee', 'tax_status', 'login_date', 'day_off', 'street', 'postal_code', 'date_of_birth', 'place_of_birth', 'nationality', 'sg_number', 'health_insurance', 'exit', 'function', 'STIDNUM', 'driving_license', 'vds_identity', 'bank_connection', 'bank', 'IBAN', 'BIC', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
