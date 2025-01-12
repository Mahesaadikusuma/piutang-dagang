<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between my-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="my-1">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 w-full">
                    {{ __('Log in') }}
                </button>

                <a href="{{ route('register') }}"
                    class="text-sm text-gray-600 hover:text-gray-900 text-center block mt-3">
                    Don't have an account? <span class="underline font-bold text-gray-800">{{ __('Register') }}</span>
                </a>

                {{-- <button wire:loading.remove wire:target="avatar, save" wire:loading.attr="disabled" type="submit"
                    class="bg-blue-700 hover:bg-blue-800 focus:ring-4 text-white focus:ring-blue-300 rounded-lg w-full py-2 mb-2 dark:bg-blue-600 text-base font-bold dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Save
                </button> --}}
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
