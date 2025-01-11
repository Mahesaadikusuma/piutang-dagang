<div>
    <button type="button" data-tooltip-target="delete-{{ $role->id }}" wire:click="openModal"
        class="flex items-center justify-center text-red-500 hover:text-red-700 font-bold">
        Delete
    </button>

    <div id="delete-{{ $role->id }}" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Edit Role {{ $role->name }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <x-confirmation-modal wire:model="showModal">
        <x-slot name="title">

            Delete Role {{ $role->name }}
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete your account? Once your account is deleted, all of its resources and
            data will be permanently deleted.


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showModal')">
                Nevermind
            </x-secondary-button>

            <button wire:click='delete'
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mx-2">submit</button>
        </x-slot>
    </x-confirmation-modal>
</div>
