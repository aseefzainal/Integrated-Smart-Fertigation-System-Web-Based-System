<div>
    <x-my-layouts.toast></x-my-layouts.toast>
    
    @if ($projects->isEmpty())
        <div
            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4 flex flex-col justify-center items-center mt-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-24 text-slate-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                clip-rule="evenodd" />
                        </svg> --}}

            <p class="my-4">This user has no active projects. Create a new project to get started.</p>
            {{-- <p>Ready to start your first project? Contact customer support for assistance.</p> --}}
            {{-- <p>You currently have no projects. Please contact our customer support team to get started.</p> --}}
            <button type="button" id="create-new-project"
                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Create new project
            </button>
        </div>
    @else
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:justify-between mb-3 mt-5">
            <button type="button" id="create-new-project"
                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Create new project
            </button>
            <div class="flex items-center justify-end space-x-2 w-full md:w-auto">
                <button id="projectListDropdownButton" data-dropdown-toggle="projectListDropdown"
                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                    Project List
                </button>
                <div id="projectListDropdown"
                    class="hidden z-20 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="projectListDropdownButton">
                        @foreach ($projects as $project)
                            <li>
                                {{-- <a href="/device/{{ $project->slug }}" --}}
                                <a wire:click="updateProjectId({{ $project->id }})"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                    {{ $project->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <button id="exportDropdownButton" data-dropdown-toggle="exportDropdown"
                    class="w-full md:w-auto flex items-center justify-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    {{-- <svg class="h-5 w-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24" --}}
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm5.845 17.03a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V12a.75.75 0 0 0-1.5 0v4.19l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3Z"
                            clip-rule="evenodd" />
                        <path
                            d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                    </svg>
                    Export
                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
                <div id="exportDropdown"
                    class="hidden z-20 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass
                                Edit</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="#"
                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                            all</a>
                    </div>
                </div>
                <button id="menuDropdownButton" data-dropdown-toggle="menuDropdown"
                    class="w-full md:w-auto flex items-center justify-center p-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-5 w-5 text-gray-400 mr-2">
                        <path fill-rule="evenodd"
                            d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm5.845 17.03a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V12a.75.75 0 0 0-1.5 0v4.19l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3Z"
                            clip-rule="evenodd" />
                        <path
                            d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                    </svg> --}}

                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>
                </button>
                <div id="menuDropdown"
                    class="hidden z-20 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Update</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="#"
                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                    </div>
                </div>
                {{-- <div class="bg-white p-1.5 rounded-lg border border-gray-200 hover:bg-gray-100 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                      </svg>
                </div> --}}
            </div>
        </div>

        <!-- Crud modal -->
        <div x-data="{ showSensorModal: @entangle('showSensorModal') }" x-show="showSensorModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 right-0 left-0 z-50 h-full flex justify-center items-center bg-gray-500 bg-opacity-75"
            style="display: none;">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto overflow-y-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex items-center mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        {{-- <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Data Sensor
                        </h3> --}}
                        {{-- Tabs --}}
                        {{-- <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700"> --}}
                        <ul class="flex flex-wrap -mb-px text-sm font-medium">
                            <li class="me-2">
                                <button wire:click="$set('tab', 1)"
                                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $tab == 1 ? 'text-blue-600  border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent  hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">Limit
                                    Sensor</button>
                            </li>
                            <li class="me-2">
                                <button wire:click="$set('tab', 2)"
                                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $tab == 2 ? 'text-blue-600  border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent  hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                                    Sensor Notification</button>
                            </li>
                        </ul>
                        {{-- </div> --}}
                        <button type="button" wire:click="closeCrudModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form wire:submit.prevent="save">
                        @csrf
                        @if ($tab == 1)
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                @foreach ($limitSensors as $limitSensor)
                                    <div class="sm:col-span-2">
                                        <label for="limitSensor_{{ $limitSensor->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $limitSensor->sensor->name }}
                                            (Limit)
                                            for fertilizer irrigation</label>
                                        <div class="flex items-center">
                                            <input type="number" name="limitSensor_{{ $limitSensor->id }}"
                                                wire:model.live="limitSensorValues.{{ $limitSensor->id }}"
                                                id="limitSensor_{{ $limitSensor->id }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-s-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="0">
                                            <span
                                                class="py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-50 border border-s-0 border-gray-300 rounded-e-lg">{{ $limitSensor->sensor->unit }}</span>
                                        </div>
                                        @error('limitSensorValues.' . $limitSensor->id)
                                            <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                        <p id="helper-text-explanation"
                                            class="mt-2 text-sm text-gray-500 dark:text-gray-400">Note: The value
                                            entered here will determine the AB solution mixture in the tank.</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label for="countdown"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Countdown Notification
                                    </label>
                                    <div class="flex">
                                        {{-- <select id="timeCategory" wire:model.live="timeCategory"
                                            class="bg-gray-50 border border-r-0 border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="minutes">Minutes</option>
                                            <option value="seconds">Seconds</option>
                                        </select> --}}
                                        <span
                                                class="py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg">Minutes</span>
                                        <input type="number" wire:model.live="countdown" id="countdown"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Countdown" />
                                    </div>
                                    @error('countdown')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                    @enderror
                                    <p id="helper-text-explanation"
                                        class="mt-2 text-sm text-gray-500 dark:text-gray-400">Note: The countdown sets
                                        the timing for your first and subsequent notifications to prevent spam.</p>
                                </div>
                                @foreach ($sensorNotifications as $sensorNotification)
                                    <div>
                                        <label for="sensorNotification_{{ $sensorNotification->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $sensorNotification->sensor->name }}</label>
                                        <input type="number" name="sensorNotification_{{ $sensorNotification->id }}"
                                            id="sensorNotification_{{ $sensorNotification->id }}"
                                            wire:model.live="sensorNotificationValues.{{ $sensorNotification->id }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @error('sensorNotificationValues.' . $sensorNotification->id)
                                                <span class="text-red-600 text-xs">{{ $message }}</span>
                                            @enderror
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex items-center">
                            <button wire:loading.remove type="submit"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Save Change
                            </button>
                            <button wire:loading disabled type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
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
                            {{-- <button type="button" wire:click="closeCrudModal"
                                class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Cancel
                            </button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- <div class="grid grid-cols-2 gap-3 mb-4"> --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
            {{-- Inputs --}}
            @livewire('input-filter', ['project_id' => $project_id])
            {{-- Sensors --}}
            <div
                class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 md:h-96 shadow-lg bg-white overflow-y-auto overscroll-none no-scrollbar flex flex-col">
                <div class="flex items-center justify-between py-2 px-3 text-sm sticky top-0 bg-white z-10 shadow-sm">
                    <h3 class="text-base">Data Sensor</h3>
                    @if (!$sensorNotifications->isEmpty() || !$limitSensors->isEmpty())
                        {{-- <span class="text-blue-600 cursor-pointer hover:underline"
                            wire:click="$set('showSensorModal', true)">Setting</span> --}}
                        <div wire:click="$set('showSensorModal', true)"
                            class="p-2 cursor-pointer rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5 text-gray-400">
                                <path fill-rule="evenodd"
                                    d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    @endif
                </div>
                @if (!$sensors->isEmpty())
                    {{-- <div wire:poll class="grid sm:grid-cols-2 gap-3 px-3 pt-2 pb-3"> --}}
                    <div class="grid sm:grid-cols-2 gap-3 px-3 pt-2 pb-3">
                        @foreach ($sensors as $sensor)
                            <div class="flex items-center shadow-[0_0_5px_2px_rgb(0_0_0/0.1)] rounded-lg p-3">
                                <i class="fi fi-sr-bag-seedling text-[1.7rem] pt-2"></i>
                                <div class="ml-3 pl-3 border-s-[1px]">
                                    <h3>{{ $sensor->name }}</h3>
                                    <div class="text-green-600 mt-2">
                                        <h3 class="text-2xl">{{ $sensor->value }}<span
                                                class="text-sm">{{ $sensor->unit }}</span></h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex items-center shadow-[0_0_5px_2px_rgb(0_0_0/0.1)] rounded-lg p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-8">
                                <path
                                    d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                                <path fill-rule="evenodd"
                                    d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3 pl-3 border-s-[1px]">
                                <h3>EC Meter Sensor</h3>
                                <div class="text-green-600 mt-2">
                                    <h3 class="text-2xl">87<span class="text-sm">%</span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center shadow-[0_0_5px_2px_rgb(0_0_0/0.1)] rounded-lg p-3">
                            <i class="fi fi-ss-raindrops text-2xl pt-2"></i>
                            <div class="ml-3 pl-3 border-s-[1px]">
                                <h3>EC Meter Sensor</h3>
                                <div class="text-green-600 mt-2">
                                    <h3 class="text-2xl">87<span class="text-sm">%</span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center shadow-[0_0_5px_2px_rgb(0_0_0/0.1)] rounded-lg p-3">
                            <i class="fi fi-ss-raindrops text-2xl pt-2"></i>
                            <div class="ml-3 pl-3 border-s-[1px]">
                                <h3>EC Meter Sensor</h3>
                                <div class="text-green-600 mt-2">
                                    <h3 class="text-2xl">87<span class="text-sm">%</span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center shadow-[0_0_5px_2px_rgb(0_0_0/0.1)] rounded-lg p-3">
                            <i class="fi fi-ss-raindrops text-2xl pt-2"></i>
                            <div class="ml-3 pl-3 border-s-[1px]">
                                <h3>EC Meter Sensor</h3>
                                <div class="text-green-600 mt-2">
                                    <h3 class="text-2xl">87<span class="text-sm">%</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-span-2 h-full flex flex-col justify-center items-center bg-slate-100">
                        <p>No data sensors are currently connected to this project.</p>
                        <p class="mt-2">Please contact an administrator to add sensors.</p>
                    </div>
                @endif
            </div>
            {{-- Chart --}}
            {{-- @livewire('chart-filter', ['project_id' => $project_id]) --}}
            @livewire('chart-filter', ['project_id' => $project_id])
            {{-- Schedule --}}
            @livewire('schedule-filter', ['project_id' => $project_id])
        </div>
    @endif
</div>
