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

    
    protected $fillable = [
        'name',
        'cin',
        'email',
        'date_rec',
        'type',
        'photo',
        'password',
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

    public function agency()
    {
        return $this->hasOne(Agency::class, 'id_user');
    }
    
    public function caisse()
    {
        return $this->hasOne(Caisse::class, 'id_user');
    }

    public function alimentations()
    {
        return $this->hasMany(Alimentation::class, 'id_user');
    }
    public function operations()
    {
        return $this->hasMany(Operation::class, 'id_user');
    }
}
