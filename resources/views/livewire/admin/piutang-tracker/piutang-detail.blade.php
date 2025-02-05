<div>
    <a wire:navigate href="{{ route('piutangs.index') }}" class="flex items-center mb-5  ">
        <svg class="w-6 h-6 text-gray-800 dark:text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M13.729 5.575c1.304-1.074 3.27-.146 3.27 1.544v9.762c0 1.69-1.966 2.618-3.27 1.544l-5.927-4.881a2 2 0 0 1 0-3.088l5.927-4.88Z"
                clip-rule="evenodd" />
        </svg>
        <span class="mr-2">Kembali</span>
    </a>
    <div class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">

        <h1>Piutang Detail : {{ $piutang->user->name }}</h1>
        <div class="">

            <div class="w-3/12 object-cover">
                <img src="{{ Storage::url($piutang->product->thumbnail) }}" alt="">
            </div>

            <div class="">
                <p>Awal Tempo : {{ $piutang->awal_tempo_formatted }}</p>
                <p>Akhir Tempo: {{ $piutang->akhir_jatuh_tempo_formatted }}</p>
            </div>
        </div>
    </div>

    <div class="">
        <h2>Cicilan</h2>

        <x-table :heads="$heads">
            <x-slot name="search"></x-slot>
            <x-slot name="actions">
            </x-slot>

            @forelse ($cicilans as $cicilan)
                <tr wire:key="{{ $cicilan->id }}" class="border-b dark:border-gray-700">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $cicilan->nomor_cicilan }}
                    </th>
                    <td class="px-4 py-3">{{ $cicilan->piutang->product->name }}</td>
                    <td class="px-4 py-3">{{ $cicilan->jumlah_cicilan_formatted }}</td>
                    <td class="px-4 py-3">{{ $cicilan->awal_tempo_formatted }}</td>
                    <td class="px-4 py-3">{{ $cicilan->akhir_jatuh_tempo_formatted }}</td>
                    <td class="px-4 py-3">{{ $cicilan->status_pembayaran }}</td>
                    <td class="px-4 py-3">
                        <div class="flex gap-3 items-center" wire:ignore>
                            @livewire('admin.piutang-tracker.cicilan.edit-cidilan', ['cicilan' => $cicilan], key($cicilan->id))
                            @if ($cicilan->status_pembayaran === App\Enums\StatusType::SUCCESS->value)
                                sudah success
                            @else
                                @livewire('admin.piutang-tracker.cicilan.transaction', ['cicilan' => $cicilan], key($cicilan->id))
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <p>Belum ada cicilan</p>
            @endforelse

            <x-slot name="pagination">
            </x-slot>
        </x-table>
    </div>
</div>
