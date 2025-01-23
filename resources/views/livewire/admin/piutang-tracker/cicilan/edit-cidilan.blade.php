<div>
    <button type="button" data-tooltip-target="tooltip-default-{{ $cicilan->id }}" wire:click="openModal"
        class="flex items-center justify-center text-cyan-500 hover:text-cyan-700 font-bold">
        Edit
    </button>

    <div id="tooltip-default-{{ $cicilan->id }}" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Edit Cicilan ke {{ $cicilan->nomor_cicilan }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>


    <x-modal wire:model="showModal">
        <form wire:submit.prevent="update">
            <div class="p-4 md:p-5 space-y-4">
                <h1 class="text-gray-800 font-bold text-xl">Update Cicilan ke {{ $cicilan->nomor_cicilan }}</h1>
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-5">
                        <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Name product
                        </label>
                        <input type="text" autocomplete="off" id="product" name="product" wire:model="product"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                            cursor-not-allowed"
                            readonly />
                        <span class="text-red-500 text-sm">
                            @error('product')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-5">
                        <label for="jumlahCicilan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            jumlahCicilan
                        </label>
                        <input x-mask:dynamic="$money($input, ',')" type="text" autocomplete="off" id="jumlahCicilan"
                            name="jumlahCicilan" wire:model.blur="jumlahCicilan" inputmode="numeric"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Kursi" required />
                        <span class="text-red-500 text-sm">
                            @error('jumlahCicilan')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-5">
                        <label for="awalTempo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Awal Tempo
                        </label>
                        <input type="date" autocomplete="off" id="awalTempo" name="awalTempo"
                            wire:model.blur="awalTempo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Kursi" required />
                        <span class="text-red-500 text-sm">
                            @error('awalTempo')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-5">
                        <label for="akhirJatuhTempo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Akhir Jatuh Tempo
                        </label>
                        <input type="date" autocomplete="off" id="akhirJatuhTempo" name="akhirJatuhTempo"
                            wire:model.blur="akhirJatuhTempo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Kursi" required />
                        <span class="text-red-500 text-sm">
                            @error('akhirJatuhTempo')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-5">
                        <label for="statusPembayaran"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Status Pembanyaran
                        </label>
                        <input type="text" autocomplete="off" id="statusPembayaran" name="statusPembayaran"
                            wire:model.blur="statusPembayaran"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Kursi" required />
                        <span class="text-red-500 text-sm">
                            @error('statusPembayaran')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-5">
                        <label for="tanggalLunas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tanggal Lunas Pembanyaran
                        </label>
                        @if ($cicilan->tanggal_lunas != null)
                            <input type="date" autocomplete="off" id="tanggalLunas" name="tanggalLunas"
                                wire:model.blur="tanggalLunas"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Kursi" readonly />
                        @else
                            <select name="" id="" disabled
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
                        @endif
                        <span class="text-red-500 text-sm">
                            @error('tanggalLunas')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
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
