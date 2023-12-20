<?php

namespace App\Models;

// use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserVerify extends Model
{
    use HasFactory;

    public $table = "users_verify";

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'user_id',
        'token',
    ];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function userData(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * Get the user that owns the UserVerify
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userData(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
