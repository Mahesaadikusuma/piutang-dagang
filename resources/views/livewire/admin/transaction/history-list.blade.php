<div>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <h1 class="font-bold my-5">History Transaction : {{ Auth::User()->name }}</h1>
        <x-table :heads="$heads">
            <x-slot name="search">
                <div class="flex items-center">
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
                </div>
            </x-slot>

            <x-slot name="actions">
                <div x-data="{ openFilter: false }" class="relative">
                    <button @click="openFilter = !openFilter"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                clip-rule="evenodd" />
                        </svg>
                        Filter
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                    <div x-show="openFilter" x-cloak
                        class="absolute z-10 mt-2 w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Pilih Filter</h6>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-center">
                                <input id="apple" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    Apple (56)
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex space-x-4 items-center mb-3">
                    <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                    <select wire:model.lazy='limit'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="5">5</option>
                        <option value="7">7</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </x-slot>
            @forelse ($this->HistoryUser as $index => $historyUser)
                <tr class="border-b dark:border-gray-700">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $index + $this->HistoryUser->firstItem() }}
                    </th>
                    <td class="px-4 py-3">{{ $historyUser->kode_unik }}</td>
                    <td class="px-4 py-3">{{ $historyUser->user->name }}</td>
                    <td class="px-4 py-3">{{ Str::limit($historyUser->product->name, 30, '...') }}</td>
                    <td class="px-4 py-3">{{ $historyUser->qty }}</td>
                    <td class="px-4 py-3">{{ $historyUser->jenis_pembayaran }}</td>
                    <td class="px-4 py-3">{{ $historyUser->PriceTotal }}</td>
                    {{-- <td class="px-4 py-3">{{ $historyUser->cicilan ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $historyUser->awal_tempo?->translatedFormat('l d Y') ?? '-' }}</td>

                    <td class="px-4 py-3">
                        {{ $historyUser->akhir_jatuh_tempo ? $historyUser->akhir_jatuh_tempo->translatedFormat('l d Y') : '-' }}
                    </td> --}}
                    <td class="px-4 py-3">{{ $historyUser->status }}</td>

                    <td class="px-4 py-3">{{ $historyUser->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <a href="" class="text-blue-600 hover:underline">
                            Edit
                        </a>

                    </td>
                </tr>
            @empty
                <tr class="border-b dark:border-gray-700">
                    <td colspan="{{ count($heads) }}" class="px-4 py-10 text-center">
                        <div class="flex flex-col justify-center items-center h-full">
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No History Transaction found
                            </p>
                        </div>
                    </td>
                </tr>
            @endforelse

            <x-slot name="pagination">
                {{ $this->HistoryUser->links(data: ['scrollTo' => false]) }}
            </x-slot>
        </x-table>
    </section>
</div>
