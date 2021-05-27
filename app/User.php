<?php

namespace App;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'github_token',
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

    protected $appends = [
        'user_github_token',
    ];


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setGithubTokenAttribute($value)
    {
        $this->attributes['github_token'] = Crypt::encryptString($value);
    }

    public function getUserGithubTokenAttribute()
    {
        try {
            return Crypt::decryptString($this->github_token);
        } catch (DecryptException $exception) {
            return null;
        }
    }
}
