<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    public function pengajuan_magang()
    {
        return $this->hasMany(Pengajuan_magang::class);
    }

    public function magang()
    {
        return $this->hasMany(Magang::class);
    }

    public function pengajuan_serkom()
    {
        return $this->hasMany(Pengajuan_serkom::class);
    }

    public function serkom()
    {
        return $this->hasMany(Serkom::class);
    }
}
