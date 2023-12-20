<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
class Skema extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = ['nama_skema'];
    
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
