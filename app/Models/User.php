<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Wallet;
use App\Models\Account;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
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
        'password' => 'hashed',
    ];

    public function fullName()
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function role()
    {
        return $this->belongsTo(Role::Class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }
}
