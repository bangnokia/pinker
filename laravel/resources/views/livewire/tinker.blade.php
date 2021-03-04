<div class="w-screen h-screen">
    <div class="tinker flex h-full w-full">

        <div class="w-1/2 editor">
            <livewire:editor :code="$this->project->code ?? ''"/>
        </div>

        <div class="w-1/2">
            <livewire:output/>
        </div>
    </div>

    @include('livewire.status-bar', ['project' => $project])

    @if ($showAddRemoteProject)
        <div class="absolute top-1/2 -mt-64 left-0 w-full h-auto flex justify-center z-10">
            <div class="w-2/3 2xl:w-1/2 bg-white p-5 space-x-5 transition transition-all rounded-lg">
                <div class="flex space-x-5 relative">
                    <div class="w-96">
                        <livewire:form-remote-project />
                    </div>
                    <div>
                        <livewire:list-remote-project />
                    </div>
                    <button
                        class="btn absolute right-0 bottom-0 bg-gray-400 hover:bg-gray-500 px-3 py-1 mt-3 text-white"
                        wire:click="closePopup">@lang('Close')</button>
                </div>
            </div>
        </div>
    @endif

</div>