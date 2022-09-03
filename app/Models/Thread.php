<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $user_id
 * @property Carbon $created_at
 */
class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime:c',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @throws Exception
     */
    public function getUser(): User
    {
        $model = $this->user()->first();

        if($model instanceof User){
            return $model;
        }

        throw new Exception('User not found');
    }
}
