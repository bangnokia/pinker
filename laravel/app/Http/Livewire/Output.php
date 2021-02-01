<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Process\Process;

class Output extends Component
{
    public string $output;

    protected $listeners = ['execute'];

    public function execute(string $code)
    {
        $process = new Process(['php', base_path('/../psycho/index.php'), '--target='.base_path(), "--code={$code}"]);
        $process->run();
        $this->output = $process->getOutput();

        $this->emit('outputUpdated');
    }

    public function render()
    {
        return view('livewire.output');
    }
}
