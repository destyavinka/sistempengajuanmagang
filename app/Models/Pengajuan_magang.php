<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan_magang extends Model
{
    use HasFactory;

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function magang()
    // {
    //     return $this->belongsTo(Magang::class);
    // }

    // public function instansi()
    // {
    //     return $this->belongsTo(Instansi::class);
    // }

    // public function skema()
    // {
    //     return $this->belongsTo(Skema::class);
    // }

    protected $table = 'pengajuan_magangs';
    protected $guarded = ['id'];
    // protected $fillable = ['topik_magang', 'skema_id', 'instansi_id', 'tgl_mulai', 'tgl_selesai', 'anggaran'];
}
