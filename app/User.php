<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Timelog;

use Carbon\Carbon;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'number', 'department', 'hour_fee', 'tax_status', 'login_date', 'day_off', 'street', 'postal_code', 'date_of_birth', 'place_of_birth', 'nationality', 'sg_number', 'health_insurance', 'exit', 'function', 'STIDNUM', 'driving_license', 'vds_identity', 'bank_connection', 'bank', 'IBAN', 'BIC', 'role', 'status'
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

    protected $dates = ['created_at','updated_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    function loans(){
        return $this->hasMany(AdvancePayment::class, 'UyeID', 'id')->selectRaw('UyeID, sum(Tutar) as total')->groupBy('UyeID');
    }

    function advances(){
        return $this->hasMany(Advance::class);
    }

    public function getTotalConfirmedTimelogAttribute(){
        return Timelog::where(['user_id' => $this->id, 'confirmation' => 1])->get()->count();
    }

    public function getDateRegisteredAttribute(){
        $date = new Carbon($this->created_at);
        return $date->format('Y-m-d');
    }
}
