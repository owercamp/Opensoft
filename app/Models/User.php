<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


//Spatie
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    
    protected $table = "users";

    protected $fillable = [
        'id','firstname','lastname', 'email', 'password','created_at','updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public $timestamps = true;

    //Spatie
    protected $guard_name = 'web';
}
