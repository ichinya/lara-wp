<?php

namespace Ichinya\LaraWP\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $connection = 'wordpress';
    public $timestamps = false;


    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'post_author', 'ID');
    }

    public function meta()
    {
        return $this->hasMany(Postmeta::class, 'post_id', 'ID');
    }

}
