<div>
    <div class="" x-data="{ showModal: false }" @cicilan-updated.window="showModal = false">
        {{-- <button @click="showModal = true"
            class="text-sm text-center w-full px-3 py-1.5 border bg-gray-900 rounded-md focus:outline-none focus:ring-0 text-gray-50"
            type="button">Edit</button> --}}

        <x-button type="button" @click="showModal = true">
            Edit
        </x-button>

        <x-modal-new title="Edit Cicilan {{ $cicilan->nomor_cicilan }}">
            <form wire:submit="update">
                <div class="md:p-5 space-y-4">
                    <h1 class="text-gray-800 font-bold text-xl">Update Cicilan ke {{ $cicilan->nomor_cicilan }}</h1>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="mb-5">
                            <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Name product
                            </label>
                            <input type="text" autocomplete="off" id="product" name="product" wire:model="product"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed"
                                readonly />
                            <span class="text-red-500 text-sm">
                                @error('product')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="jumlah_cicilan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                jumlahCicilan
                            </label>

                            <input type="text" x-mask:dynamic="$money($input, ',')" autocomplete="off"
                                id="jumlah_cicilan" name="jumlah_cicilan" wire:model.blur="jumlahCicilan"
                                inputmode="numeric"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                            <span class="text-red-500 text-sm">
                                @error('jumlahCicilan')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <x-datepicker label="Awal Tempo" wire:model="awalTempo" name="awal_tempo" id="awal_tempo"
                                :disabled="$cicilan->nomor_cicilan == 1 ? true : false" />

                            <span class="text-red-500 text-sm">
                                @error('awalTempo')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <x-datepicker label="Akhir Jatuh Tempo" wire:model="akhirJatuhTempo" name="akhirJatuhTempo"
                                id="akhir_jatuh_tempo" />
                            <span class="text-red-500 text-sm">
                                @error('akhirJatuhTempo')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="statusPembayaran"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Status Pembayaran
                            </label>
                            <select id="statusPembayaran" wire:model.live="statusPembayaran"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach (\App\Enums\StatusType::cases() as $status)
                                    <option value="{{ $status->value }}" @selected($statusPembayaran == $status->value)>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-red-500 text-sm">
                                @error('statusPembayaran')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        @if ($statusPembayaran === \App\Enums\StatusType::SUCCESS->value)
                            <div class="mb-5">
                                <x-datepicker label="Tanggal Lunas Pembayaran" wire:model="tanggalLunas"
                                    name="tanggalLunas" id="tanggalLunas" />
                                <span class="text-red-500 text-sm">
                                    @error('tanggalLunas')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-row justify-end gap-3 text-end">
                        <x-secondary-button @click="showModal = !showModal" wire:loading.attr="disabled">
                            Cancel
                        </x-secondary-button>


                        <x-button type="submit" wire:loading.remove wire:target="update, statusPembayaran"
                            wire:loading.attr="disabled">Save</x-button>
                        <x-button wire:loading wire:target="update, statusPembayaran" wire:loading.attr="disabled"
                            type="button"><svg aria-hidden="true" role="status"
                                class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor" />
                            </svg>
                            Loading...</x-button>
                    </div>
                </div>
            </form>
        </x-modal-new>
    </div>
</div>
