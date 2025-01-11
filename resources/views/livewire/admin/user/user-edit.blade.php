<div>
    <button type="button" data-tooltip-target="tooltip-default-{{ $user->id }}" wire:click="openModal"
        class="flex items-center justify-center text-cyan-500 hover:text-cyan-700 font-bold">
        Edit
    </button>

    <div id="tooltip-default-{{ $user->id }}" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Edit User {{ $user->name }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <x-modal wire:model="showModal">
        <form wire:submit.prevent="update">
            <div class="p-4 md:p-5 space-y-4">
                <h1 class="text-gray-800 font-bold text-xl">Update Roles</h1>
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Name
                    </label>
                    <input type="text" autocomplete="off" id="name" name="name" wire:model.blur="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Kursi" required />
                    <span class="text-red-500 text-sm">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email
                    </label>
                    <input type="text" autocomplete="off" id="email" name="email" wire:model.blur="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Kursi" disabled required />
                    <span class="text-red-500 text-sm">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-5">
                    <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Roles
                    </label>
                    @foreach ($this->roles as $item)
                        <input type="checkbox" id="role-{{ $item->id }}" name="rolesSelected[]"
                            value="{{ $item->id }}" wire:model="rolesSelected">

                        <label for="role-{{ $item->id }}"> {{ $item->name }} </label>
                    @endforeach
                </div>

                <div class="mb-5">
                    <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Permission
                    </label>
                    @foreach ($this->permissions as $permission)
                        <input type="checkbox" id="role-{{ $permission->id }}" name="permissionsSelected"
                            value="{{ $permission->id }}" wire:model="permissionsSelected">

                        <label for="role-{{ $permission->id }}"> {{ $permission->name }} </label>
                    @endforeach
                </div>


                <div class="flex flex-row justify-end gap-3 text-end">
                    <x-secondary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                        Cancel
                    </x-secondary-button>

                    <x-button type="submit" wire:loading.attr="disabled">Save</x-button>
                </div>
            </div>
        </form>
    </x-modal>
</div>
