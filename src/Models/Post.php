<?php

namespace Ichinya\LaraWP\Models;

use Ichinya\LaraWP\Enums\PostStatuses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $ID
 * @property int $post_author
 * @property string $post_date
 * @property string $post_date_gmt
 * @property string $post_content
 * @property string $post_title
 * @property string $post_excerpt
 * @property string $post_status
 * @property string $comment_status
 * @property string $ping_status
 * @property string $post_password
 * @property string $post_name
 * @property string $to_ping
 * @property string $post_modified
 * @property string $post_modified_gmt
 * @property string $post_content_filtered
 * @property int $post_parent
 * @property string $guid
 * @property int $menu_order
 * @property string $post_type
 * @property string $post_mime_type
 * @property int $comment_count
 */
class Post extends Model
{
    protected $connection = 'wordpress';

    public $timestamps = false;
    protected $primaryKey = 'ID';


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
        $query->where('post_status', PostStatuses::Publish);
    }

    public function scopeStatus(Builder $query, PostStatuses $status = PostStatuses::Publish): void
    {
        $query->where('post_status', $status->value);
    }
}
