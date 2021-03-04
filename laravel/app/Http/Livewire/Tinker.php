<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class Tinker extends Component
{
    public $showAddRemoteProject = false;

    /**
     * @var Project
     */
    public $project;

    protected $listeners = ['changeProject', 'toggleAddProject'];

    public function mount()
    {
        $this->project = Project::openDefault();
    }

    public function updatingProjectPath($value)
    {
        $this->projectName = basename($value);
    }

    public function changeProject($projectId)
    {
        $this->project = Project::find($projectId);

        $this->project->setAsActive();

        $this->showAddRemoteProject = false;

        $this->emit('projectChanged');
    }

    public function toggleAddRemoteProject()
    {
        $this->showAddRemoteProject = !$this->showAddRemoteProject;
    }

    public function closePopup()
    {
        $this->showAddRemoteProject = false;
    }

    public function selectDirectory($path)
    {
        $this->currentDirectory = $path;

        $project = Project::create([
            'name' => basename($this->currentDirectory),
            'path' => $this->currentDirectory,
            'type' => 'local',
        ]);

        $this->emit('changeProject', $project->id);
    }

    public function render()
    {
        return view('livewire.tinker');
    }
}
