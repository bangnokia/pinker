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
                base_path('psycho.phar'),
                "--target={$project->path}",
                "--code=".base64_encode($code)
            ]);

            
            $process->run(null, [
                'TEMP' => sys_get_temp_dir() // fuck windows
            ]);
        } else {
            $command = (new Process([
                $project->php_binary,
                "/tmp/psycho.phar",
                "--target={$project->path}",
                "--code=".base64_encode($code)
            ]))->getCommandLine();

            $process = Executor::makeSsh($project)->execute([
                'cd '.$project->path,
                $command
            ]);
        }
        

        $this->output = $process->isSuccessful() ? $process->getOutput() : $process->getErrorOutput();


        $this->emit('outputUpdated');
    }

    public function render()
    {
        return view('livewire.output');
    }
}
