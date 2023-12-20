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
        'nama',
        'nip',
        'email',
        'password',
        'level',
        'unit',
        'is_email_verified'
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

    public function pengajuan_magang()
    {
        return $this->hasMany(Pengajuan_magang::class);
    }

    public function magang()
    {
        return $this->hasMany(Magang::class);
    }

    public function serkom()
    {
        return $this->hasMany(Serkom::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function pekertian()
    {
        return $this->belongsTo(Pekertian::class);
    }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }
}
