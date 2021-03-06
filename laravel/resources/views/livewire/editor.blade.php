<section>
    <div wire:ignore>
        <textarea wire:model="code" id="editor" style="display: none"></textarea>
    </div>

    <script type="text/javascript">
        document.addEventListener('livewire:load', function () {
            let config = {
                mode: 'text/x-php',
                lineNumbers: true,
                indentWithTabs: true,
                lineWrapping: true,
                tabSize: 4,
                indentUnit: 4,
                theme: 'dracula',
                autofocus: true,
                keyMap: 'vim',
                extraKeys: {
                    'Cmd-Enter': function (cm) {
                        Livewire.emit('submit', cm.getValue());
                    },
                    'Ctrl-Enter': function (cm) {
                        Livewire.emit('submit', cm.getValue());
                    }
                }
            };
            const codeMirror = CodeMirror.fromTextArea(document.getElementById('editor'), config);

            Livewire.on('projectChanged', function () {
                codeMirror.getDoc().setValue(@this.code);
            })
        });
    </script>
</section>
