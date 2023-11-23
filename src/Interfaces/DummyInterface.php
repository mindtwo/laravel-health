<?php

namespace Mindtwo\LaravelHealth\Interfaces;

interface DummyInterface
{
    /**
     * Get the name of the main system or frame (e.q. Laravel)
     *
     * @return string
     */
    public function getSystemName(): string;

    /**
     * Get the version of the main system or frame (e.q. 10.0)
     *
     * @return string
     */
    public function getSystemVersion(): string;

    /**
     * Get the php version of the main system of frame (e.q. 8.0)
     *
     * @return string
     */
    public function getPhpVersion(): string;

    /**
     * Get the os name of the main system or frame (e.q. Ubuntu)
     *
     * @return string
     */
    public function getOsName(): string;

    /**
     * Get the os version of the main system or frame (e.q. 20.04 LTS)
     *
     * @return string
     */
    public function getOsVersion(): string;

    /**
     * Get the webserver name of the main system or frame (e.q. Apache)
     *
     * @return string
     */
    public function getWebserverName(): string;

    /**
     * Get the webserver version of the main system or frame (e.q. 2.4)
     *
     * @return string
     */
    public function getWebserverVersion(): string;

    /**
     * Get the database name of the main system or frame (e.q. MySQL)
     *
     * @return ?string
     */
    public function getDatabaseName(): ?string;

    /**
     * Get the database version of the main system or frame (e.q. 5.7)
     *
     * @return ?string
     */
    public function getDatabaseVersion(): ?string;

    /**
     * Get the dependencies name of the main system or frame (e.q. Nova)
     *
     * @return ?array
     */
    public function getDependenciesInfos(): ?array;

    /**
     * Get the last update  of the main system or frame (e.q. 2023-10-24T18:00:00Z)
     *
     * @return string
     */
    public function getAdditionalLastUpdate(): string;
}
