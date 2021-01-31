<div>
    <textarea class="p-10 pr-0" id="output" wire:model="output"></textarea>

    <script>
        function makeCodeMirror() {
            CodeMirror.fromTextArea(document.getElementById('output'), {
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
            makeCodeMirror();

            Livewire.on('submit', code => {
                Livewire.emit('execute', code)
            })

            Livewire.hook('message.processed', (el, component) => {
                makeCodeMirror();
            })
        })
    </script>
</div>
