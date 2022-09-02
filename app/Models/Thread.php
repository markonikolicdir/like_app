<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 */
class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];
}
