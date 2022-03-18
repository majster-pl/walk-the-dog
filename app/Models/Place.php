<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    protected $fillable = [
        'user_id',
        'info',
        'location',
        'status',
    ];

    use HasFactory;

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function createdBy(User $user)
    {
        return $this->user_id === $user->id;
    }

    public function isPublic()
    {
        return $this->status === 'public';
    }
}
