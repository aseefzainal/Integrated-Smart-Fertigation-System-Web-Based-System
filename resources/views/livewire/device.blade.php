<div>
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
            <button type="button"
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
        <div class="flex justify-between mb-3 mt-5">
            <button type="button"
                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Create new project
            </button>
            <div class="flex items-center justify-end space-x-3 w-full md:w-auto">
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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-5 w-5 text-gray-400 mr-2">
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
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 mb-4">
            {{-- Inputs --}}
            {{-- @dump($project_id) --}}
            @livewire('input-filter', ['project_id' => $project_id])
            {{-- Sensors --}}
            <div
                class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-[22rem] shadow-lg bg-white overflow-y-auto overscroll-none no-scrollbar flex flex-col">
                <div class="flex justify-between py-2 px-3 text-sm sticky top-0 bg-white z-10 shadow-sm">
                    <h3>Data Sensor</h3>
                    <span class="text-blue-600 cursor-pointer hover:underline">Setting</span>
                </div>
                @if (!$sensors->isEmpty())
                    <div class="grid grid-cols-2 gap-3 px-3 pt-2 pb-3">
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
            @livewire('chart-filter', ['project_id' => $project_id])
            {{-- Schedule --}}
            @livewire('schedule-filter', ['project_id' => $project_id])
        </div>
    @endif
</div>