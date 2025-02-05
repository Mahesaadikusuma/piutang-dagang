@props(['disabled' => false, 'label' => null, 'id' => null, 'name' => null])

<div x-data="datepicker(@entangle($attributes->wire('model')))" class="relative">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <input id="{{ $id }}" x-ref="myDatepicker" x-model="value" type="text" name="{{ $name }}"
        {{ $disabled ? 'disabled' : '' }}
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $disabled ? 'cursor-not-allowed' : '' }}">
</div>
@once
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('datepicker', (model) => ({
                value: model,
                init() {
                    this.pickr = flatpickr(this.$refs.myDatepicker, {
                        minDate: this.value,
                        dateFormat: "Y-m-d"
                    })
                    this.$watch('value', function(newValue) {
                        this.pickr.setDate(newValue);
                    }.bind(this));
                },
                reset() {
                    this.value = null;
                }
            }))
        })
    </script>
@endonce
