<?php

namespace Mindtwo\LaravelHealth;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Mindtwo\LaravelHealth\Commands\LaravelHealthCommand;

class LaravelHealthServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-health')
            ->hasConfigFile();
    }
}
