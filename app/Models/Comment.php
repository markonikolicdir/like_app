<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property boolean $visible
 * @property int $thread_id
 * @property int $votes
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

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('visible', '=', 1);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')->published();
    }
}
