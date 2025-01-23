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
                        <input type="search" wire:model.live.debounce.500ms='search' id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Search">
                    </div>
                </form>
            </x-slot>

            <x-slot name="actions">
                <a href="{{ route('productCreate') }}"
                    class="flex items-center justify-center text-gray-100 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-primary-800">Add
                    Product
                </a>
            </x-slot>

            @forelse ($products as $product)
                <tr class="border-b dark:border-gray-700">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-4 py-3">{{ $product->name }}</td>
                    <td class="px-4 py-3">{{ $product->category->name }}</td>
                    <td class="px-4 py-3">{{ Str::limit($product->description, 10) }}</td>
                    <td class="px-4 py-3">
                        <div class="">
                            <img src="{{ Storage::url($product->thumbnail) }}" alt=""
                                class="w-full h-16 object-cover">
                        </div>
                    </td>

                    <td class="px-4 py-3">{{ $product->stocked }}</td>
                    <td class="px-4 py-3">{{ $product->priced }}</td>
                    <td class="px-4 py-3">{{ $product->created_at->diffForHumans() }}</td>
                    <td>
                        <div wire:ignore class="flex gap-3 items-center">
                            <a href="{{ route('productEdit', $product->slug) }}"
                                class="text-blue-600 hover:underline">Edit</a>
                            <livewire:admin.product.product-delete lazy="on-load" :product="$product" :key="$product->id" />
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="border-b dark:border-gray-700">
                    <td colspan="{{ count($heads) }}" class="px-4 py-10 text-center">
                        <div class="flex flex-col justify-center items-center h-full">
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No Product found
                            </p>
                        </div>
                    </td>
                </tr>
            @endforelse

            <x-slot name="pagination">
                {{ $products->links() }}
            </x-slot>
        </x-table>
    </section>
</div>
