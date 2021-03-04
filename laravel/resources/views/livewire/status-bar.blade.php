<div
    class="absolute bottom-0 left-0 w-screen bg-gray-400 z-10 px-5 flex space-x-3 font-mono text-sm flex items-center content-center">
    <x-icons.cloud class="w-5 h-5 cursor-pointer hover:bg-cyan-500" wire:click="toggleAddRemoteProject" title="ssh projects"/>
    <x-icons.folder-open class="w-5 h-5 cursor-pointer hover:bg-cyan-500" onclick="openFolderDialog()" title="local projects"/>
    <div>
        @lang('Project'): {{ $project->name }}
    </div>
    <div class="flex">
        @lang('Path'):
        <div class="inline-block max-w-lg truncate"
             title="{{ $project->path }}">{{ $project->path }}</div>
    </div>

    
    <script>
        document.addEventListener('livewire:load', function () {
            window.ipcRenderer.on('folderOpened', function (event, path) {
                @this.selectDirectory(path);
            });
        });
        function openFolderDialog() {
            window.ipcRenderer.send('openFolder');
        }
    </script>
</div>
