<?php

namespace BangNokia\Psycho\Drivers;

abstract class PsychoDriver
{
    abstract function deployable(string $project): bool;

    /**
     * Autobots roll out!
     *
     * @param  string  $project
     */
    abstract function rollOut(string $project): void;

    public function casters(): array
    {
        return [];
    }
}