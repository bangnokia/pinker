<div>
    <h3 class="font-bold text-gray-500">Recent projects</h3>
    <div class="mt-3">
        @foreach($projects as $project)
            <div class="hover:bg-gray-200 cursor-pointer px-2 py-1 rounded" wire:click="$emitUp('changeDirectory', '{{ $project->path }}')">
                <span class="font-medium">{{ $project->name }}</span>
                <span class="text-gray-500 ml-2 text-sm">{{ $project->path }}</span>
            </div>
        @endforeach
    </div>
</div>
