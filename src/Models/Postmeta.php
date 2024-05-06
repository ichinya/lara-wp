<?php

namespace Ichinya\LaraWP\Models;

use Illuminate\Database\Eloquent\Model;

class Postmeta extends Model
{
    protected $table = 'postmeta';

    protected $connection = 'wordpress';

    public $timestamps = false;
}
