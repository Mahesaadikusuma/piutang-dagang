<div>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <x-table :heads="$heads">
            <x-slot name="search">
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" wire:model.lazy='search' id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Search">
                    </div>
                </form>
            </x-slot>

            <x-slot name="actions">
            </x-slot>
            @forelse ($users as $index => $user)
                <tr class="border-b dark:border-gray-700">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{-- {{ $loop->iteration }} --}}
                        {{ $index + $users->firstItem() }}
                    </th>
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">
                        {{ $user->getRoleNames()->join(', ') }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $user->getPermissionNames()->join(', ') }}
                    </td>

                    <td class="px-4 py-3">{{ $user->created_at->diffForHumans() }}</td>
                    <td>
                        <div class="flex gap-3 items-center">
                            <livewire:admin.user.user-edit :user="$user" :key="$user->id" />
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="border-b dark:border-gray-700">
                    <td colspan="4" class="px-4 py-3 text-center">No Users found</td>
                </tr>
            @endforelse

            <x-slot name="pagination">
                {{ $users->links(data: ['scrollTo' => false]) }}
            </x-slot>
        </x-table>
    </section>
</div>
