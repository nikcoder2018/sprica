<?php

namespace App;

use App\Casts\File;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Timelog;

use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    protected $appends = ['role'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'number', 'company', 'department', 'hour_fee', 'tax_status', 'login_date', 'day_off', 'street', 'postal_code', 'date_of_birth', 'place_of_birth', 'nationality', 'sg_number', 'health_insurance', 'exit', 'function', 'STIDNUM', 'driving_license', 'vds_identity', 'bank_connection', 'bank', 'IBAN', 'BIC', 'role', 'status'
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
        'avatar' => File::class,
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected static function booted()
    {
        static::created(function ($user) {
            if ($user->avatar === '') {
                $user->avatar = 'public/users-avatar/avatar.png';
            }

            collect([
                [
                    'key' => 'theme',
                    'value' => 'vuexy',
                ],
                [
                    'key' => 'default_start_time',
                    'value' => '07:00',
                ],
                [
                    'key' => 'collapsible-mode',
                    'value' => 'off',
                ],
                [
                    'key' => 'theme-mode',
                    'value' => 'dark',
                ],
                [
                    'key' => 'layout-mode',
                    'value' => 'full',
                ],
                [
                    'key' => 'navbar-color',
                    'value' => 'bg-white',
                ],
                [
                    'key' => 'nav-layout',
                    'value' => 'floating',
                ],
                [
                    'key' => 'footer-layout',
                    'value' => 'static',
                ],
            ])->each(function ($entry) use ($user) {
                $user->setSetting($entry['key'], $entry['value']);
            });
        });
    }

    public function getRoleAttribute()
    {
        $role = $this->roles()->first();
        return $role ? $role->title : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function settings()
    {
        return $this->hasMany(GeneralSetting::class);
    }
    public function tasks(){
        return $this->belongsToMany(Task::class);
    }
    public function completedTask(){
        return $this->belongsToMany(Task::class)->where('status', 'completed');
    }
    public function incompleteTask(){
        return $this->belongsToMany(Task::class)->where('status', 'incomplete');
    }
    /**
     * @return \App\GeneralSetting|null
     */
    public function getSetting($key)
    {
        return $this->settings()->where('key', $key)->first();
    }

    public function setSetting($key, $value)
    {
        $setting = $this->getSetting($key);
        if ($setting) {
            $setting->value = $value;
            $setting->save();
        } else {
            $this->settings()->create([
                'key' => $key,
                'value' => $value,
            ]);
        }
    }

    public function hasSetting($key)
    {
        return $this->getSetting($key) !== null;
    }

    function debts()
    {
        return $this->hasMany(Advance::class, 'user_id', 'id');
    }

    function advances()
    {
        return $this->hasMany(Advance::class);
    }

    public function getTotalConfirmedTimelogAttribute()
    {
        return Timelog::where(['user_id' => $this->id, 'confirmation' => 1])->get()->count();
    }

    public function getDateRegisteredAttribute()
    {
        $date = new Carbon($this->created_at);
        return $date->format('Y-m-d');
    }
}
