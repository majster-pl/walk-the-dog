<?php

namespace App\Models;

use App\Models\User;
use App\Models\Place;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlacePicture extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'creator_id',
        'place_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }


    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }


}
