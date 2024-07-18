<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'FirstName',
        'LastName',
        'email',
        'role_id',
        'password',
        'code',
        'statusCode',
        'phone_number'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function register()
    {
        return $this->belongsTo(Register::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'favorites');
    }
}
