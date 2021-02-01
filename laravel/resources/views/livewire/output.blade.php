<div>
    <textarea class="p-10 pr-0" id="output" wire:model="output"></textarea>

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
                console.log('output updated')
                makeCodeMirror();
            })
        })
    </script>
</div>
