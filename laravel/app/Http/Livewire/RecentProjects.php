<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class RecentProjects extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::query()->local()->latest('updated_at')->limit(7)->get();
    }

    public function render()
    {
        return view('livewire.recent-projects');
    }
}
