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
        'status',
        'address_line1',
        'address_line2',
        'address_state_or_region',
        'address_city',
        'address_country',
        'address_postcode_or_zip',
        'address_latitude',
        'walk_time',
        'parking',
        'parking_details',
        'type_id',
        'popularity',
        'description',

    ];

    use HasFactory;

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user = null)
    {
        if ($user) {
            return $this->likes->contains('user_id', $user->id);
        } else {
            return false;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
