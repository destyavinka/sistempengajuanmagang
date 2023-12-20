<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyelenggara extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['penyelenggara'];

    public function pengajuan_serkom()
    {
        return $this->hasMany(Pengajuan_serkom::class);
    }

    public function serkom()
    {
        return $this->hasMany(Serkom::class);
    }
}
