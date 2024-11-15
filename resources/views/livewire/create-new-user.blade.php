<div class="border-[1px] rounded-lg border-gray-200 dark:border-gray-600 mb-4 shadow-md">
    {{-- <div class="py-8 mx-auto max-w-2xl flex justify-between items-center">
        <div class="cursor-pointer">User</div>
        <div class="border-t-2 border-dashed border-gray-200 w-20 mx-3"></div>
        <div class="cursor-pointer">Project</div>
        <div class="border-t-2 border-dashed border-gray-200 w-20 mx-3"></div>
        <div class="cursor-pointer">Input & Sensor</div>
        <div class="border-t-2 border-dashed border-gray-200 w-20 mx-3"></div>
        <div class="cursor-pointer">Preview</div>
    </div> --}}
    <section class="bg-white dark:bg-gray-900 rounded-lg">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <div
                class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mb-6">
                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a href="#" wire:click.prevent="$set('tab', 1)"
                            class="inline-block p-4 {{ $tab == 1 ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }} border-b-2 rounded-t-lg"
                            aria-current="page">User</a>
                    </li>
                    <li class="me-2">
                        <a href="#" wire:click.prevent="$set('tab', 2)"
                            class="inline-block p-4 {{ $tab == 2 ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }} border-b-2 rounded-t-lg"
                            aria-current="page">Project</a>
                    </li>
                    <li class="me-2">
                        <a href="#"
                            @if (!empty($project_name)) wire:click.prevent="$set('tab', 3)"
                               class="inline-block p-4 {{ $tab == 3 ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }} border-b-2 rounded-t-lg"
                           @else
                               class="inline-block p-4 text-gray-400 cursor-not-allowed rounded-t-lg dark:text-gray-500" @endif>
                            Input & Sensor
                        </a>
                    </li>
                </ul>
            </div>
            <form wire:submit.prevent="submit">
                @csrf
                {{-- User Information --}}
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 {{ $tab != 1 ? 'hidden' : '' }}">
                    <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">General
                        Information</h2>
                    <div>
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <select wire:model.live="title" id="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select Title</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Miss">Miss</option>
                        </select>
                        @error('title')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                            Name</label>
                        <input type="text" wire:model.live="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your name" required="">
                        @error('name')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                            Address</label>
                        <input type="text" wire:model.live="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="name@company.com" required="">
                        @error('email')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                            Number</label>
                        <input type="text" wire:model.live="phone" id="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Add a phone number" required="">
                        @error('phone')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                            Role</label>
                        <select wire:model.live="role" id="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        @error('role')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="verification"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                            Status</label>
                        <select wire:model.live="verification" id="verification"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Not verified</option>
                            <option value="{{ now() }}">Verified
                            </option>
                        </select>
                        @error('verification')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Project Information --}}
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 {{ $tab != 2 ? 'hidden' : '' }}">
                    <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Project
                        Information (Optional)</h2>
                    <div class="sm:col-span-2">
                        <label for="project_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project
                            Name</label>
                        <input type="text" wire:model.live="project_name" id="project_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Project Name">
                        @error('project_name')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select wire:model.live="category" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select Category</option>
                            @foreach ($projectCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            {{-- <option value="Perternakan Lembu">Perternakan Lembu</option> --}}
                        </select>
                        @error('category')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Location
                        (Optional)</h2>
                    <div class="w-full">
                        <label for="line1"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Line
                            1</label>
                        <input type="text" wire:model.live="line1" id="line1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Line 1">
                        @error('line1')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="line2"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Line
                            2</label>
                        <input type="text" wire:model.live="line2" id="line2"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Line 2">
                        @error('line2')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="postcode"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postcode</label>
                        <input type="number" wire:model.live="postcode" id="postcode"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your Postcode">
                        @error('postcode')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="city"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                        <input type="text" wire:model.live="city" id="city"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your City">
                        @error('city')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="state"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
                        <input type="text" wire:model.live="state" id="state"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your State">
                        @error('state')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="country"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                        <input type="text" wire:model.live="country" id="country"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your Country">
                        @error('country')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Input & Sensor --}}
                <div {{ $tab != 3 ? 'hidden' : '' }}>
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Select Input</h2>
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-2">
                        @foreach ($inputs as $input)
                            <div
                                class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50">
                                <input id="bordered-checkbox-{{ $input->slug }}" type="checkbox"
                                    value="{{ $input->id }}" wire:model.live="selectedInputs"
                                    class="peer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="bordered-checkbox-{{ $input->slug }}"
                                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">{{ $input->name }}</label>
                            </div>
                            @error('selectedInputs')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        @endforeach
                    </div>
                    <h2 class="my-4 text-xl font-bold text-gray-900 dark:text-white">Select Sensor</h2>
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-2">
                        @foreach ($sensors as $sensor)
                            <div
                                class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50">
                                <input id="bordered-checkbox-{{ $sensor->slug }}" type="checkbox"
                                    value="{{ $sensor->id }}" wire:model.live="selectedSensors"
                                    class="peer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="bordered-checkbox-{{ $sensor->slug }}"
                                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">{{ $sensor->name }}</label>
                            </div>
                            @error('selectedSensors')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        @endforeach
                    </div>
                </div>
                {{-- Preview --}}
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 {{ $tab != 4 ? 'hidden' : '' }}">
                    <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">User Information</h2>
                    <div class="w-full">
                        <span class="block mb-1 text-sm font-medium text-gray-500 dark:text-white">Full Name </span>
                        <p class="text-sm text-gray-900">{{ $title . ' ' . $name }}</p>
                    </div>
                    <div class="w-full">
                        <span class="block mb-1 text-sm font-medium text-gray-500 dark:text-white">Email Address
                        </span>
                        <p class="text-sm text-gray-900">{{ $email }}</p>
                    </div>
                    <div class="w-full">
                        <span class="block mb-1 text-sm font-medium text-gray-500 dark:text-white">Phone Number </span>
                        <p class="text-sm text-gray-900">{{ $phone }}</p>
                    </div>
                    <div class="w-full">
                        <span class="block mb-1 text-sm font-medium text-gray-500 dark:text-white">User Role </span>
                        <p class="text-sm text-gray-900">{{ $role }}</p>
                    </div>
                    <div class="w-full">
                        <span class="block mb-1 text-sm font-medium text-gray-500 dark:text-white">Email Status </span>
                        <p class="text-sm text-gray-900">{{ $verification ?? 'Not Verified' }}</p>
                    </div>
                    <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Project Information</h2>
                    @if (!empty($project_name))
                        <div class="w-full">
                            <span class="block mb-1 text-sm font-medium text-gray-500 dark:text-white">Project Name
                            </span>
                            <p class="text-sm text-gray-900">{{ $project_name }}</p>
                        </div>
                        <div class="w-full">
                            <span class="block mb-1 text-sm font-medium text-gray-500 dark:text-white">Category </span>
                            <p class="text-sm text-gray-900">{{ $category->name }}</p>
                        </div>
                        <div class="w-full">
                            <span class="block mb-1 text-sm font-medium text-gray-500 dark:text-white">Address </span>
                            <p class="text-sm text-gray-900">
                                {{ $address ?? '' }}
                            </p>
                        </div>
                    @else
                        <p class="text-sm text-gray-900">No project configuration</p>
                    @endif
                    <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Input Selected</h2>
                    <div class="sm:col-span-2 grid gap-4 sm:grid-cols-4 sm:gap-2">
                        {{-- <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-green-100 border border-green-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-green-100 border border-green-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd> --}}
                        @forelse ($previewInputs as $previewInput)
                            <kbd
                                class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">{{ $previewInput->name }}</kbd>
                        @empty
                            <p class="text-sm text-gray-900">No Input Selected</p>
                        @endforelse
                    </div>

                    {{-- <div class="flex flex-wrap">
                        <div
                            class="w-full border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50 p-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Water Irrigation</span>
                        </div>
                        <div
                            class="w-full border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50 p-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Water Irrigation</span>
                        </div>
                        <div
                            class="w-full border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50 p-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Water Irrigation</span>
                        </div>
                        <div
                            class="w-full border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50 p-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Water Irrigation</span>
                        </div>
                        <div
                            class="w-full border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50 p-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Water Irrigation</span>
                        </div>
                        <div
                            class="w-full border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50 p-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Water Irrigation</span>
                        </div>

                    </div> --}}
                    <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Sensor Selected</h2>
                    <div class="sm:col-span-2 grid gap-4 sm:grid-cols-4 sm:gap-2">
                        {{-- <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-green-100 border border-green-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-green-100 border border-green-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd>
                        <kbd
                            class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-purple-100 border border-purple-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                            Irrigation</kbd> --}}
                        @forelse ($previewSensors as $previewSensor)
                            <kbd
                                class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-green-100 border border-green-800 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Water
                                Irrigation</kbd>
                        @empty
                            <p class="text-sm text-gray-900">No Sensor Selected</p>
                        @endforelse
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-2">
                    {{-- @if ($tab > 1)
                        <a wire:click="decrementStep"
                            class="cursor-pointer inline-flex items-center px-5 py-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            <svg class="w-6 h-6 mr-2 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                            Previous
                        </a>
                    @else --}}

                    {{-- @endif --}}
                    @if ($tab === 4)
                        <a wire:click.prevent="$set('tab', 1)"
                            class="cursor-pointer inline-flex items-center px-5 py-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            <svg class="w-6 h-6 mr-2 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                            Previous
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Create new user
                        </button>
                    @else
                        <a href="/" wire:navigate
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                            Cancel
                        </a>
                        {{-- <a href="#" wire:click.prevent="$set('tab', 4)" --}}
                        <a href="#" wire:click.prevent="saveAndPreview"
                            class="cursor-pointer inline-flex items-center px-5 py-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Save & Preview
                            <svg class="w-6 h-6 ml-2 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </a>
                    @endif

                </div>
            </form>
        </div>
    </section>
</div>
