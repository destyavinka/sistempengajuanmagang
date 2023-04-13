<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serkom extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengajuan_serkom()
    {
        return $this->belongsTo(Pengajuan_serkom::class);
    }

    public function penyelenggara()
    {
        return $this->belongsTo(Penyelenggara::class);
    }

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    public function jenis_sertifikasi()
    {
        return $this->belongsTo(Jenis_sertifikasi::class);
    }
}
