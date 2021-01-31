<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Process\Process;

class Editor extends Component
{
    public string $code = '$name ="daudau"';

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
