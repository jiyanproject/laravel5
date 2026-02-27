<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, Uuid, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'name', 
        'email', 
        'password',
        'status_id',
        'avatar',
        'last_login_at',
        'last_login_from',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $incrementing = false;

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status_id');
    }

    public function Logs()
    {
        return $this->hasMany(LogActivity::class,'user_id');
    }
}
