<!DOCTYPE html>
<html lang="en" class="no-scrollbar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Document</title>
    @stack('styles')
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
            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
    {{-- <script>
        var chartLabels = @json($chartData['labels'] ?? null); // Pass labels
        var chartData = @json($chartData['data'] ?? null); // Pass data
    </script> --}}

    {{-- <script>
    </script> --}}
    <script data-navigate-once>
        // window.addEventListener("load", function() {
        //     document.querySelector('[data-dropdown-toggle="scheduleFilterDropdown"]').click();
        // });
        // document.addEventListener("DOMContentLoaded", function(event) {
        //     document.getElementById('successButton').click();
        // });
        document.addEventListener('livewire:navigated', () => {
            console.log('navigated');
            initFlowbite();
            // document.querySelector('[data-dropdown-toggle="scheduleFilterDropdown"]').click();
            // document.getElementById('successButton').click();
        })
    </script>
</body>


</html>
