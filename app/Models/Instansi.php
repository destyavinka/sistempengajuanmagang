<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_instansi'];

    public function pengajuan_magang()
    {
        return $this->hasMany(Pengajuan_magang::class);
    }

    public function magang()
    {
        return $this->hasMany(Magang::class);
    }

}
