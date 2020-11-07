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
        'First_name', 'Last_name' ,'email', 'password', 'Active', 'Role', 'Workload',
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

    public function positions(){
        return $this->hasMany('App\Position');
    }

    public function projects(){
        return $this->hasMany('App\Project');
    }

    public function skills(){
        return $this->hasMany('App\Skill');
    }

    public function absences(){
        return $this->hasMany('App\Absence');
    }

    public function hours_users(){
        return $this->hasMany('App\Hours_user');
    }
}
