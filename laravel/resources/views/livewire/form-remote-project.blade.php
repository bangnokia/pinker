<div>
    <div class="flex items-center mb-2">
        <label for="" class="inline-block w-32 text-gray-500">Name</label>
        <input type="text" wire:model="project.name"
               class="border border-gray-300 rounded w-full px-2 py-1 focus:outline-none focus:border-cyan-500">
    </div>
    <div class="flex items-center mb-2">
        <label for="" class="inline-block w-32 text-gray-500">Host</label>
        <div class="flex w-full">
            <input type="text" wire:model="project.host"
                   class="border border-gray-300 rounded w-full px-2 py-1 focus:outline-none focus:border-cyan-500">
            <input type="text" placeholder="port" wire:model="project.port"
                   class="ml-2 w-16 border border-gray-300 rounded px-2 py-1 focus:outline-none focus:border-cyan-500">
        </div>
    </div>
    <div class="flex items-center mb-2">
        <label for="" class="inline-block w-32 text-gray-500">User</label>
        <input type="text" wire:model="project.user"
               class="border border-gray-300 rounded w-full px-2 py-1 focus:outline-none focus:border-cyan-500">
    </div>
    <div class="flex items-center mb-2">
        <label for="" class="inline-block w-32 text-gray-500">Auth type</label>

        <div class="flex w-full space-x-3">
            <label for="auth-private-key" class="flex content-center space-x-3 items-center">
                <input type="radio" wire:model="project.auth_type" name="auth_type" value="private_key" class="mr-2"
                       id="auth-private-key"> Private
                key
            </label>
            <label for="auth-password" class="flex content-center space-x-3 items-center">
                <input type="radio" wire:model="project.auth_type" name="auth_type" value="password" class="mr-2"
                       id="auth-password"> Password
            </label>
        </div>
    </div>
    <div class="flex items-center mb-2">
        <label for="" class="inline-block w-32 text-gray-500">Private key</label>
        <input type="text" placeholder="~/.ssh/id_rsa" wire:model="project.private_key"
               class="border border-gray-300 rounded w-full px-2 py-1 focus:outline-none focus:border-cyan-500">
    </div>
    <div class="flex items-center mb-2">
        <label for="" class="inline-block w-32 text-gray-500">Passphrase</label>
        <input type="text" wire:model="project.password"
               class="border border-gray-300 rounded w-full px-2 py-1 focus:outline-none focus:border-cyan-500">
    </div>
    <div class="flex items-center mb-2">
        <label for="" class="inline-block w-32 text-gray-500">Password</label>
        <input type="text" wire:model="project.password"
               class="border border-gray-300 rounded w-full px-2 py-1 focus:outline-none focus:border-cyan-500">
    </div>

    <div class="flex items-center mb-2">
        <label for="" class="inline-block w-32 text-gray-500">Path</label>
        <input type="text" wire:model="project.path"
               class="border border-gray-300 rounded w-full px-2 py-1 focus:outline-none focus:border-cyan-500">
    </div>
    <div class="flex items-center mb-2">
        <label for="" class="inline-block w-32 text-gray-500">PHP binary</label>
        <input type="text" wire:model="project.php_binary"
               class="border border-gray-300 rounded w-full px-2 py-1 focus:outline-none focus:border-cyan-500">
    </div>
</div>
