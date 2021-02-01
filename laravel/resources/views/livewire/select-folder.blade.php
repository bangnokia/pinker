<div>
    <div class="font-bold">{{ $currentDirectory }}</div>

    <div class="h-64 overflow-scroll mt-3 border">
    	@foreach ($this->children as $child)
    		@if (is_dir($this->currentDirectory.DIRECTORY_SEPARATOR.$child))
	    		<div class="px-2 flex align-center cursor-pointer hover:bg-blue-100"
	    			wire:click="changeDirectory('{{ $currentDirectory.DIRECTORY_SEPARATOR.$child.DIRECTORY_SEPARATOR }}')">
	    				<x-icons.folder class="w-5 h-5 text-yellow-500" />
	    				<span class="ml-1">{{ $child }}</span>
	    		</div>
    		@else
	    		<div class="px-2 flex align-center">
	    			<x-icons.document class="w-5 h-5 text-gray-400" />
	    			<span class="ml-1">{{ $child }}</span>
	    		</div>
    		@endif
    	@endforeach
    </div>

    <button class="bg-cyan-500 hover:bg-cyan-600 px-5 py-1 mt-3 text-white">@lang('Select this directory')</button>
</div>
