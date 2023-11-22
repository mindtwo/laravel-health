<?php

namespace Mindtwo\LaravelHealth\Checks;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;
use Throwable;


class DummyCheck extends Check
{
    public function run(): Result
    {
        $result = Result::make()->meta([
            'test' => 'success',
        ]);

        return $result->ok();
    }
    /**
     * Get the name of the main system or frame (e.q. Laravel)
     *
     * @return string
     */
    public function getSystemName(): string
    {
        return 'Laravel';
    }

    /**
     * Get the version of the main system or frame (e.q. 10.0)
     *
     * @return string
     */
    public function getSystemVersion(): string
    {
        return App::version();
    }

    /**
     * Get the php version of the main system of frame (e.q. 8.0)
     *
     * @return string
     */

    public function getPhpVersion(): string
    {
        return phpversion();
    }
    /**
     * Get the os name of the main system or frame (e.q. Ubuntu)
     *
     * @return string
     */
    public function getOsName(): string
    {
        return php_uname('s');
    }
    /**
     * Get the os version of the main system or frame (e.q. 20.04 LTS)
     *
     * @return string
     */
    public function getOsVersion(): string
    {
        return php_uname('r');
    }
    /**
     * Get the webserver name of the main system or frame (e.q. Apache)
     *
     * @return string
     */
    public function getWebserverName(): string
    {
        $serverSoftware = explode('/', $_SERVER['SERVER_SOFTWARE']);

        return $serverSoftware[0] ?? '';
    }
    /**
     * Get the webserver version of the main system or frame (e.q. 2.4)
     *
     * @return string
     */
    public function getWebserverVersion(): string
    {
        $serverSoftware = explode('/', $_SERVER['SERVER_SOFTWARE']);

        return $serverSoftware[1] ?? '';
    }

    /**
     * Get the database name of the main system or frame (e.q. MySQL)
     *
     * @return ?string
     */

    public function getDatabaseName(): ?string
    {
        return config('database.default');
    }

    /**
     * Get the database version of the main system or frame (e.q. 5.7)
     *
     * @return ?string
     */
    public function getDatabaseVersion(): ?string
    {
        try {
            $version = DB::select('SELECT version() AS version');

            return $version[0]->version;
        } catch (Throwable $error) {
            return null;
        }
    }

    /**
     * Get the dependencies name of the main system or frame (e.q. Nova)
     *
     * @return ?array
     */
    public function  getDependenciesInfos(): ?array
    {
        return null;
    }
    /**
     * Get the dependencies version of the main system or frame (e.q. 4.1.0)
     *
     * @return string
     */

    public function  getDependenciesVersion(): string
    {
        return config('dependencies_version', []);
    }
    /**
     * Get the last update  of the main system or frame (e.q. 2023-10-24T18:00:00Z)
     *
     * @return string
     */

    public function getAdditionalLastUpdate(): string
    {
        return now()->toIso8601String();
    }
    public function toArray():array
    {
        return [
            'system' => [
                'type' => $this->getSystemName(),
                'version' => $this->getSystemVersion(),
            ],
            'os' => [
                'name' => $this->getOsName(),
                'version' => $this->getOsVersion(),
            ],
            'php' => [
                'version' => $this->getPhpVersion(),
            ],
            'webserver' => [
                'name' => $this->getWebserverName(),
                'version' => $this->getWebserverVersion(),
            ],
            'database' => [
                'name' => $this->getDatabaseName(),
                'version' => $this->getDatabaseVersion(),
            ],
            'dependencies' => [
                'name' => $this->getDependenciesInfos(),
                'version' => $this->getDependenciesInfos(),
            ],
            'additional' => [
                'lastUpdated' => $this->getAdditionalLastUpdate(),
            ],
        ];
    }

}
