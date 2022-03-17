<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'user_id',
        'info',
        'location',
        'status',
    ];

    use HasFactory;
}
