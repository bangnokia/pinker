<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class ListRemoteProject extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::ssh()->latest()->get();
    }

    public function render()
    {
        return view('livewire.list-remote-project');
    }
}
