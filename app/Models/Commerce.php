<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'commerce_category',
        'picture',
        'phone',
        'email',
        'schedule',
        'latitude',
        'longitude',
        'total_points'
    ];
}
