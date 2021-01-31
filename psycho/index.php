<?php

include __DIR__.'/vendor/autoload.php';

$arguments = getopt('', ['target:', 'code:']);

$clockwerk = new BelowCode\Psycho\Clockwerk();

$output = $clockwerk->bootstrapAt($arguments['target'])->execute(trim($arguments['code']));

$writer = new \Symfony\Component\Console\Output\ConsoleOutput();
$writer->writeln($output);

return 0;

