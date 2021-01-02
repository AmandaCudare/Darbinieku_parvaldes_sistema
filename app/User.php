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
    //Veido attiecību starp lietotāju un amata pieteikumu
    public function user_positions(){
        return $this->hasMany('App\UserPosition');
    }
    //Veido attiecību starp lietotāju un projektu
    public function projects(){
        return $this->hasMany('App\Project');
    }
    //Veido attiecību starp lietotāju un prasmēm
    public function skills(){
        return $this->hasMany('App\Skill');
    }
    //Veido attiecību starp lietotāju un prombūtnes pieteikumiem
    public function absences(){
        return $this->hasMany('App\Absence');
    }
    //Veido attiecību starp lietotāju un dienas izdarītā ierakstu
    public function hours(){
        return $this->hasMany('App\Hour');
    }
}
