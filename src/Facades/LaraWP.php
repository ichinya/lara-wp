<?php

namespace Ichinya\LaraWP\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ichinya\LaraWP\LaraWP
 */
class LaraWP extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ichinya\LaraWP\LaraWP::class;
    }
}
