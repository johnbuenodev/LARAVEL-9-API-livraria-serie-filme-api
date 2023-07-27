<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password', //add mais campos aqui referentes a exemplo privilegios ou tipo de usuario ver como fazer
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

/* model

{
	"name": "robo1",
	"email": "robo1@iot-gen.com",
	"password":"123456",
	"password_confirmation":"123456",
	"nameToken":"usuarioLogado"
}

	"email": "robo2@iot-gen.com",
	"password":"654321",

    {
	"email": "robo3@iot-gen.com",
	"password":"456789"
}

*/
