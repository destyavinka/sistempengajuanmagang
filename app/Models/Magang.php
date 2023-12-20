<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    // protected $table = 'magangs';
    // protected $guarded = ['id'];

    protected $guarded = ['id'];
    public $timestamps = false;
   
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

    // public function periode()
    // {
    //     return $this->belongsTo(Periode::class);
    // }
}
