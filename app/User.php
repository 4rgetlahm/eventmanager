<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     public function sendPasswordResetNotification($token){
         app('App\Http\Controllers\Mailcontroller')->sendMail(request()->email, "Slaptažodžio atkūrimas", "Jums buvo atsiųsta užklausa slaptažodžiui pakeisti. Jeigu tai buvote jūs, paspauskite ant šios nuorodos ir sekite nurodymus: ".url('/password/reset/')."/".$token."\n\nJeigu tai buvote ne jūs, ignoruokite šią žinutę.");
     }

     public function verifyUser()
     {
         return $this->hasOne('App\verification');
     }

    protected $fillable = [
        'name', 'email', 'password', 'class',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role',
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
