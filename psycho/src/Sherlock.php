<?php

namespace BelowCode\Psycho;

use BelowCode\Psycho\Drivers\LaravelPsychoPsychoDriver;
use BelowCode\Psycho\Drivers\PlanPsychoDriver;
use BelowCode\Psycho\Drivers\PsychoDriver;

class Sherlock
{
    protected array $drivers = [
        LaravelPsychoPsychoDriver::class,
    ];

    /**
     * @param  string  $subject
     *
     * @return PsychoDriver|null
     */
    public function detect(string $subject)
    {
        foreach ($this->drivers as $driverClass) {
            $driver = new $driverClass();

            if ($driver->deployable($subject)) {
                return $driver;
            }
        }

        return new PlanPsychoDriver();
    }
}