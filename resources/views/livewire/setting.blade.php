{{-- <div> --}}
{{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 h-32 md:h-64"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
    </div> --}}
<div
    class="border-[1px] rounded-lg border-gray-200 dark:border-gray-600 mb-4 bg-white overflow-hidden px-5 sm:px-10 py-8 shadow-sm">
    <h2 class="font-semibold mb-2 text-2xl">Settings</h2>
    <p class="text-sm">Manage your details and personal preferences here.</p>

    <div class="sm:hidden my-4">
        <select id="tab" wire:model.live="tab"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="1">General</option>
            <option value="2">Security</option>
            <option value="3">Billing</option>
            <option value="4">Notifications</option>
        </select>
    </div>

    <ul class="hidden sm:flex text-sm font-medium text-black space-x-6 my-8">
        <li>
            <a href="#" wire:click="$set('tab', 1)"
                class="px-4 py-2.5 rounded-lg {{ $tab === 1 ? 'font-semibold bg-gray-100' : 'hover:shadow hover:text-gray-700 hover:bg-gray-50' }}">General</a>
        </li>
        <li>
            <a href="#" wire:click="$set('tab', 2)"
                class="px-4 py-2.5 rounded-lg {{ $tab === 2 ? 'font-semibold bg-gray-100' : 'hover:shadow hover:text-gray-700 hover:bg-gray-50' }}">Security</a>
        </li>
        <li>
            <a href="#" wire:click="$set('tab', 3)"
                class="px-4 py-2.5 rounded-lg {{ $tab === 3 ? 'font-semibold bg-gray-100' : 'hover:shadow hover:text-gray-700 hover:bg-gray-50' }}">Billing</a>
        </li>
        <li>
            <a href="#" wire:click="$set('tab', 4)"
                class="px-4 py-2.5 rounded-lg {{ $tab === 4 ? 'font-semibold bg-gray-100' : 'hover:shadow hover:text-gray-700 hover:bg-gray-50' }}">Notifications</a>
        </li>
    </ul>

    <x-my-layouts.toast></x-my-layouts.toast>

    <section>
        @if ($tab === 1)
            <h3 class="font-bold mb-3 text-lg">Basics</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 py-6 border-t-2">
                <h3 class="font-medium col-span-2 sm:col-span-1 mb-1 sm:mb-0">Photo</h3>
                @php
                    $name = explode(' ', Auth::user()->name);
                    $name = implode(' ', array_slice($name, 0, 2));

                    // Generate a random color (you can customize this logic)
                    $colors = ['bg-red-500', 'bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500'];
                    $randomColor = $colors[array_rand($colors)];
                    // Get the user's initials
                    $initials = strtoupper(substr(Auth::user()->name, 0, 1)); // You can add more logic for full initials
                @endphp
                @if (Auth::user()->profile_photo_path)
                    <!-- Show the profile photo -->
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ $name }}"
                        class="rounded-lg h-8 w-8 object-cover">
                @else
                    <div
                        class="{{ $randomColor }} rounded-full w-10 h-10 sm:w-14 sm:h-14 text-white flex justify-center items-center text-xl sm:text-2xl">
                        {{ $initials }}
                    </div>
                @endif
                <div class="flex justify-end items-center">
                    <button
                        class="border-2 sm:border-[3px] hover:border-slate-600 hover:bg-slate-100 py-1 px-2 rounded-lg text-sm">Edit</button>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 py-6 items-center border-t-2">
                <h3 class="font-medium col-span-2 sm:col-span-1">Full Name</h3>
                <p class="text-sm sm:text-base">{{ $user->title . ' ' . $user->name }}</p>
                <div class="flex justify-end items-start">
                    <button
                        class="border-2 sm:border-[3px] hover:border-slate-600 hover:bg-slate-100 py-1 px-2 rounded-lg text-sm">Edit</button>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 py-6 items-center border-t-2">
                <h3 class="font-medium col-span-2 sm:col-span-1">Email Address</h3>
                <p class="text-sm sm:text-base">{{ $user->email }}</p>
                <div class="flex justify-end items-start">
                    <button
                        class="border-2 sm:border-[3px] hover:border-slate-600 hover:bg-slate-100 py-1 px-2 rounded-lg text-sm">Edit</button>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 py-6 items-center border-t-2">
                <h3 class="font-medium col-span-2 sm:col-span-1">Phone Number</h3>
                <p class="text-sm sm:text-base">{{ $user->phone }}</p>
                <div class="flex justify-end items-start">
                    <button
                        class="border-2 sm:border-[3px] hover:border-slate-600 hover:bg-slate-100 py-1 px-2 rounded-lg text-sm">Edit</button>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 py-6 items-center border-t-2">
                <h3 class="font-medium col-span-2 sm:col-span-1">Email Status</h3>
                <span
                    class="{{ $user->email_verified_at ? 'text-green-700' : 'text-yellow-700' }} font-medium text-sm sm:text-base">{{ $user->email_verified_at ? 'Verified' : 'Pending' }}</span>
                <div class="flex justify-end items-start">
                    <button
                        class="border-2 sm:border-[3px] hover:border-slate-600 hover:bg-slate-100 py-1 px-2 rounded-lg text-sm">Verify</button>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 py-6 border-t-2">
                <h3 class="font-medium mb-5 sm:mb-0">Social Media</h3>
                <div class="sm:col-span-2">
                    <div class="pb-3 border-b-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="border-[3px] border-black pl-2 pr-1 py-1.5 rounded-full">
                                <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 font-medium">Facebook</span>
                        </div>
                        <div class="flex justify-end items-start">
                            <button
                                class="border-2 sm:border-[3px] hover:border-slate-600 hover:bg-slate-100 py-1 px-2 rounded-lg text-sm">Manage
                                Link</button>
                        </div>
                    </div>
                    <div class="py-3 border-b-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="border-[3px] border-black p-2 rounded-full">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 font-medium">Instagram</span>
                        </div>
                        <div class="flex justify-end items-start">
                            <button
                                class="border-2 sm:border-[3px] hover:border-slate-600 hover:bg-slate-100 py-1 px-2 rounded-lg text-sm">Manage
                                Link</button>
                        </div>
                    </div>
                    <div class="py-3 border-b-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="border-[3px] border-black pl-2.5 pr-1.5 py-2 rounded-full">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z" />
                                </svg>
                            </div>
                            <span class="ml-3 font-medium">Twitter</span>
                        </div>
                        <div class="flex justify-end items-start">
                            <button
                                class="border-2 sm:border-[3px] hover:border-slate-600 hover:bg-slate-100 py-1 px-2 rounded-lg text-sm">Manage
                                Link</button>
                        </div>
                    </div>
                    <div class="py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="border-[3px] border-black p-2 rounded-full">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z"
                                        clip-rule="evenodd" />
                                    {{-- </path> --}}
                                </svg>
                            </div>
                            <span class="ml-3 font-medium">Telegram</span>
                        </div>
                        <div class="flex justify-end items-start">
                            <button
                                class="border-2 sm:border-[3px] hover:border-slate-600 hover:bg-slate-100 py-1 px-2 rounded-lg text-sm">Manage
                                Link</button>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($tab === 2)
            <div
                class="col-span-3 h-40 sm:h-64 flex items-center justify-center bg-slate-50 border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600">
                Coming Soon
            </div>
        @elseif ($tab === 3)
            <div
                class="col-span-3 h-40 sm:h-64 flex items-center justify-center bg-slate-50 border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600">
                Coming Soon
            </div>
        @else
            <h3 class="font-bold mb-3 text-lg">Sensor Notification</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 py-6 border-t-2">
                <h3 class="font-medium mb-5 sm:mb-0">Free Notifications</h3>
                <div class="sm:col-span-2">
                    @php
                        $isFirstFreeNotification = true;
                    @endphp
                    @foreach ($sensorNotifications as $index => $sensorNotification)
                        @if ($sensorNotification['category'] === 'free')
                            <div
                                class="{{ $isFirstFreeNotification ? 'pb-3 border-b-2' : 'pt-3' }} flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="border-[3px] border-black p-2 rounded-full">
                                        @if ($sensorNotification['name'] === 'Telegram')
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                viewBox="0 0 24 24"
                                                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                <path
                                                    d="m18.73 5.41-1.28 1L12 10.46 6.55 6.37l-1.28-1A2 2 0 0 0 2 7.05v11.59A1.36 1.36 0 0 0 3.36 20h3.19v-7.72L12 16.37l5.45-4.09V20h3.19A1.36 1.36 0 0 0 22 18.64V7.05a2 2 0 0 0-3.27-1.64z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="ml-3 font-medium">{{ $sensorNotification['name'] }}</span>
                                </div>
                                <div class="flex justify-end items-start">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer"
                                            wire:model="sensorNotifications.{{ $index }}.status"
                                            wire:click="updateStatus({{ $index }})"
                                            {{ $sensorNotification['status'] ? 'checked' : '' }}>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </div>
                            </div>
                            {{-- <div class="pt-3 flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="border-[3px] border-black p-2 rounded-full">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span class="ml-3 font-medium">Telegram</span>
                                </div>
                                <div class="flex justify-end items-start">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </div>
                            </div> --}}
                            @php
                                $isFirstFreeNotification = false;
                            @endphp
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 py-6 border-t-2">
                <h3 class="font-medium mb-5 sm:mb-0">Pay Notifications</h3>
                <div class="sm:col-span-2">
                    @php
                        $isFirstFreeNotification = true;
                    @endphp
                    @foreach ($sensorNotifications as $index => $sensorNotification)
                        @if ($sensorNotification['category'] === 'pay')
                            <div
                                class="{{ $isFirstFreeNotification ? 'pb-3 border-b-2' : 'pt-3' }} flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="border-[3px] border-black p-2 rounded-full">
                                        @if ($sensorNotification['name'] === 'SMS')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                viewBox="0 0 24 24"
                                                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                <path
                                                    d="M12 3c-4.92 0-8.91 3.729-8.91 8.332 0 2.616 1.291 4.952 3.311 6.479V21l3.041-1.687c.811.228 1.668.35 2.559.35 4.92 0 8.91-3.73 8.91-8.331C20.91 6.729 16.92 3 12 3zm.938 11.172-2.305-2.394-4.438 2.454 4.865-5.163 2.305 2.395 4.439-2.455-4.866 5.163z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                viewBox="0 0 24 24"
                                                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="ml-3 font-medium sm:flex sm:items-center">{{ $sensorNotification['name'] }}
                                        <p class="sm:ml-1 font-normal text-sm text-green-500">
                                            ({{ $sensorNotification['price'] }})
                                        </p>
                                    </span>
                                </div>
                                <div class="flex justify-end items-start">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer"
                                            wire:model="sensorNotifications.{{ $index }}.status"
                                            wire:click="updateStatus({{ $index }})"
                                            {{ $sensorNotification['status'] ? 'checked' : '' }}>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </div>
                            </div>
                            {{-- <div class="pt-3 flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="border-[3px] border-black p-2 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"
                                            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                            <path
                                                d="M12 3c-4.92 0-8.91 3.729-8.91 8.332 0 2.616 1.291 4.952 3.311 6.479V21l3.041-1.687c.811.228 1.668.35 2.559.35 4.92 0 8.91-3.73 8.91-8.331C20.91 6.729 16.92 3 12 3zm.938 11.172-2.305-2.394-4.438 2.454 4.865-5.163 2.305 2.395 4.439-2.455-4.866 5.163z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="ml-3 font-medium flex items-center">SMS<p
                                            class="ml-1 font-normal text-sm text-green-500">(RM0.20/sms)</p></span>
                                </div>
                                <div class="flex justify-end items-start">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </div>
                            </div> --}}
                            @php
                                $isFirstFreeNotification = false;
                            @endphp
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</div>
{{-- <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
    </div>
    <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
    <div class="grid grid-cols-2 gap-4">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
    </div> --}}
{{-- </div> --}}
