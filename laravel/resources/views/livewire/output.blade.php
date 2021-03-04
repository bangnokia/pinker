<div class="relative">
    <div wire:ignore>
        <textarea class="p-10 pr-0" id="output" wire:model="output" style="display: none"></textarea>
    </div>

    <x-icons.refresh class="animate-spin h-4 w-4 absolute z-20 top-0 right-0 mr-2 mt-2 text-white" wire:loading />

    <script>
        function makeCodeMirror() {
            return CodeMirror.fromTextArea(document.getElementById('output'), {
                mode: 'text/x-php',
                lineNumbers: true,
                lineWrapping: true,
                tabSize: 4,
                theme: 'dracula',
                readOnly: true,
                cursorBlinkRate: -1
            })
        }

        document.addEventListener('livewire:load', function () {
            const codeMirror = makeCodeMirror();

            Livewire.on('submit', code => {
                Livewire.emit('execute', code)
            })

            Livewire.on('outputUpdated', (el, component) => {
                codeMirror.getDoc().setValue(@this.output)
            })
        })
    </script>
</div>
