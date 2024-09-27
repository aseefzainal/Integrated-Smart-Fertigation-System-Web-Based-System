import Chart from 'chart.js/auto';

const labels = [
    'Jan',
    'Feb',
    'March',
    'April',
    'May',
    'June',
    'July',
    'Ogos',
    'Sept',
    'Oct'
];

const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [70, 10, 5, 2, 20, 30, 45, 50, 30, 60],
        tension: 0.4, // Set the tension to create a smooth curve
        fill: true, // Fill under the line
        borderWidth: 2,
    }]
};

const ctx = document.getElementById('myChart').getContext('2d'); // Get the canvas context

// Create a gradient
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
                // ticks: {
                //     padding: 0, // Removes space between y-axis ticks and chart
                //     margin: 0
                // },
                grid: {
                    // display: false // Disable y-axis grid lines
                },
                // beginAtZero: true
            },
            x: {
                grid: {
                    // display: false // Disable x-axis grid lines
                }
            }
        }
    }
};

new Chart(ctx, config);