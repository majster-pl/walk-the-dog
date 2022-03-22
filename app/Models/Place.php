<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    protected $fillable = [
        'user_id',
        'title',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function isUsersPost(User $user)
    {
        return $this->user_id === $user->id;
    }

    public function isPublic()
    {
        return $this->status === 'published';
    }
}
