<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class FormRemoteProject extends Component
{
    /**
     * @var Project
     */
    public $project;

    protected $rules = [
        'project.auth_type' => 'string'
    ];

    public function mount()
    {
        $this->project = $this->project ?: new Project([
            'auth_type' => 'private_key'
        ]);
    }

    public function render()
    {
        return view('livewire.form-remote-project');
    }
}
