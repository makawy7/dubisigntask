@push('styles')
    <link rel="stylesheet" href="/css/flatpickr.min.css">
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
@endpush
<div x-data="{ userType: 'standard' }" class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    <form wire:submit.prevent="createUser" action="#" method="POST" enctype="multipart/form-data">
        <div>
            <a href="/" class="text-blue-600">Back Home</a>
            <h3 class="text-lg  font-medium text-gray-900 mt-2">
                Create New User
            </h3>
            @if ($successMessage)
                <div class="rounded-md bg-green-50 p-4 mt-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm leading-5 font-medium text-green-800">
                                {{ $successMessage }}
                            </p>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button type="button"
                                    class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 transition ease-in-out duration-150"
                                    aria-label="Dismiss">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="mt-6 sm:mt-5">
            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                <label for="username" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                    Usename
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                        <input wire:model.lazy="username" id="username"
                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            value="{{ $username }}">
                        @error('username')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                <label for="email" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                    Email
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                        <input wire:model.lazy="email" id="email"
                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            value="{{ $email }}">
                        @error('email')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                <label for="bio" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                    Bio
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex rounded-md shadow-sm">
                        <textarea wire:model.lazy="bio" id="bio" rows="5"
                            class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">{{ $bio }}</textarea>
                    </div>
                    @error('bio')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                <label for="user_type" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                    User Type
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg rounded-md shadow-sm sm:max-w-s">
                        <select x-model="userType" wire:model.defer="user_type" id="user_type"
                            class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value="standard" {{ $user_type === 'standard' ? 'selected' : '' }}>Standard</option>
                            <option value="locationed" {{ $user_type === 'locationed' ? 'selected' : '' }}>Locationed
                            </option>
                            <option value="certified" {{ $user_type === 'certified' ? 'selected' : '' }}>Certified
                            </option>
                        </select>
                        @error('user_type')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div x-show="userType === 'certified'">
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                    <label for="cert_name" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                        Certification Name
                    </label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                            <input wire:model.lazy="cert_name" id="cert_name"
                                class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                value="{{ $cert_name }}">
                            @error('cert_name')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-6  sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                    <label for="photo" class="block text-sm leading-5 font-medium text-gray-700 sm:mt-px sm:pt-2">
                        Certification File
                    </label>
                    <div class="mt-2 sm:mt-0 sm:col-span-2" x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <input wire:model="file" type="file">
                        @error('file')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Progress Bar -->
                        <div class="mt-4" x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>

                        @if ($fileTmpUrl)
                            <img src="{{ $fileTmpUrl }}" alt="cover image">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div x-show="userType === 'locationed'">
            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                <label for="map_location" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                    Map Location
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg rounded-md shadow-sm sm:max-w-md h-72 relative">
                        <div wire:ignore id="map" class="w-full h-full absolute top-0 left-0"></div>
                    </div>
                    @error('map_location')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div
                class="sm:grid
                        sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                <label for="datepicker" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                    Birth Date
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                        <input wire:model.lazy="date_of_birth" type="text" id="datepicker"
                            placeholder="Select a date">
                    </div>
                    @error('date_of_birth')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-200 pt-5">
            <div class="flex justify-end">
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button wire:loading.attr="disabled" wire:target="file" type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
                        <svg wire:loading wire:target="createUser" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Create
                    </button>
                </span>
            </div>
        </div>


    </form>
</div>


@push('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxq2b1q-gksbcZzb0Fha354XiSmDUm8pI&callback=initMap"></script>
    <script src="/js/flatpickr.js"></script>
    <script>
        flatpickr("#datepicker");

        function initMap() {
            let map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {
                    lat: {{ $defaultLat }},
                    lng: {{ $defaultLng }}
                },
                gestureHandling: 'greedy'
            });

            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: {
                    lat: {{ $defaultLat }},
                    lng: {{ $defaultLng }}
                },

            });
            marker.addListener('dragend', function() {
                let position = marker.getPosition();
                let lat = position.lat();
                let lng = position.lng();
                Livewire.emit('mapLocationChanged', lat, lng);
            });
            marker.addListener('click', toggleBounce);
        }

        function toggleBounce() {
            if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
    </script>
@endpush
