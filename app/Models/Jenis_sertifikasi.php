<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_sertifikasi extends Model
{
    use HasFactory;

    protected $fillable = ['jenis_sertifiaksi'];

    public function pengajuan_serkom()
    {
        return $this->hasMany(Pengajuan_serkom::class);
    }

    public function serkom()
    {
        return $this->hasMany(Serkom::class);
    }
}
