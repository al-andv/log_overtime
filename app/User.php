<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function sendPasswordResetNotification($token)
    {
        $url = 'http://localhost/AL_training/logtime/reset-password?token='.$token;
        $this->notify(new ResetPassword($url));
    }

    public function attendence()
    {
        return $this->hasMany(Attendence::class);
    }

    public function overtime()
    {
        return $this->hasMany(Overtime::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
