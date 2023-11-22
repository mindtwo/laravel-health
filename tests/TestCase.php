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
        $this->systemReport = new DummyCheck();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelHealthServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        //$this->config()->set('database.default', 'testing');
    }

    public function testSystemName(): void
    {
        $this->assertEquals('Laravel', $this->systemReport->getSystemName());
    }

    public function testSystemVersion(): void
    {
        $this->assertEquals('10.30.0', $this->systemReport->getSystemVersion());
    }

    public function testPhpVersion(): void
    {
        $this->assertEquals(phpversion(), $this->systemReport->getPhpVersion());
    }

    public function testOsName(): void
    {
        $this->assertEquals(php_uname('s'), $this->systemReport->getOsName());
    }

    public function testOsVersion(): void
    {
        $this->assertEquals(php_uname('r'), $this->systemReport->getOsVersion());
    }

    public function testWebserverName(): void
    {
        $this->assertEquals($_SERVER['SERVER_SOFTWARE'], $this->systemReport->getWebservername());
    }

    public function testWebserverVersion(): void
    {
        $this->assertEquals('', $this->systemReport->getWebserverVersion());
    }

    public function testDatabaseName(): void
    {
        $this->assertEquals(config('database.default'), $this->systemReport->getDatabaseName());
    }

    public function testDatabaseVersion(): void
    {
        $this->assertEquals(config('database.connections.'.config('database.default').'.version'), $this->systemReport->getDatabaseVersion());
    }

    public function testDependenciesName(): void
    {
        $this->assertEquals(config('dependencies_name', []), $this->systemReport->getDependenciesName());
    }

    public function testDependenciesVersion(): void
    {
        $this->assertEquals(config('dependencies_version', []), $this->systemReport->getDependenciesVersion());
    }

    public function testAdditionalLastUpdate(): void
    {
        $this->assertEquals(now()->toIso8601String(), $this->systemReport->getAdditionalLastUpdate());
    }
}
