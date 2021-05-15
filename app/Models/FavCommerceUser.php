<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavCommerceUser extends Model
{
    use HasFactory;

    protected $table = 'favourite_commerce_user';

    protected $fillable = [
        'id_commerce',
        'id_user',
    ];
}
