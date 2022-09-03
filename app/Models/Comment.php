<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property boolean $visible
 * @property int $thread_id
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'thread_id',
        'message',
        'parent_id'
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['children'];

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

    public function children(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}
