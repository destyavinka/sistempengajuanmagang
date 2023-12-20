<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan_magang extends Model
{
    use HasFactory;


    // protected $table = 'pengajuan_magangs';
    protected $guarded = ['id'];
    public $timestamps = false;
    // protected $fillable = ['topik_magang', 'skema_id', 'instansi_id', 'periode', 'anggaran'];
    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
