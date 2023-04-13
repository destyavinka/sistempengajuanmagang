<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function pengajuan_magang()
    // {
    //     return $this->belongsTo(Pengajuan_magang::class);
    // }

    // public function instansi()
    // {
    //     return $this->belongsTo(Instansi::class);
    // }

    // public function skema()
    // {
    //     return $this->belongsTo(Skema::class);
    // }

    protected $table = 'magangs';
    protected $guarded = ['id'];

}
