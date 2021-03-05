<div class="w-full h-full pb-6">
    <div class="tinker grid h-full w-full" style="grid-template-columns: 1fr 2px 1fr">
        <div class="h-full editor">
            <livewire:editor :code="$this->project->code ?? ''"/>
        </div>
        <div class="h-full">
            <livewire:output/>
        </div>
        <div class="vertial-gutter bg-gray-700 row-start-1 col-start-2 w-1" style="cursor: ew-resize"></div>
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

    <script>
        document.addEventListener('livewire:load', function () {
            window.Split({
                columnGutters: [{
                    track: 1,
                    element: document.querySelector('.vertial-gutter'),
                }]
            });
        });
    </script>

</div>