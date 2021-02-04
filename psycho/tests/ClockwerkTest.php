<?php

namespace BangNokia\Psycho\Tests;

use BangNokia\Psycho\Clockwerk;
use \PHPUnit\Framework\TestCase;

class ClockwerkTest extends TestCase
{
    /**
     * @var Clockwerk
     */
    protected $clockwerk;

    public function setUp(): void
    {
        parent::setUp();

        $this->clockwerk = new Clockwerk();
    }

    public function testItLoadDefaultVendor()
    {
        $target = __DIR__.'/fixtures/foo';
        $phpCode = 'foo()';

        $output = $this->clockwerk->bootstrapAt($target)->execute($phpCode);

        $this->assertStringContainsString('bar', $output);
    }
}