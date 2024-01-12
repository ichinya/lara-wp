<?php

namespace Ichinya\LaraWP\Commands;

use Illuminate\Console\Command;

class LaraWPCommand extends Command
{
    public $signature = 'lara-wp';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
