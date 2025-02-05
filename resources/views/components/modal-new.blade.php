@props(['id' => '', 'title' => '', 'type'])


@php
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div x-cloak x-show="showModal" x-transition.opacity.duration.200ms x-trap.inert.noscroll="showModal"
    @keydown.esc.window="showModal = false" @click.self="showModal = false"
    class="fixed inset-0 z-50 flex justify-center bg-black/20 dark:bg-black/50 p-4 pb-8 backdrop-blur-md items-center lg:p-8"
    role="dialog" aria-modal="true" aria-labelledby="modalConfirm">

    <!-- Modal Dialog -->
    <div x-show="showModal"
        x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="flex flex-col gap-4 rounded-xl border border-gray-300 dark:border-slate-700 
               bg-white dark:bg-slate-800 text-gray-900 dark:text-slate-300 w-full {{ $maxWidth }} shadow-lg">

        <!-- Dialog Header -->
        <div
            class="flex items-center justify-between border-b px-4 py-2 
                    border-gray-300 dark:border-slate-700 bg-gray-100 dark:bg-slate-900/20">
            <div>
                {{ $title }}
            </div>
            <button @click="showModal = false" aria-label="close modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                    fill="none" stroke-width="1.4" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Dialog Body -->
        <div class="p-4" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            {{ $slot }}
        </div>
    </div>
</div>
