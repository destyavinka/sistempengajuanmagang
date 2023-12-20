<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serkom extends Model
{
    use HasFactory;

    // protected $table = 'serkoms';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    public function penyelenggara()
    {
        return $this->belongsTo(Penyelenggara::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
