<?php

namespace Mindtwo\LaravelHealth\Tests;

use Mindtwo\LaravelHealth\Checks\DummyCheck;
use Mindtwo\LaravelHealth\LaravelHealthServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected $systemReport;

    protected function setUp(): void
    {
        parent::setUp();
        $this->systemReport = new DummyCheck;
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelHealthServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        // $this->config()->set('database.default', 'testing');
    }

    public function test_system_name(): void
    {
        $this->assertEquals('Laravel', $this->systemReport->getSystemName());
    }

    public function test_system_version(): void
    {
        $this->assertEquals('10.30.0', $this->systemReport->getSystemVersion());
    }

    public function test_php_version(): void
    {
        $this->assertEquals(phpversion(), $this->systemReport->getPhpVersion());
    }

    public function test_os_name(): void
    {
        $this->assertEquals(php_uname('s'), $this->systemReport->getOsName());
    }

    public function test_os_version(): void
    {
        $this->assertEquals(php_uname('r'), $this->systemReport->getOsVersion());
    }

    public function test_webserver_name(): void
    {
        $this->assertEquals($_SERVER['SERVER_SOFTWARE'], $this->systemReport->getWebservername());
    }

    public function test_webserver_version(): void
    {
        $this->assertEquals('', $this->systemReport->getWebserverVersion());
    }

    public function test_database_name(): void
    {
        $this->assertEquals(config('database.default'), $this->systemReport->getDatabaseName());
    }

    public function test_database_version(): void
    {
        $this->assertEquals(config('database.connections.'.config('database.default').'.version'), $this->systemReport->getDatabaseVersion());
    }

    public function test_dependencies_name(): void
    {
        $this->assertEquals(config('dependencies_name', []), $this->systemReport->getDependenciesName());
    }

    public function test_dependencies_version(): void
    {
        $this->assertEquals(config('dependencies_version', []), $this->systemReport->getDependenciesVersion());
    }

    public function test_additional_last_update(): void
    {
        $this->assertEquals(now()->toIso8601String(), $this->systemReport->getAdditionalLastUpdate());
    }
}
