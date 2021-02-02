<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class Tinker extends Component
{
    public $showAddProject = false;
    public $projectPath = '';

    protected $listeners = ['changeDirectory'];

    public function getProjectProperty()
    {
        return Project::current();
    }

    public function updatingProjectPath($value)
    {
        $this->projectName = basename($value);
    }

    public function changeDirectory($directory)
    {
        $project = Project::updateOrCreate(['path' => $directory], ['name' => basename($directory)]);
        $project->save();
        $project->setAsActive();

        $this->emit('projectChanged');
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
