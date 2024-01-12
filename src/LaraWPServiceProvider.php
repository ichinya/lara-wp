<?php

namespace Ichinya\LaraWP;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ichinya\LaraWP\Commands\LaraWPCommand;

class LaraWPServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('lara-wp')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_lara-wp_table')
            ->hasCommand(LaraWPCommand::class);
    }
}
