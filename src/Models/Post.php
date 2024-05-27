<?php

namespace Ichinya\LaraWP\Models;

use Ichinya\LaraWP\Enums\PostStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    protected $connection = 'wordpress';

    public $timestamps = false;

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'post_author', 'ID');
    }

    public function meta(): HasMany
    {
        return $this->hasMany(Postmeta::class, 'post_id', 'ID');
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('post_status', 'publish');
    }

    public function scopeStatus(Builder $query, PostStatuses $status = PostStatuses::Publish): void
    {
        $query->where('post_status', $status->value);
    }

}
