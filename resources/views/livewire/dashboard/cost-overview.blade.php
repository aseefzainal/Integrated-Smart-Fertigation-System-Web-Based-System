<div class="grid grid-cols-1 sm:grid-cols-4 gap-3 mb-4">
    <div
        class="col-span-1 sm:col-span-3 rounded-lg border-[1px] border-gray-200 dark:border-gray-600 bg-white p-4 shadow-md space-y-2">
        <div class="sm:flex sm:justify-between sm:items-center space-y-3 sm:space-y-0">
            <h3 class="font-medium">Cost Overview</h3>
            <ul class="flex items-center space-x-2 text-xs sm:text-sm text-slate-500">
                <li
                    class="px-3 py-1 border-[1px] border-gray-200 rounded-full cursor-pointer hover:text-white hover:bg-slate-600">
                    1 Month</li>
                <li
                    class="px-3 py-1 border-[1px] border-gray-200 rounded-full cursor-pointer hover:text-white hover:bg-slate-600">
                    3 Month</li>
                <li
                    class="px-3 py-1 border-[1px] border-gray-200 rounded-full cursor-pointer hover:text-white hover:bg-slate-600">
                    6 Month</li>
                <li
                    class="px-3 py-1 border-[1px] border-gray-200 rounded-full cursor-pointer hover:text-white hover:bg-slate-600">
                    1 Year</li>
            </ul>
        </div>
        <div class="flex justify-between items-center">
            <div class="space-y-1">
                <h4 class="text-xs text-slate-500">Avg per month</h4>
                <div class="flex items-center space-x-1">
                    <span class="text-base sm:text-xl">RM100.00</span>
                    <div class="flex items-center">
                        <span class="text-xs text-blue-600">13.4%</span>
                        <svg class="size-3 text-blue-600 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5.575 13.729C4.501 15.033 5.43 17 7.12 17h9.762c1.69 0 2.618-1.967 1.544-3.271l-4.881-5.927a2 2 0 0 0-3.088 0l-4.88 5.927Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row space-y-1 sm:space-y-0 sm:space-x-4">
                <div class="flex items-center">
                    <div class="size-2 sm:size-3 rounded-full bg-blue-500"></div>
                    <span class="text-xs sm:text-sm ml-2 text-slate-800">Pending Payment</span>
                </div>
                <div class="flex items-center">
                    <div class="size-2 sm:size-3 rounded-full bg-red-500"></div>
                    <span class="text-xs sm:text-sm ml-2 text-slate-800">Payment Received</span>
                </div>
            </div>
        </div>
        <div class="w-full">
            <canvas id="costChart"></canvas>
        </div>
    </div>
    <div
        class="rounded-lg border-[1px] border-gray-200 dark:border-gray-600 bg-white shadow-md overflow-y-auto no-scrollbar">
        <div class="p-4 sticky top-0 z-10 bg-white">
            <h3 class="font-medium">Highest Unpaid</h3>
            {{-- <div class="p-1.5 sm:p-1 cursor-pointer rounded-md border border-gray-200 hover:border-gray-400 hover:bg-gray-100 hover:text-primary-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-gray-400 hover:text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                  </svg>                  
            </div> --}}
        </div>
        <div>
            @foreach ($users as $user)
                <div class="flex justify-between items-center px-4 py-2 cursor-pointer hover:bg-slate-100">
                    <div class="flex items-center">
                        <div
                            class="{{ $user->random_color }} rounded-full size-9 text-white flex justify-center items-center text-xl mr-2">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-sm">{{ implode(' ', array_slice(preg_split('/\s+/', $user->name), 0, 2)) }}
                            </h3>
                            <span class="text-xs text-slate-500">{{ $user->username }}</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs text-slate-500">Outstanding</h4>
                        @php
                            $bill = 0;
                            $smsBills = $user->smsBills()->where('status', 'unpaid')->get();
                            foreach ($smsBills as $smsBill) {
                                $bill += $smsBill->total_sms_amount;
                            }
                        @endphp
                        <span class="text-sm">RM{{ number_format($bill, 2) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
    <script>
        let myChart = null; // Declare a variable to hold the chart instance

        // Function to initialize or update the chart
        function initOrUpdateChart() {
            // Chart.js initialization
            // document.addEventListener("DOMContentLoaded", function() {
            const contex = document.getElementById('costChart').getContext('2d');

            // Destroy the existing chart instance if it exists
            // if (myChart) {
            //     myChart.destroy();
            // }

            // Data for the chart
            const chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
                'Sep', 'Oct', 'Nov', 'Dec'
            ];
            const chartData1 = [100, 50, 150, 100, 300, 600, 400, 700, 800, 900, 600, 200];
            const chartData2 = [100, 200, 50, 300, 600, 400, 500, 900, 1000, 700, 800, 400];

            // Chart configuration
            const data = {
                labels: chartLabels,
                datasets: [{
                        label: 'Paid',
                        data: chartData1,
                        borderColor: 'rgb(54, 162, 235)',
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        // borderWidth: 1,
                        borderRadius: 5,
                    },
                    {
                        label: 'Unpaid',
                        data: chartData2,
                        borderColor: 'rgb(240, 82, 82)',
                        backgroundColor: 'rgba(240, 82, 82, 0.8)',
                        // borderWidth: 1,
                        borderRadius: 5,
                    },
                ]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            // position: 'top',
                            display: false
                        },
                        // title: {
                        //     display: true,
                        //     text: 'Cost Overview'
                        // }
                    },
                },
            };

            // Create chart instance
            myChart = new Chart(contex, config);
            // });
        }
        // }
        // Call the function to initialize the chart on load
        initOrUpdateChart();

        // Use Livewire hook to re-initialize the chart when chartData updates
        Livewire.on('costChart', () => {
            initOrUpdateChart(); // Reinitialize the chart with updated data
        });
    </script>
@endscript
