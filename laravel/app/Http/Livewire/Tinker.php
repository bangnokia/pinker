<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class Tinker extends Component
{
    public $showAddProject = true;
    public $projectPath =  '';
    public $projectName =  '';

    public function mount()
    {
        $this->project = Project::current();
    }

    public function getProjectProperty()
    {
        return Project::current();
    }

    public function updatingProjectPath($value)
    {
        $this->projectName = basename($value);
    }

    public function toggleAddProject()
    {
        $this->showAddProject = !$this->showAddProject;
    }

    public function render()
    {
        return view('livewire.tinker');
    }
}
