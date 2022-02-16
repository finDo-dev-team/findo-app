<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ODPEvent extends Model
{
    use HasFactory;

    public function likedBy()
    {
        return $this->belongsToMany(User::class);
    }
}
