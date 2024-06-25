@extends('layouts.master')

@section('content')
    <div class="container">
        {{-- <img style="width:100%" height="400" src="https://quickchart.io/chart?c={type:'bar',data:{labels:[2012,2013,2014,2015, 2016],datasets:[{label:'Users',data:[120,60,50,180,120]}]}}" alt=""> --}}
        <div id="piechart" style="width: 100%; height: 500px; " class="mb-20"></div>

        <canvas id="1st_graph" width="800" height="400" style="display: none;"></canvas>
        {{-- <button id="getImageDataBtn">Get Image Data URL</button> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('1st_graph').getContext('2d');

            var primaryColor = KTUtil.getCssVariableValue('--kt-primary');
            var dangerColor = KTUtil.getCssVariableValue('--kt-danger');
            var successColor = KTUtil.getCssVariableValue('--kt-success');
            var warningColor = KTUtil.getCssVariableValue('--kt-warning');
            var defaultColor = KTUtil.getCssVariableValue('--kt-default');

            var fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');

            const labels = @json($months);
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Request a Quote (' + @json($second_graph_data[0]) + ')',
                    data: @json($first_count),
                    fill: false,
                    borderColor: primaryColor,
                    tension: 0.6
                },
                {
                    label: 'Special Offers (' + @json($second_graph_data[1]) + ')',
                    data: @json($second_count),
                    fill: false,
                    borderColor: dangerColor,
                    tension: 0.6
                },
                {
                    label: 'Smo Leads (' + @json($second_graph_data[2]) + ')',
                    data: @json($third_count),
                    fill: false,
                    borderColor: successColor,
                    tension: 0.6
                },
                {
                    label: 'Contact Us (Sales & Marketing) (' + @json($second_graph_data[3]) + ')',
                    data: @json($fourth_count),
                    fill: false,
                    borderColor: warningColor,
                    tension: 0.6
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    plugins: {
                        title: {
                            display: false,
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(tooltipItem) {
                                    let label = tooltipItem.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += tooltipItem.raw;
                                    return label;
                                }
                            }
                        }
                    },
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    defaults: {
                        global: {
                            defaultFont: fontFamily
                        }
                    }
                }
            };

            var chart_area = document.getElementById('piechart');

            var myChart = new Chart(ctx, config);

            // Function to convert canvas to data URL and set it as the src of an img element
            function updateImage() {
                setTimeout(function () {
                    var imageDataURL = ctx.canvas.toDataURL();
                    var img = document.createElement('img');
                    img.src = imageDataURL;
                    img.className = 'img-responsive';
                    img.style.width = '100%'; // Set width to 100%
                    chart_area.innerHTML = ''; // Clear previous content
                    chart_area.appendChild(img); // Append new img element
                }, 500); // Delay to ensure the chart is fully rendered
            }

            // Call the function to update the image
            updateImage();

            // Optionally, bind the function to a button click event
            document.getElementById('getImageDataBtn').addEventListener('click', function() {
                var imageDataURL = ctx.canvas.toDataURL();
                console.log('Canvas Data URL:', imageDataURL);

                // Send the imageDataURL to the backend via AJAX
                // sendImageData(imageDataURL);
            });
        });
    </script>
@endsection
