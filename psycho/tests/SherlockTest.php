<?php

namespace BangNokia\Psycho\Tests;

use BangNokia\Psycho\Drivers\LaravelPsychoPsychoDriver;
use BangNokia\Psycho\Drivers\PlanPsychoDriver;
use BangNokia\Psycho\Sherlock;
use PHPUnit\Framework\TestCase;

class SherlockTest extends TestCase
{
    protected Sherlock  $sherlock;

    public function setUp(): void
    {
        parent::setUp();

        $this->sherlock = new Sherlock();
    }

    public function testItCanDetectLaravelDriver()
    {
        $subject = $this->sherlock->detect(__DIR__.'/fixtures/drivers/laravel');

        $this->assertInstanceOf(LaravelPsychoPsychoDriver::class, $subject);
    }

    public function testItCanFallbackToPlanDriverIfCanNotDetectAnyThing()
    {
        $subject = $this->sherlock->detect(__DIR__.'/fixtures/drivers/dummy');

        $this->assertInstanceOf(PlanPsychoDriver::class, $subject);
    }
}