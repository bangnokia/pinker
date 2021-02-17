<div>
    <h3 class="font-medium mb-5">List remote project</h3>

    <div>
        @foreach($projects as $project)
            <div class="hover:bg-gray-200 cursor-pointer px-2 py-1 rounded"
                wire:click="$emitTo('form-remote-project', 'takeProject', '{{ $project->id }}')">
                <span class="font-medium">{{ $project->name }}</span>
                <span class="text-gray-500 ml-2 text-sm">{{ $project->path }}</span>
            </div>
        @endforeach
    </div>
</div>
