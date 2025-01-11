<div>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <a wire:navigate href="{{ route('productList') }}" class="flex items-center mb-5  ">
            <svg class="w-6 h-6 text-gray-800 dark:text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M13.729 5.575c1.304-1.074 3.27-.146 3.27 1.544v9.762c0 1.69-1.966 2.618-3.27 1.544l-5.927-4.881a2 2 0 0 1 0-3.088l5.927-4.88Z"
                    clip-rule="evenodd" />
            </svg>
            <span class="mr-2">Kembali</span>
        </a>
        <form wire:submit.prevent="update">
            <div class="flex flex-col gap-2">
                <div class="my-5" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    @if ($thumbnail)
                        <div class="w-1/6 h-1/6 mb-3 ">
                            <img src="{{ $thumbnail->temporaryUrl() }}" class="object-cover">
                        </div>
                    @endif
                    <label for="thumbnail"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thumbnail</label>
                    <input type="file" wire:model.blur="thumbnail" name="thumbnail" id="thumbnail"
                        accept="image/jpg, image/jpeg, image/png"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />

                    <div x-show="uploading" class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
                        <progress max="100" x-bind:value="progress"
                            class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500"></progress>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Name
                    </label>
                    <input wire:model.blur="name" type="text" name="name" id="name"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Name Product" required="">
                    <span class="text-red-500 text-sm">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-5">
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Category
                    </label>
                    <select id="category_id" name="category_id" wire:model='category_id'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Category</option>
                        @foreach ($this->categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Price
                    </label>
                    <input wire:model.blur="price" type="number" name="price" id="price"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Price Product" required="">
                    <span class="text-red-500 text-sm">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mb-5">
                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Stock
                    </label>
                    <input wire:model.blur="stock" type="number" min="1" name="stock" id="stock"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Price Product" required="">
                    <span class="text-red-500 text-sm">
                        @error('stock')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-5">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Description
                    </label>
                    <textarea wire:model.blur="description" id="description" name="description" rows="4"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 h-52"
                        placeholder="Write your thoughts here..."></textarea>
                    <span class="text-red-500 text-sm">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-5">
                    <button wire:loading.remove wire:target="thumbnail, update" wire:loading.attr="disabled"
                        type="submit"
                        class="bg-blue-700 hover:bg-blue-800 focus:ring-4 text-white focus:ring-blue-300 rounded-lg w-full py-2 mb-2 dark:bg-blue-600 text-base font-bold dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Update
                    </button>

                    <button wire:loading wire:target="update, thumbnail" wire:loading.attr="disabled" type="button"
                        class="bg-blue-700 hover:bg-blue-800 focus:ring-4 text-white focus:ring-blue-300 rounded-lg w-full py-2 mb-2 dark:bg-blue-600 text-base font-bold dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor" />
                        </svg>
                        Loading...
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>
