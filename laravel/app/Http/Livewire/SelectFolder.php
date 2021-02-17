<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class SelectFolder extends Component
{
    public $currentDirectory = '';

    public function mount()
    {
        $this->currentDirectory = getenv('HOME');
    }

    public function getChildrenProperty()
    {
        return scandir($this->currentDirectory, SCANDIR_SORT_DESCENDING);
    }

    public function changeDirectory($directory)
    {
        $this->currentDirectory = realpath($directory);
    }

    public function selectDirectory()
    {
        $project = Project::create([
            'name' => basename($this->currentDirectory),
            'path' => $this->currentDirectory,
            'type' => 'local',
        ]);

        $this->emit('changeProject', $project->id);
    }

    public function render()
    {
        return view('livewire.select-folder');
    }
}
