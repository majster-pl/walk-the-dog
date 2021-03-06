<?php

namespace App\Models;

use App\Models\Like;
use App\Models\PlaceType;
use App\Models\PlacePicture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    protected $fillable = [
        'status',
        'user_id',
        'title',
        'main_image_path',
        'address_line1',
        'address_line2',
        'address_state_or_region',
        'address_city',
        'address_postcode_or_zip',
        'address_country',
        'address_latitude',
        'walk_time',
        'parking',
        'parking_details',
        'type_id',
        'activity',
        'dogs_only',
        'seasonal_access',
        'seasonal_details',
        'off_lead',
        'cafe_access',
        'access_to_water',
        'disposal_bins',
        'description',
        'slug'
    ];

    use HasFactory, Sluggable;

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
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function isUsersPost(User $user = null)
    {
        if (!isset($user)) {
            return false;
        }
        return $this->user_id === $user->id;
    }

    public function isPublic()
    {
        return $this->status === 'published';
    }

    public function placeType()
    {
        return $this->hasOne(PlaceType::class, 'id', 'type_id');
    }

    public function pictures()
    {
        return $this->hasMany(PlacePicture::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
