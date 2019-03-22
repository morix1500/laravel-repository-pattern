<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'contents',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
