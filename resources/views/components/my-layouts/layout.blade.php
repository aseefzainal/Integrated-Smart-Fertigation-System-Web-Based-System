<!DOCTYPE html>
<html lang="en" class="no-scrollbar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Document</title>
    {{-- @stack('styles') --}}
    @livewireStyles
</head>

<body class="bg-gray-50">
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-my-layouts.sidebar></x-my-layouts.sidebar>
        {{-- <main class="p-3 md:ml-[14.4rem] h-auto"> --}}
        <main class="p-3 md:ml-64 h-auto">
            <div class="flex justify-between items-center mb-4">
                @php
                    $name = explode(' ', Auth::user()->name);
                    $name = implode(' ', array_slice($name, 0, 2));

                    // Generate a random color (you can customize this logic)
                    $colors = ['bg-red-500', 'bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500'];
                    $randomColor = $colors[array_rand($colors)];
                    // Get the user's initials
                    $initials = strtoupper(substr(Auth::user()->name, 0, 1)); // You can add more logic for full initials
                @endphp
                <div>
                    <h1 class="text-lg font-medium">Hi, {{ $name }}</h1>
                    <span class="text-sm text-slate-500">Welcome to {{ Auth::user()->role }} page</span>
                </div>
                <div class="flex items-center">
                    @if (Auth::user()->profile_photo_path)
                        <!-- Show the profile photo -->
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ $name }}"
                            class="rounded-full h-8 w-8 object-cover">
                    @else
                        <div
                            class="{{ $randomColor }} rounded-full w-10 h-10 text-white flex justify-center items-center text-xl mr-3">
                            {{ $initials }}
                        </div>
                    @endif
                    <div>
                        <h4>{{ $name }}</h4>
                        <span class="text-sm text-slate-500">{{ Auth::user()->role }}</span>
                    </div>
                </div>
            </div>

            {{-- Toast Modal --}}
            <x-my-layouts.toast></x-my-layouts.toast>
            
            {{ $slot }}
    
            <x-my-layouts.footer></x-my-layouts.footer>
        </main>
    </div>

    {{-- @stack('scripts') --}}
    @livewireScripts

    {{-- <script>
        var chartLabels = @json($chartData['labels'] ?? null); // Pass labels
        var chartData = @json($chartData['data'] ?? null); // Pass data
    </script> --}}

    <script data-navigate-once>
        document.addEventListener('DOMContentLoaded', function() {
            // document.getElementById('updateProductButton').click();

            Livewire.on('showModal', () => {
                document.querySelector('#deleteModal').style.display = 'flex';
            });

            Livewire.on('hideModal', () => {
                document.querySelector('#deleteModal').style.display = 'none';
            });
            window.addEventListener('restoreSwitch', event => {
                let switchElement = document.getElementById(`switch-${event.detail.inputId.initialValue}`);
                // console.log(event.detail.originalStatus.initialValue);

                if (switchElement) {
                    switchElement.checked = event.detail.originalStatus
                        .initialValue; // Restore original switch value
                } else {
                    console.error("Switch element not found!");
                }

                document.querySelector('#deleteModal').style.display = 'none';
            });
        });

        document.addEventListener('livewire:navigated', () => {
            // console.log('navigated');
            initFlowbite();
        })
    </script>
</body>


</html>
