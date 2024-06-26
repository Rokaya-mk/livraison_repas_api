<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='utilisateurs';
    protected $fillable = [
        'name',
        'email',
        'password',
        'num_telephone',
        'photos',
        'role',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adresse(){
        return $this->hasOne('App\Models\Adresse');
    }

    public function commentaires(){
        return $this->hasMany('App\Models\Commentaire');
    }

    public function commandes(){
        return $this->hasMany('App\Models\Commande');
    }
}
