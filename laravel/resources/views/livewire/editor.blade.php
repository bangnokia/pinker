<section class="border-r-2 border-gray-500">
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
            const codeMirror = CodeMirror.fromTextArea(document.getElementById('editor'), config);
            @this.on('projectChanged', function () {
                console.log('project changed', @this.code);
                codeMirror.getDoc().setValue(@this.code);
            })
        });
    </script>
</section>
