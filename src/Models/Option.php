<?php

namespace Ichinya\LaraWP\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $connection = 'wordpress';

    public $timestamps = false;
    protected $primaryKey = 'option_id';

}
