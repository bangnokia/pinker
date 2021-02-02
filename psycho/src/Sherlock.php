<?php

namespace BangNokia\Psycho;

use BangNokia\Psycho\Drivers\LaravelPsychoPsychoDriver;
use BangNokia\Psycho\Drivers\PlanPsychoDriver;
use BangNokia\Psycho\Drivers\PsychoDriver;

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