<div class="w-screen h-screen">
    <div class="tinker flex h-full w-full">

        <div class="w-1/2 editor">
            <livewire:editor :code="$this->project->code ?? ''"/>
        </div>

        <div class="w-1/2">
            <livewire:output/>
        </div>
    </div>

    <div
        class="absolute bottom-0 left-0 w-screen bg-gray-400 z-10 px-5 flex space-x-3 font-mono text-sm flex items-center content-center">
        <x-icons.folder-open class="w-5 h-5 cursor-pointer" wire:click="toggleAddProject"/>
        <div>
            @lang('Project'): {{ $this->project->name }}
        </div>
        <div class="flex">
            @lang('Path'): <div class="inline-block max-w-lg truncate" title="{{ $this->project->path }}">{{ $this->project->path }}</div>
        </div>
    </div>

    @if ($showAddProject)
        <div class="absolute top-1/2 -mt-48 left-0 w-full h-96 flex justify-center z-10">
            <div class="sm:w-full md:w-2/3 bg-white p-5 flex space-x-5">
                <div class="w-96">
                    <livewire:select-folder/>
                </div>
                <div>
                    <livewire:recent-projects/>
                </div>
            </div>
        </div>
    @endif
</div>
