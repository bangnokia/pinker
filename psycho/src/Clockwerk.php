<?php

namespace BelowCode\Psycho;

use Laravel\Tinker\ClassAliasAutoloader;
use Psy\Configuration;
use Psy\ExecutionLoopClosure;
use Psy\Shell;
use Psy\VersionUpdater\Checker;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;

class Clockwerk
{
    protected Shell $shell;

    protected OutputInterface $output;

    protected Sherlock $sherlock;

    protected string $targetPath;

    protected array $casters = [];

    public function __construct()
    {
        $this->output = new BufferedOutput();
        $this->sherlock = new Sherlock();
    }

    protected function makeShell(): self
    {
        $config = new Configuration([
            'updateCheck' => Checker::NEVER,
            'configFile'  => null
        ]);
        $config->setHistoryFile(defined('PHP_WINDOWS_VERSION_BUILD') ? 'null' : '/dev/null');
        $config->getPresenter()->addCasters($this->casters);

        $this->shell = new Shell($config);
        $this->shell->setOutput($this->output);

        if (file_exists($composerClassMap = $this->targetPath.'/vendor/composer/autoload_classmap.php')) {
            ClassAliasAutoloader::register($this->shell, $composerClassMap);
        }

        return $this;
    }

    protected function setShellOutput(Output $output): self
    {
        $this->shell->setOutput($output);

        return $this;
    }

    /**
     * Laravel bootstrap
     *
     * @param  string  $target
     * @return Clockwerk
     */
    public function bootstrapAt(string $target): self
    {
        $this->targetPath = $target;

        $driver = $this->sherlock->detect($this->targetPath);

        $driver->rollOut($this->targetPath);

        $this->casters = $driver->casters();

        $this->makeShell();

        return $this;
    }

    public function execute(string $phpCode): string
    {
        // result here is php variable
        $result = $this->shell->execute($phpCode);

        // here we write to output to get raw string after processed by presenter
        $this->shell->writeReturnValue($result);

        $output = $this->output->fetch();

        return $this->cleanOutput($output);
    }

    /**
     * Copy from spatie/web-tinker
     *
     * @param  string  $output
     * @return string
     */
    protected function cleanOutput(string $output): string
    {
        $output = preg_replace('/(?s)(<aside.*?<\/aside>)|Exit:  Ctrl\+D/ms', '$2', $output);

        return trim($output);
    }
}