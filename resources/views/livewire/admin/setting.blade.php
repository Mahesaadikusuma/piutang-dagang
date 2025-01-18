<div x-data="{ openTab: 'profile' }">
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <h1 class="text-gray-800 font-bold text-xl">Setting User</h1>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button
                        :class="openTab === 'profile' ? 'border-blue-500 text-blue-500' :
                            'border-transparent text-gray-500 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"
                        class="inline-block p-4 border-b-2 rounded-t-lg" @click="openTab = 'profile'" id="profile-tab"
                        type="button" role="tab" aria-controls="profile" :aria-selected="openTab === 'profile'">
                        Profile
                    </button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        :class="openTab === 'dashboard' ? 'border-blue-500 text-blue-500' :
                            'border-transparent text-gray-500 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"
                        class="inline-block p-4 border-b-2 rounded-t-lg" @click="openTab = 'dashboard'"
                        id="dashboard-tab" type="button" role="tab" aria-controls="dashboard"
                        :aria-selected="openTab === 'dashboard'">
                        Change Password
                    </button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div x-show="openTab === 'profile'" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile"
                role="tabpanel" aria-labelledby="profile-tab">
                <form wire:submit.prevent="save">
                    <div class="flex flex-col gap-2">
                        <div class="my-5" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-cancel="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            @if ($avatar)
                                <div class="w-1/6 mb-3 ">
                                    <img src="{{ $avatar->temporaryUrl() }}" class="object-cover ">
                                </div>
                            @else
                                <div class="w-1/6 mb-3 ">
                                    <img src="{{ Storage::url($setting->avatar) }}" class="object-cover ">
                                </div>
                            @endif
                            <label for="avatar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar</label>
                            <input type="file" wire:model.blur="avatar" name="avatar" id="avatar"
                                accept="image/jpg, image/jpeg, image/png"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />

                            <div x-show="uploading" class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
                                <progress max="100" x-bind:value="progress"
                                    class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500"></progress>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Username
                            </label>
                            <input wire:model.blur="username" type="text" name="username" id="username"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Name User" required="">
                            <span class="text-red-500 text-sm">
                                @error('username')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Email
                            </label>
                            <input type="email" wire:model.blur="email" name="email" id="email"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="email User" disabled>
                            <span class="text-red-500 text-sm">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="fullName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Full Name
                            </label>
                            <input wire:model.blur="fullName" type="text" name="fullName" id="fullName"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Name User" required="">
                            <span class="text-red-500 text-sm">
                                @error('fullName')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="phone_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Phone Number
                            </label>
                            <input type="number" wire:model.blur="phoneNumber" name="phone_number" id="phone_number"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Phone Number" required="">
                            <span class="text-red-500 text-sm">
                                @error('phoneNumber')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="provinces"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                            <select wire:model.live.debounce.500ms="provinceID" id="provinces" name="province_id"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih Provinsi</option>
                                @foreach ($this->provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-red-500 text-sm">
                                @error('provinceID')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="regencies"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten /
                                Kota</label>
                            <select wire:model.live.debounce.500ms="regencyID" id="regencies" name="regency_id"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih Kabupaten / Kota</option>
                                @foreach ($this->regencies as $regency)
                                    <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-red-500 text-sm">
                                @error('regencyID')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="districts"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Kecamatan</label>
                            <select wire:model.live.debounce.500ms="districtID" id="districts" name="district_id"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih Kecamatan</option>
                                @foreach ($this->districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-red-500 text-sm">
                                @error('districtID')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="villages"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Kelurahan</label>
                            <select wire:model.live.debounce.500ms="villageID" id="villages" name="village_id"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih Kecamatan</option>
                                @foreach ($this->villages as $village)
                                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-red-500 text-sm">
                                @error('villageID')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Address
                            </label>
                            <textarea wire:model.blur="address" id="address" name="address" rows="4"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 h-52"
                                placeholder="Write your thoughts here..."></textarea>
                            <span class="text-red-500 text-sm">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-5">
                            <button wire:loading.remove wire:target="avatar, save" wire:loading.attr="disabled"
                                type="submit"
                                class="bg-blue-700 hover:bg-blue-800 focus:ring-4 text-white focus:ring-blue-300 rounded-lg w-full py-2 mb-2 dark:bg-blue-600 text-base font-bold dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Save
                            </button>

                            <button wire:loading wire:target="save,avatar" wire:loading.attr="disabled"
                                type="button"
                                class="bg-blue-700 hover:bg-blue-800 focus:ring-4 text-white focus:ring-blue-300 rounded-lg w-full py-2 mb-2 dark:bg-blue-600 text-base font-bold dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <svg aria-hidden="true" role="status"
                                    class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
            </div>
            <div x-show="openTab === 'dashboard'" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard"
                role="tabpanel" aria-labelledby="dashboard-tab">

                @livewire('admin.change-password')
            </div>
        </div>
    </section>


</div>
