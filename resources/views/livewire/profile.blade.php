<div class="border-[1px] rounded-lg border-gray-200 dark:border-gray-600 mb-4 shadow-sm">
    <section class="bg-white dark:bg-gray-900 rounded-lg sm:flex">
        {{-- <div class="py-8 px-4 lg:py-16"> --}}
        <div class="hidden sm:block border-r-2 bg-slate-50">
            @php
                $name = explode(' ', Auth::user()->name);
                $name = implode(' ', array_slice($name, 0, 2));

                // Generate a random color (you can customize this logic)
                $colors = ['bg-red-500', 'bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500'];
                $randomColor = $colors[array_rand($colors)];
                // Get the user's initials
                $initials = strtoupper(substr(Auth::user()->name, 0, 1)); // You can add more logic for full initials
            @endphp
            <div class="flex items-center p-6 pr-16 border-b-2">
                @if (Auth::user()->profile_photo_path)
                    <!-- Show the profile photo -->
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ $name }}"
                        class="rounded-lg h-8 w-8 object-cover">
                @else
                    <div
                        class="{{ $randomColor }} rounded-lg w-[4.5rem] h-[4.5rem] text-white flex justify-center items-center text-3xl mr-5">
                        {{ $initials }}
                    </div>
                @endif
                <h1 class="text-lg font-medium">{{ $name }}</h1>
            </div>
            <div class="space-y-5 p-6">
                <div>
                    <span class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Full Name</span>
                    <p class="text-sm font-medium text-gray-900">{{ $user->title . ' ' . $user->name }}</p>
                    {{-- <p class="text-sm font-medium text-gray-900">
                            {{ $user->title . ' Muhammad Syamil Bin Zainal Abidin' }}</p> --}}
                </div>
                <div>
                    <span class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Email Address</span>
                    <p class="text-sm font-medium text-gray-900">{{ $user->email }}</p>
                </div>
                <div>
                    <span class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Phone Number</span>
                    <p class="text-sm font-medium text-gray-900">{{ $user->phone }}</p>
                </div>
                @if (Auth::user()->role == 'admin')
                    <div>
                        <span class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Role</span>
                        <p class="text-sm font-medium text-gray-900">{{ $user->role }}</p>
                    </div>
                    <div>
                        <span class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Email Status</span>
                        <p class="text-sm font-medium text-gray-900">{{ $user->email_verified_at ?? 'Pending' }}</p>
                    </div>
                @endif
                <div>
                    <span class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Birthday</span>
                    <p class="text-sm font-medium text-gray-900">{{ $user->birthday ?? '-' }}</p>
                </div>
                <div>
                    <span class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Gender</span>
                    <p class="text-sm font-medium text-gray-900">{{ $user->gender ?? '-' }}</p>
                </div>
            </div>
        </div>
        {{-- <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16"> --}}
        <div class="sm:w-3/4 mx-auto p-4 sm:p-10">
            <div class="sm:hidden">
                {{-- <label for="tabs" class="sr-only">Select your country</label> --}}
                <select id="tabs" wire:model.live="tab"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1">General</option>
                    <option value="2">Address</option>
                    <option value="3">Password</option>
                    <option value="4">Social</option>
                    <option value="5">Project</option>
                </select>
            </div>
            <ul
                class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                <li class="w-full focus-within:z-10">
                    <a href="#" wire:click="$set('tab', 1)"
                        class="inline-block w-full p-4 {{ $tab === 1 ? 'text-gray-900 bg-gray-100 active dark:bg-gray-700 dark:text-white' : 'bg-white hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700' }} border-r border-gray-200 dark:border-gray-700 rounded-s-lg focus:ring-4 focus:ring-blue-300 focus:outline-none"
                        aria-current="page">General</a>
                </li>
                <li class="w-full focus-within:z-10">
                    <a href="#" wire:click="$set('tab', 2)"
                        class="inline-block w-full p-4 {{ $tab === 2 ? 'text-gray-900 bg-gray-100 active dark:bg-gray-700 dark:text-white' : 'bg-white hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700' }} border-r border-gray-200 dark:border-gray-700 focus:ring-4 focus:ring-blue-300 focus:outline-none">Address</a>
                </li>
                <li class="w-full focus-within:z-10">
                    <a href="#" wire:click="$set('tab', 3)"
                        class="inline-block w-full p-4 {{ $tab === 3 ? 'text-gray-900 bg-gray-100 active dark:bg-gray-700 dark:text-white' : 'bg-white hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700' }} border-r border-gray-200 dark:border-gray-700 focus:ring-4 focus:ring-blue-300 focus:outline-none">Password</a>
                </li>
                <li class="w-full focus-within:z-10">
                    <a href="#" wire:click="$set('tab', 4)"
                        class="inline-block w-full p-4 {{ $tab === 4 ? 'text-gray-900 bg-gray-100 active dark:bg-gray-700 dark:text-white' : 'bg-white hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700' }} border-r border-gray-200 dark:border-gray-700 focus:ring-4 focus:ring-blue-300 focus:outline-none">Social</a>
                </li>
                <li class="w-full focus-within:z-10">
                    <a href="#" wire:click="$set('tab', 5)"
                        class="inline-block w-full p-4 {{ $tab === 5 ? 'text-gray-900 bg-gray-100 active dark:bg-gray-700 dark:text-white' : 'bg-white hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700' }} border-s-0 border-gray-200 dark:border-gray-700 rounded-e-lg focus:ring-4 focus:ring-blue-300 focus:outline-none">Project</a>
                </li>
            </ul>

            {{-- <ul class="text-sm font-medium text-black sm:flex sm:justify-between my-10">
                <li>
                    <a href="" class="px-4 py-2.5 rounded-lg font-semibold bg-gray-100 border">General</a>
                </li>
                <li>
                    <a href=""
                        class="px-4 py-2.5 rounded-lg hover:shadow hover:text-gray-700 hover:bg-gray-50">Address</a>
                </li>
                <li>
                    <a href=""
                        class="px-4 py-2.5 rounded-lg hover:shadow hover:text-gray-700 hover:bg-gray-50">Password</a>
                </li>
                <li>
                    <a href=""
                        class="px-4 py-2.5 rounded-lg hover:shadow hover:text-gray-700 hover:bg-gray-50">Social</a>
                </li>
                <li>
                    <a href=""
                        class="px-4 py-2.5 rounded-lg hover:shadow hover:text-gray-700 hover:bg-gray-50">Project</a>
                </li>
                <li>
                    <a href=""
                        class="px-4 py-2.5 rounded-lg hover:shadow hover:text-gray-700 hover:bg-gray-50">Project</a>
                </li>
                <li>
                    <a href=""
                        class="px-4 py-2.5 rounded-lg hover:shadow hover:text-gray-700 hover:bg-gray-50">Project</a>
                </li>
            </ul> --}}

            <form action="#" class="mt-4 sm:mt-8">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    @if ($tab === 1)
                        <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">General Information
                        </h2>
                        <div>
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <select id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option @selected($user->title === 'Mr.') value="Mr.">Mr.</option>
                                <option @selected($user->title === 'Ms.') value="Ms.">Ms.</option>
                                <option @selected($user->title === 'Mrs.') value="Mrs.">Mrs.</option>
                                <option @selected($user->title === 'Dr.') value="Dr.">Dr.</option>
                                <option @selected($user->title === 'Miss') value="Miss">Miss</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                                Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your name" value="{{ $user->name }}" required="">
                        </div>
                        <div class="w-full">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                Address</label>
                            <input type="text" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="name@company.com" value="{{ $user->email }}" required="">
                        </div>
                        <div class="w-full">
                            <label for="phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                Number</label>
                            <input type="text" name="phone" id="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Add a phone number" value="{{ $user->phone }}" required="">
                        </div>
                        <div>
                            <label for="role"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                                Role</label>
                            <select id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option @selected($user->role === 'admin') value="admin">Admin</option>
                                <option @selected($user->role === 'user') value="user">User</option>
                            </select>
                        </div>
                        <div>
                            <label for="verification"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                Status</label>
                            <select id="verification"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option @selected(is_null($user->email_verified_at)) value="">Not verified</option>
                                <option @selected(!is_null($user->email_verified_at)) value="{{ now() }}">Verified
                                </option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="birthday"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                            <input type="date" name="birthday" id="birthday"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="{{ $user->birthday }}" required="">
                        </div>
                        <div>
                            <label for="gender"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                            <select id="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option @selected($user->gender === 'male') value="male">Male</option>
                                <option @selected($user->gender === 'female') value="female">Female</option>
                                <option @selected($user->gender === 'other') value="other">Others</option>
                            </select>
                        </div>
                    @elseif ($tab === 2)
                        <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Additional
                            Information</h2>
                        <div class="w-full">
                            <label for="line1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Line
                                1</label>
                            <input type="text" name="line1" id="line1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Line 1" value="{{ optional($user->address)->address_line_1 }}">
                        </div>
                        <div class="w-full">
                            <label for="line2"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Line
                                2</label>
                            <input type="text" name="line2" id="line2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Line 2" value="{{ optional($user->address)->address_line_2 }}">
                        </div>
                        <div class="w-full">
                            <label for="postcode"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postcode</label>
                            <input type="text" name="postcode" id="postcode"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your Postcode" value="{{ optional($user->address)->postcode }}">
                        </div>
                        <div class="w-full">
                            <label for="city"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                            <input type="text" name="city" id="city"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your City" value="{{ optional($user->address)->city }}">
                        </div>
                        <div class="w-full">
                            <label for="state"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
                            <input type="text" name="state" id="state"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your State" value="{{ optional($user->address)->state }}">
                        </div>
                        <div class="w-full">
                            <label for="country"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                            <input type="text" name="country" id="country"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your Country" value="{{ optional($user->address)->country }}">
                        </div>
                    @elseif ($tab === 3)
                        <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Change Password</h2>
                        <div class="w-full">
                            <label for="currentPassword"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current
                                Password</label>
                            <input type="password" name="currentPassword" id="currentPassword"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="•••••••••">
                        </div>
                        <div class="w-full">
                            <label for="newPassword"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                                Password</label>
                            <input type="password" name="newPassword" id="newPassword"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="•••••••••">
                        </div>
                        <div class="w-full">
                            <label for="confirmPassword"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                Password</label>
                            <input type="password" name="confirmPassword" id="confirmPassword"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="•••••••••">
                        </div>
                    @elseif ($tab === 4)
                        <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Social Profiles</h2>
                        <div class="w-full">
                            <label for="facebook"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facebook</label>
                            <input type="text" name="facebook" id="facebook"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="https://www.facebook.com/">
                        </div>
                        <div class="w-full">
                            <label for="instagram"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instagram</label>
                            <input type="text" name="instagram" id="instagram"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="https://www.instagram.com/">
                        </div>
                        <div class="w-full">
                            <label for="twitter"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Twitter</label>
                            <input type="text" name="twitter" id="twitter"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="https://x.com/">
                        </div>
                        <div class="w-full">
                            <label for="telegram"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telegram</label>
                            <input type="text" name="telegram" id="telegram"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="https://telegram.org/">
                        </div>
                    @endif
                </div>
                @if ($tab != 5)
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Update User Information
                    </button>
                @endif
            </form>
            @if ($tab === 5)
                <div class="grid gap-4 sm:grid-cols-3 sm:gap-4">
                    @forelse ($projects as $project)
                        <div class="w-full bg-slate-200 rounded-lg overflow-hidden cursor-pointer">
                            <img src="{{ asset('images/farm-1.jpg') }}" class="">
                            <div class="p-4 space-y-3 text-sm font-medium">
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-900">
                                        {{ $project->name }}
                                    </p>
                                    <span class="text-green-500">• Online</span>
                                </div>
                                <div class="text-gray-900 p-2 bg-slate-50 rounded-lg">
                                    {{ $project->category->name }}
                                </div>
                                <p class="text-gray-900">
                                    {{-- No. 137 Jalan Chabang Empat Meranti, Kampung Chabang Empat, 16210 Tumpat, Kelantan --}}
                                    @php
                                        // Concatenate address parts
                                        $address = trim(
                                            optional($project->address)->address_line_1 .
                                                ' ' .
                                                optional($project->address)->address_line_2 .
                                                ' ' .
                                                optional($project->address)->postcode .
                                                ' ' .
                                                optional($project->address)->city .
                                                ' ' .
                                                optional($project->address)->state,
                                        );

                                        // If the address is empty, set a default message
                                        $displayAddress = !empty($address)
                                            ? Str::limit($address, 50, '...')
                                            : 'No address available';
                                    @endphp

                                    {{ $displayAddress }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div
                            class="sm:col-span-2 h-64 bg-slate-50 border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 mb-4 mt-3 flex flex-col justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-24 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
    <path fill-rule="evenodd"
        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
        clip-rule="evenodd" />
</svg> --}}

                            <p class="my-4">This user has no active projects. Create a new project to get
                                started.
                            </p>
                            {{-- <p>Ready to start your first project? Contact customer support for assistance.</p> --}}
                            {{-- <p>You currently have no projects. Please contact our customer support team to get started.</p> --}}
                            <button type="button" id="create-new-project"
                                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Create new project
                            </button>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </section>
</div>
