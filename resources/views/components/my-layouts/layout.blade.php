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
                <div>
                    <h1 class="text-lg font-medium">Hi, Ahmad Aseef</h1>
                    <span class="text-sm text-slate-500">Welcome to admin page</span>
                </div>
                <div class="flex items-center">
                    <div
                        class="rounded-3xl bg-red-500 w-10 h-10 text-white flex justify-center items-center text-xl mr-3">
                        A</div>
                    <div>
                        <h4>Ahmad Aseef</h4>
                        <span class="text-sm text-slate-500">admin</span>
                    </div>
                </div>
            </div>

            {{-- Toast Modal --}}
            <x-my-layouts.toast></x-my-layouts.toast>

            {{ $slot }}
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
