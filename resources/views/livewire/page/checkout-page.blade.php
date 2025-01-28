<div>
    <section id="checkout" class="container mx-auto my-12 sm:my-16 lg:my-48">
        <div class="flex flex-col lg:flex-row justify-center gap-8 lg:gap-[118px]">
            <!-- Product Info -->
            <div class="product-info flex flex-col gap-4 w-full lg:w-min h-fit mt-[18px]">
                <h1 class="font-semibold text-[32px]">Checkout Product</h1>
                <div class="product-detail flex flex-col gap-3">
                    <div class="thumbnail w-full lg:w-[412px] h-[255px] flex shrink-0 rounded-[20px] overflow-hidden">
                        <img src="{{ Storage::url($product->thumbnail) }}" class="w-full h-full object-cover"
                            alt="thumbnail">
                    </div>
                    <div class="product-title flex flex-col gap-[30px]">
                        <div class="flex flex-col gap-3">
                            <p class="font-semibold">Huis Elite: The Complete Smart Home App UI Kit for Modern Living
                            </p>
                            <p
                                class="bg-[#2A2A2A] font-semibold text-xs text-belibang-grey rounded-[4px] p-[4px_6px] w-fit">
                                Template
                            </p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p
                                class="font-semibold text-4xl bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                {{ $product->priced }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <form wire:submit="checkout"
                class="flex flex-col p-[30px] gap-[60px] rounded-[20px] w-[450px] border-2 border-belibang-darker-grey">
                @if ($showError)
                    <p class="text-red-500 text-sm mt-2">{{ session('error') }}</p>
                @endif
                <div class="w-full flex flex-col gap-4">
                    <p class="font-semibold text-xl">Order Summary:</p>
                    <div class="flex justify-between gap-3">
                        <div>
                            <p>{{ $product->name }}</p>
                            <p>Rp. {{ number_format($price) }}</p>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <button type="button" wire:click="decrement" class="rounded cursor-pointer"
                                    @if ($qty <= 1) class="opacity-50 cursor-not-allowed" @endif>-</button>

                                <input class="max-w-12 text-center border-0 bg-transparent" type="text"
                                    wire:model="qty" readonly />

                                <button type="button" wire:click="increment" class="rounded cursor-pointer"
                                    @if ($qty >= $product->stok) class="opacity-50 cursor-not-allowed" @endif>+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full flex flex-col gap-2">
                    <p class="font-semibold text-xl">Jenis Pembayaran</p>
                    <div class="flex justify-center gap-2 w-full my-3">
                        <input wire:click="setPaymentType('tunai')" type="button" value="Tunai"
                            class="w-full py-2 text-white font-semibold rounded-lg transition-all duration-300 cursor-pointer 
                                {{ $paymentType === 'tunai' ? 'bg-neutral-800 hover:bg-neutral-900 shadow-md' : 'bg-gray-800 text-gray-700 hover:bg-gray-900' }}">

                        <input wire:click="setPaymentType('cicilan')" type="button" value="Cicilan"
                            class="w-full py-2 text-white font-semibold rounded-lg transition-all duration-300 cursor-pointer
                                {{ $paymentType === 'cicilan' ? 'bg-neutral-800 hover:bg-neutral-900 shadow-md' : 'bg-gray-800 text-gray-700 hover:bg-gray-900' }}">
                    </div>

                    @if ($paymentType === 'cicilan' && $qty > 5)
                        <div>
                            <p class="font-semibold text-xl">Cicilan</p>
                            <div class="flex justify-center w-full my-3 gap-2">
                                <!-- Opsi Cicilan 2x -->
                                <div class="flex items-center ps-4 border border-gray-700 w-full">
                                    <input id="bordered-radio-1" type="radio" value="2" wire:model="setCicilan"
                                        name="cicilan"
                                        class="w-4 h-4 text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-1"
                                        class="w-full py-4 ms-2 text-sm font-medium dark:text-gray-300">
                                        2x
                                    </label>
                                </div>

                                <!-- Opsi Cicilan 3x -->
                                <div class="flex items-center ps-4 border border-gray-700 w-full">
                                    <input id="bordered-radio-2" type="radio" value="3" wire:model="setCicilan"
                                        name="cicilan"
                                        class="w-4 h-4 text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-2"
                                        class="w-full py-4 ms-2 text-sm font-medium dark:text-gray-300">
                                        3x
                                    </label>
                                </div>
                            </div>

                            <div class="flex justify-between gap-2">
                                <div
                                    class="flex items-center gap-2 p-[12px_20px] pl-4 justify-between rounded-lg bg-[#181818] hover:ring-[1px] hover:ring-[#A0A0A0] focus:ring-[1px] focus:ring-[#A0A0A0] transition-all duration-300 w-full ">
                                    <div class="flex-col items-center w-full">
                                        <label for="start_at" class="text-xs text-belibang-grey pl-1">Start At</label>
                                        <div class="flex mt-1 items-center ">
                                            <input id="awal_tempo" type="date" name="awal_tempo"
                                                wire:model="start_at"
                                                class="font-semibold bg-transparent ring-0 border-0 focus:ring-0 focus:outline-none text-white appearance-none autofull-no-bg outline-none px-1 placeholder:text-[#595959] placeholder:font-normal placeholder:text-sm w-full">
                                        </div>
                                    </div>

                                    <div class="flex-col items-center  w-full">
                                        <label for="akhir_jatuh_tempo" class="text-xs text-belibang-grey pl-1">End
                                            At</label>
                                        <div class="flex mt-1 items-center ">
                                            <input id="akhir_jatuh_tempo" type="date" name="akhir_jatuh_tempo"
                                                wire:model="end_at"
                                                class="font-semibold bg-transparent ring-0 border-0 focus:ring-0 focus:outline-none text-white appearance-none autofull-no-bg outline-none px-1 placeholder:text-[#595959] placeholder:font-normal placeholder:text-sm w-full">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="w-full flex flex-col gap-4">
                    <p class="font-semibold text-xl">Confirm Payment</p>
                    <div class="flex justify-between">
                        <p>Tax</p>
                        <p>11%</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Transaction Total</p>
                        <p>Rp. {{ number_format($total) }}</p>
                    </div>
                </div>
                <button type="submit" wire:loading.remove wire:loading.attr="disabled"
                    class="rounded-full text-center bg-[#2D68F8] p-[8px_18px] font-semibold hover:bg-[#083297] active:bg-[#062162] transition-all duration-300">Checkout
                    Now</button>

                <button wire:loading wire:target="checkout, decrement, increment, setPaymentType"
                    wire:loading.attr="disabled" type="button"
                    class="rounded-full text-center bg-[#2D68F8] p-[8px_18px] bg-opacity-50 font-semibold hover:bg-[#083297] active:bg-[#062162] transition-all duration-300">
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
            </form>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const today = new Date();
            const awal_tempo = document.getElementById('awal_tempo');
            const akhir_jatuh_tempo = document.getElementById('akhir_jatuh_tempo');
            console.log(awal_tempo, akhir_jatuh_tempo)

            flatpickr(awal_tempo, {
                dateFormat: "Y-m-d",
                minDate: today,
                onChange: function(selectedDates, dateStr, instance) {
                    @this.set('start_at', dateStr);
                    let startDate = new Date(dateStr);
                    let endDate = new Date(startDate.setMonth(startDate.getMonth() + 3));
                    let formattedEndDate = endDate.toISOString().split('T')[0];
                    @this.set('end_at', formattedEndDate);
                    akhir_jatuh_tempo._flatpickr.setDate(formattedEndDate);
                }
            });

            flatpickr(akhir_jatuh_tempo, {
                dateFormat: "Y-m-d",
                minDate: new Date(today.setMonth(today.getMonth() + 3)),
                onChange: function(selectedDates, dateStr, instance) {
                    @this.set('end_at', dateStr);
                }
            });
        })
    </script>
@endpush
