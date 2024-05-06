<?php

namespace Ichinya\LaraWP\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $user_login
 * @property string $user_pass
 * @property string $user_nicename
 * @property string $user_email
 * @property string $user_url
 * @property string $display_name
 */
class User extends Model
{
    protected $connection = 'wordpress';

    public $timestamps = false;
}
