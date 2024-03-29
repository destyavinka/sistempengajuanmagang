<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan_serkom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function serkom()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function jenis_sertifikasi()
    // {
    //     return $this->belongsTo(Jenis_sertifikasi::class);
    // }

    public function penyelenggara()
    {
        return $this->belongsTo(Penyelenggara::class);
    }

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function jenis_sertifikasi()
    {
        return $this->belongsTo(Jenis_sertifikasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
