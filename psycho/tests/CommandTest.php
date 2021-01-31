<?php

namespace BelowCode\Psycho\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class CommandTest extends TestCase
{
    public function testCallFromOtherProcess()
    {
        $entry = __DIR__.'/../index.php';
        $target = __DIR__.'/fixtures/foo';
        $phpCode = 'foo()';

        $command = "php $entry --target=$target --code=\"$phpCode\"";

        $output = shell_exec($command);

        $this->assertEquals('=> "bar"', trim($output));
    }

    public function testCanPassMultipleLinesOfCode()
    {
        $entry = __DIR__.'/../index.php';
        $target = __DIR__;
        $phpCode = <<<'EOF'
$name = 'tinker';
$greeting = 'hello '.$name;
EOF;

        $process = new Process(['php', $entry, "--target=$target", "--code=$phpCode"]);
        $process->run();
        $output = $process->getOutput();

        $this->assertEquals('=> "hello tinker"', trim($output));
    }
}