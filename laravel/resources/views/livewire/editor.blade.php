<section class="border-r-2 border-gray-500">
    <textarea wire:model="code" id="editor"></textarea>

    <script type="text/javascript">
        document.addEventListener('livewire:load', function () {
            Livewire.emit('submit');
            let config = {
                mode: 'text/x-php',
                lineNumbers: true,
                indentWithTabs: true,
                lineWrapping: true,
                tabSize: 4,
                theme: 'dracula',
                autofocus: true,
                extraKeys: {
                    'Cmd-Enter': function (cm) {
                        Livewire.emit('submit', cm.getValue());
                    },
                    'Ctrl-Enter': function () {
                        Livewire.emit('submit');
                    }
                }
            };
            CodeMirror.fromTextArea(document.getElementById('editor'), config);
        });
    </script>
</section>
