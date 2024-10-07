<div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 mb-4 shadow-lg">
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
            <form action="#">
                @csrf
                {{-- @if ($step === 1) --}}
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 {{ $step != 1 ? 'hidden' : ''  }}">
                        <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">General
                            Information</h2>
                        <div>
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <select id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="Mr.">Mr.</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Miss">Miss</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                                Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your name" value="" required="">
                        </div>
                        <div class="w-full">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                Address</label>
                            <input type="text" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="name@company.com" value="" required="">
                        </div>
                        <div class="w-full">
                            <label for="phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                Number</label>
                            <input type="text" name="phone" id="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Add a phone number" value="" required="">
                        </div>
                        <div>
                            <label for="role"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                                Role</label>
                            <select id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div>
                            <label for="verification"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                Status</label>
                            <select id="verification"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Not verified</option>
                                <option value="{{ now() }}">Verified
                                </option>
                            </select>
                        </div>
                    </div>
                {{-- @elseif ($step === 2) --}}
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 {{ $step != 2 ? 'hidden' : ''  }}">
                        <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Project
                            Information</h2>
                        <div class="sm:col-span-2">
                            <label for="project_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project
                                Name</label>
                            <input type="text" name="project_name" id="project_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Project Name" value="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="Smart Fertigation System">Smart Fertigation System</option>
                                <option value="Perternakan Lembu">Perternakan Lembu</option>
                            </select>
                        </div>
                        <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Location
                            (Optional)</h2>
                        <div class="w-full">
                            <label for="line1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Line
                                1</label>
                            <input type="text" name="line1" id="line1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Line 1" value="">
                        </div>
                        <div class="w-full">
                            <label for="line2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Line
                                2</label>
                            <input type="text" name="line2" id="line2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Line 2" value="">
                        </div>
                        <div class="w-full">
                            <label for="postcode"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postcode</label>
                            <input type="text" name="postcode" id="postcode"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your Postcode" value="">
                        </div>
                        <div class="w-full">
                            <label for="city"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                            <input type="text" name="city" id="city"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your City" value="">
                        </div>
                        <div class="w-full">
                            <label for="state"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
                            <input type="text" name="state" id="state"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your State" value="">
                        </div>
                        <div class="w-full">
                            <label for="country"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                            <input type="text" name="country" id="country"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your Country" value="">
                        </div>
                    </div>
                {{-- @elseif ($step === 3) --}}
                    <div {{ $step != 3 ? 'hidden' : ''  }}>
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Input List</h2>
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-2">
                            @foreach ($inputs as $input)
                                <div
                                    class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50">
                                    <input id="bordered-checkbox-{{ $input->slug }}" type="checkbox" value=""
                                        name="bordered-checkbox"
                                        class="peer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-checkbox-{{ $input->slug }}"
                                        class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">{{ $input->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <h2 class="my-4 text-xl font-bold text-gray-900 dark:text-white">Sensor List</h2>
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-2">
                            @foreach ($sensors as $sensor)
                                <div
                                    class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 cursor-pointer hover:bg-gray-50">
                                    <input id="bordered-checkbox-{{ $sensor->slug }}" type="checkbox" value=""
                                        name="bordered-checkbox"
                                        class="peer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-checkbox-{{ $sensor->slug }}"
                                        class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">{{ $sensor->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                {{-- @elseif ($step === 4) --}}
                    <div {{ $step != 4 ? 'hidden' : ''  }}>
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Preview</h2>
                    </div>
                {{-- @endif --}}
                <div class="flex items-center justify-end space-x-2">
                    @if ($step > 1)
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
                    @else
                        <a href="/"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                            Cancel
                        </a>
                    @endif
                    @if ($step === 4)
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Create new user
                        </button>
                    @else
                        <a wire:click="incrementStep"
                            class="cursor-pointer inline-flex items-center px-5 py-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Continue
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
