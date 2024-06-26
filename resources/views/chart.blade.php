<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Example</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // Chart Data from Laravel passed as PHP variable
        var chartData = @json($chartData);

        // Chart.js code to render the chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Change the chart type as needed (line, bar, pie, etc.)
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Chart Example',
                    data: chartData.values,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Adjust colors as needed
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    </script>
</body>
</html>
