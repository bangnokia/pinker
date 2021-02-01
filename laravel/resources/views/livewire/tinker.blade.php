<div class="w-screen h-screen">
    <div class="tinker flex h-full w-full">

        <div class="w-1/2 editor">
            <livewire:editor/>
        </div>

        <div class="w-1/2">
            <livewire:output/>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-screen bg-gray-400 z-10 px-5 flex space-x-3 font-mono text-sm">
        <div class="flex items-center cursor-pointer" wire:click="toggleAddProject">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                      clip-rule="evenodd"></path>
                <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"></path>
            </svg>
        </div>
        <div>
            @lang('Project'): {{ $this->project->name }} | @lang('Path'): {{ $this->project->path }}
        </div>
    </div>

    @if ($showAddProject)
        <div class="absolute top-1/2 -mt-48 left-0 w-full h-96 flex justify-center z-10">
            <div class="w-1/2 bg-white p-5">
                <div class="flex">
                    <label class="w-1/4" for="project-path">@lang('Path')</label>
                    <input type="text" class="border w-3/4 px-2" id="project-path" wire:model="projectPath">
                </div>
                <div class="flex mt-2">
                    <label class="w-1/4" for="project-name">@lang('Name')</label>
                    <input type="text" class="w-1/2 border px-2" id="project-name" wire:model="projectName">
                    <div class="w-1/4 pl-2">
                        <button class="px-3 bg-indigo-500 hover:bg-indigo-600 text-white font-sm" wire:click="addProject">@lang('Add')</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
