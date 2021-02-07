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
        'project.name'        => 'string|required',
        'project.host'        => 'required|string',
        'project.port'        => 'required|integer|min:22',
        'project.user'        => 'required|string',
        'project.auth_type'   => 'required|string|in:private_key,password',
        'project.private_key' => 'required_if:auth_type,private_key',
        'project.passphrase'  => 'nullable',
        'project.password'    => 'required_if:auth_type,password',
        'project.path'        => 'required|string',
        'project.php_binary'  => 'required|string'
    ];

    public function mount()
    {
        $this->project = $this->project ?: new Project([
            'type'      => 'ssh',
            'port'      => 22,
            'auth_type' => 'private_key',
        ]);
    }

    public function connect()
    {
        $this->validate();
        dd($this->project);
    }

    public function render()
    {
        return view('livewire.form-remote-project');
    }
}
