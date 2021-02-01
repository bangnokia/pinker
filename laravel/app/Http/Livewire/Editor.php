<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;
use Symfony\Component\Process\Process;

class Editor extends Component
{
    public string $code = '$name ="daudau"';

    protected $listeners = ['projectChanged'];

    public function projectChanged()
    {
        $this->code = Project::current()->content ?? '';
    }

    public function submit(string $code)
    {
        $this->code = $code;
        $this->emitTo('output', 'execute', $this->code);
    }

    public function render()
    {
        return view('livewire.editor');
    }
}
