<?php

namespace Ichinya\LaraWP\Models;

use Illuminate\Database\Eloquent\Model;

class Postmeta extends Model
{
    protected $table = 'postmeta';

    protected $connection = 'wordpress';

    protected $primaryKey = 'meta_id';

    public $timestamps = false;
}
