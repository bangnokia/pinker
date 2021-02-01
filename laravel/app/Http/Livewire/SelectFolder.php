<?php

namespace App\Http\Livewire;

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

    public function render()
    {
        return view('livewire.select-folder');
    }
}
