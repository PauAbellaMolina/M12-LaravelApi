<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecompenseUsed extends Model
{
    use HasFactory;

    protected $table = 'recompenses_used';

    protected $fillable = [
        'id_user',
        'id_recompense',
    ];
}
