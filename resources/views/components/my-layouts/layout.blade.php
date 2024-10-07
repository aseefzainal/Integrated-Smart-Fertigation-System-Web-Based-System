<!DOCTYPE html>
<html lang="en" class="no-scrollbar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Document</title>
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
    @livewireScripts
    {{-- <script>
        var chartLabels = @json($chartData['labels'] ?? null); // Pass labels
        var chartData = @json($chartData['data'] ?? null); // Pass data
    </script> --}}
    <script>
        window.addEventListener("load", function() {
            document.querySelector('[data-modal-toggle="defaultModal"]').click();
        });
    </script>
</body>


</html>
