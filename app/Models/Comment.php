<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property boolean $visible
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'thread_id',
        'message'
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * @throws Exception
     */
    public function getThread(): Thread
    {
        $model = $this->thread()->first();

        if($model instanceof Thread){
            return $model;
        }

        throw new Exception('Thread not found');
    }
}
