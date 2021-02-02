<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class Output extends Component
{
    public string $output;

    protected $listeners = ['execute'];

    public function execute(string $code)
    {
        $project = \App\Models\Project::current();
        $project->update(['code' => $code]);

        $process = new Process([
            (new PhpExecutableFinder())->find(false),
            base_path('../psycho/index.php'),
            "--target={$project->path}",
            "--code={$code}"
        ]);

        $process->run();
        $this->output = $process->getOutput();

        $this->emit('outputUpdated');
    }

    public function render()
    {
        return view('livewire.output');
    }
}
