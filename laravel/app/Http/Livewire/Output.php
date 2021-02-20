<?php

namespace App\Http\Livewire;

use App\Executor;
use Livewire\Component;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class Output extends Component
{
    /**
     * @var string
     */
    public $output;

    protected $listeners = ['execute'];

    public function execute(string $code)
    {
        $project = \App\Models\Project::current();
        $project->update(['code' => $code]);

        if ($project->type === 'local') {
            $process = new Process([
                (new PhpExecutableFinder())->find(false),
                base_path('/psycho.phar'),
                "--target={$project->path}",
                "--code={$code}"
            ]);
            $process->run();
        } else {
            $command = (new Process([
                $project->php_binary,
                "/tmp/psycho.phar",
                "--target={$project->path}",
                "--code={$code}"
            ]))->getCommandLine();

            $process = Executor::makeSsh($project)->execute([
                'cd '.$project->path,
                $command
            ]);
        }

        $this->output = $process->getOutput();

        $this->emit('outputUpdated');
    }

    public function render()
    {
        return view('livewire.output');
    }
}
