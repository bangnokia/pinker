<?php

namespace App\Http\Livewire;

use App\Executor;
use App\Models\Project;
use Livewire\Component;
use Symfony\Component\Process\Exception\ProcessTimedOutException;

class FormRemoteProject extends Component
{
    /**
     * @var Project
     */
    public $project;

    protected $rules = [
        'project.type'        => 'string', // ssh
        'project.name'        => 'string|required',
        'project.host'        => 'required|string',
        'project.port'        => 'required|integer|min:21',
        'project.user'        => 'required|string',
        'project.auth_type'   => 'required|string|in:private_key,password',
        'project.private_key' => 'required_if:project.auth_type,private_key',
        'project.passphrase'  => 'nullable',
        'project.password'    => 'required_if:project.auth_type,password',
        'project.path'        => 'required|string',
        'project.php_binary'  => 'required|string'
    ];

    protected $listeners = ['takeProject'];

    public function mount()
    {
        $this->project = $this->project ?: new Project([
            'type'        => 'ssh',
            'port'        => 22,
            'auth_type'   => 'private_key',
            'private_key' => '~/.ssh/id_rsa',
            'php_binary'  => 'php',
        ]);
    }

    public function takeProject($projectId)
    {
        $this->project = Project::find($projectId);
    }

    public function connect()
    {
        $this->validate();

        $this->project->save();

        try {
            $this->uploadPsycho();
        } catch(ProcessTimedOutException $exception) {
            session()->flash('connection_state', false);
            return false;
        }

        $this->project->setAsActive();

        $this->emit('changeProject', $this->project->id);
    }

    protected function uploadPsycho()
    {
        Executor::makeSsh($this->project)->upload(base_path('/../psycho.phar'), '/tmp/');
    }

    public function testConnection()
    {
        $this->validate();

        try {
            $process = Executor::makeSsh($this->project)->execute('ls -la');

            $success = $process->isSuccessful();
        } catch(ProcessTimedOutException $exception) {
            $success = false;
        }

        session()->flash('connection_state', $success);
    }

    public function render()
    {
        return view('livewire.form-remote-project');
    }
}
