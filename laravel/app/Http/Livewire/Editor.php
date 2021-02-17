<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class Editor extends Component
{
    /**
     * @var string
     */
    public $code;

    protected $listeners = ['projectChanged'];

    public function projectChanged()
    {
        $this->code = $this->project->code;
    }

    public function getProjectProperty()
    {
        return Project::current();
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
