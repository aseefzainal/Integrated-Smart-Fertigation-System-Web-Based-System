<div wire:ignore
    class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-[26.3rem] bg-white shadow-lg flex flex-col">
    <div class="flex items-center justify-between py-3 px-3">
        <div class="flex items-center">
            @if (isset($chartData['sensorName']))
                <div class="w-5 h-3 bg-[rgb(255,99,132)] mr-2"></div>
                <h3 class="text-sm">{{ $chartData['sensorName'] }}</h3>
            @else
                <h3 class="text-sm">Chart</h3>
            @endif
        </div>
        @if ($chartData['data'])
            <button id="chartFilterButton" data-dropdown-toggle="chartFilter"
                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                type="button">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400"
                    viewbox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                        clip-rule="evenodd" />
                </svg>
                Filter
                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                </svg>
            </button>
            <div id="chartFilter"
                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                    @foreach ($sensors as $sensor)
                        {{-- @dump($sensor->id) --}}
                        <li>
                            <a wire:click="updateChart({{ $sensor->sensor_id }})"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">{{ $sensor->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    {{-- @dump($chartData['data']) --}}
    @if ($chartData['data'])
        <div class="w-full h-full pl-1">
            <canvas id="myChart"></canvas>
        </div>
    @else
        <div class="h-full flex flex-col justify-center items-center bg-slate-100">
            <p>There is no historical data available.</p>
            {{-- <p class="mt-2">Please contact an administrator to add sensors.</p> --}}
        </div>
    @endif
</div>

@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets
{{-- <script>
    var chartLabels = @json($chartData['labels'] ?? null);
    var chartData = @json($chartData['data'] ?? null);
</script> --}}
@script
    <script>
        let myChart = null; // Declare a variable to hold the chart instance

        // Function to initialize or update the chart
        function initOrUpdateChart() {
            const ctx = document.getElementById('myChart').getContext('2d'); // Get the canvas context
            const chartLabels = $wire.chartData['labels'];
            const chartData = $wire.chartData['data'];

            if (myChart) {
                // If the chart already exists, update the data and call chart.update()
                myChart.data.labels = chartLabels;
                myChart.data.datasets[0].data = chartData;
                myChart.update(); // Update the chart
            } else {
                // Create a new chart if it doesn't exist
                const data = {
                    labels: chartLabels,
                    datasets: [{
                        label: 'My First dataset',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: chartData,
                        tension: 0.4, // Set the tension to create a smooth curve
                        fill: true, // Fill under the line
                        borderWidth: 2,
                    }]
                };

                // Create a gradient for the background
                const gradient = ctx.createLinearGradient(0, 0, 0, 400); // Start at (0, 0) to (0, 400)
                gradient.addColorStop(0, 'rgba(255, 99, 132, 1)'); // Start with red
                gradient.addColorStop(1, 'rgba(255, 255, 255, 0.5)'); // End with white

                // Set the gradient as the background color for the dataset
                data.datasets[0].backgroundColor = gradient;

                const config = {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true, // Make the chart responsive
                        maintainAspectRatio: false, // Allows the chart to fit in the container height
                        plugins: {
                            legend: {
                                display: false // Optionally hide the entire legend
                            }
                        },
                        scales: {
                            y: {
                                grid: {
                                    // Optionally disable y-axis grid lines
                                },
                            },
                            x: {
                                grid: {
                                    // Optionally disable x-axis grid lines
                                }
                            }
                        }
                    }
                };

                // Create the chart and store it in the variable
                myChart = new Chart(ctx, config);
            }
        }

        // Call the function to initialize the chart on load
        initOrUpdateChart();

        // Use Livewire hook to re-initialize the chart when chartData updates
        Livewire.on('chartUpdated', () => {
            initOrUpdateChart(); // Reinitialize the chart with updated data
        });
    </script>
@endscript
