

    <style>
        body{
            width: 100%;
            
        }
        .chart-container {
            display: none !important;
            height: 400px;
        }
        .chart-container.active {
            display: block !important;
            height: 400px;
        }

        /* .graph {
          width: 100%;
          margin: 20px auto;
          height: 50%;
        }
        .bar {
          display: flex;
          align-items: center;
          margin-bottom: 10px;
          width: 20%;
        }
        .bar-label {
          width: 30px;
          text-align: right;
          margin-right: 10px;
        }
        .bar-value {
          height: 20px;
          background: linear-gradient(to right, #00c6ff, #0072ff);
          text-align: right;
          color: white;
          padding-right: 5px;
        }

        .chart-vertical {
          width: 100%;
          margin: 20px auto;
  
        }

    

    .graph {
      width: 100%;
      margin: 40px auto;
      border-radius: 10px;
      height: 50%;
    }
    .line-chart {
      width: 50%;
      height: 400px;
     
    }
    .line {
      fill: none;
      stroke: #0072ff;
      stroke-width: 2;
     
    }
    .dot {
      fill: #0072ff;
    }
    .grid line {
      stroke: #e0e0e0;
      stroke-width: 1;
    }
    .grid path {
      stroke-width: 0;
    }




    .chart-vertical {
      width: 100%;
      /* margin: 20px auto; */
      /* background-color: #fff;
      height: 50%;
     
    } */
    /* .card {
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .barr {
      display: flex;
      align-items: flex-end;
      height: 300px;
      width: 40px;
      margin: 10px;
      flex-direction: column-reverse;
      
    }
    .bar-lab {
      text-align: center;
      margin-top: 5px;
    }
    .bar-val {
      width: 100%;
      background: linear-gradient(to top, #00c6ff, #0072ff);
      text-align: center;
      color: white;
    }
    .bar-vertical {
      display: flex;
      justify-content: space-around;
      align-items: flex-end;
      height: 350px;
      border-bottom: 1px solid;
    }


    .pie-chart {
	background:
		radial-gradient(
			circle closest-side,
			transparent 66%,
			white 0
		),
		conic-gradient(
			#4e79a7 0,
			#4e79a7 28.1%,
			#f28e2c 0,
			#f28e2c 45.1%,
			#e15759 0,
			#e15759 57%,
			#76b7b2 0,
			#76b7b2 64.4%,
			#59a14f 0,
			#59a14f 68.8%,
			#edc949 0,
			#edc949 74%,
			#af7aa1 0,
			#af7aa1 85.1%,
			#ff9da7 0,
			#ff9da7 99.9%
	);
	position: relative;
	width: 50%;
	height: 50%;
	margin: 0;
	outline: 1px solid #ccc;
    border-radius: 5px;
}
.pie-chart h2 {
	position: absolute;
	margin: 1rem;
}
.pie-chart cite {
	position: absolute;
	bottom: 0;
	font-size:50%;
	padding: 1rem;
	color: gray;
}
.pie-chart figcaption {
	position: absolute;
	bottom: 1em;
	right: 1em;
	font-size: smaller;
	text-align: right;
}
.pie-chart span:after {
	display: inline-block;
	content: "";
	width: 0.8em;
	height: 0.8em;
	margin-left: 0.4em;
	height: 0.8em;
	border-radius: 0.2em;
	background: currentColor;
}

.surface:hover {fill: rgba(255, 255, 255, 0.1) !important;}  */
      
</style>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <div class="container-fluid">
                    <!-- Toggle Buttons -->
                    <!-- Date Range Buttons -->
                    <div class="mb-4">
                        <button class="btn btn-secondary" onclick="updateChart('daily')">Daily</button>
                        <button class="btn btn-secondary" onclick="updateChart('weekly')">Weekly</button>
                        <button class="btn btn-secondary" onclick="updateChart('monthly')">Monthly</button>
                    </div>
                    <!-- Chart Containers -->
                    <div id="areaChart" class="chart-container">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                    <div id="pieChart" class="chart-container">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div id="barChart" class="chart-container">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <div id="lineChart" class="chart-container">
                        <canvas id="myLineChart"></canvas>
                    </div>
                    <div id="verticalBarChart" class="chart-container">
                        <canvas id="myVerticalBarChart"></canvas>
                    </div>
                    <div class="my-4">
                        <button class="btn btn-primary" onclick="showChart('areaChart')">Area Chart</button>
                        <button class="btn btn-primary" onclick="showChart('pieChart')">Pie Chart</button>
                        <button class="btn btn-primary" onclick="showChart('barChart')">Bar Chart</button>
                        <button class="btn btn-primary" onclick="showChart('lineChart')">Line Chart</button>
                        <button class="btn btn-primary" onclick="showChart('verticalBarChart')">Vertical Bar Chart</button>
                    </div>
                </div>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartType = 'daily';

        const areaChartCtx = document.getElementById('myAreaChart').getContext('2d');
        const pieChartCtx = document.getElementById('myPieChart').getContext('2d');
        const barChartCtx = document.getElementById('myBarChart').getContext('2d');
        const lineChartCtx = document.getElementById('myLineChart').getContext('2d');
        const verticalBarChartCtx = document.getElementById('myVerticalBarChart').getContext('2d');

        let areaChart = new Chart(areaChartCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Earnings',
                    data: [],
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });

        let pieChart = new Chart(pieChartCtx, {
            type: 'doughnut',
            data: {
                labels: ['Direct', 'Social', 'Referral'],
                datasets: [{
                    data: [],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        let barChart = new Chart(barChartCtx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Revenue',
                    data: [],
                    backgroundColor: 'rgba(78, 115, 223, 1)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });

        let lineChart = new Chart(lineChartCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Sales',
                    data: [],
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });

        let verticalBarChart = new Chart(verticalBarChartCtx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Expenses',
                    data: [],
                    backgroundColor: 'rgba(78, 115, 223, 1)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });

        function showChart(chartId) {
            const charts = document.querySelectorAll('.chart-container');
            charts.forEach(chart => {
                chart.classList.remove('active');
            });
            document.getElementById(chartId).classList.add('active');
            console.log(`Showing chart: ${chartId}`);
        }

        function updateChart(timeFrame) {
            chartType = timeFrame;
            let data, labels;

            switch (timeFrame) {
                case 'daily':
                    labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    data = [12, 19, 3, 5, 2, 3, 7]; // Example data
                    break;
                case 'weekly':
                    labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                    data = [20, 30, 10, 40]; // Example data
                    break;
                case 'monthly':
                    labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    data = [30, 40, 20, 50, 60, 70, 80, 90, 100, 110, 120, 130]; // Example data
                    break;
            }

            // Update all charts with new data and labels
            updateChartData(areaChart, labels, data);
            updateChartData(pieChart, labels.slice(0, 3), data.slice(0, 3)); // Pie chart typically has fewer segments
            updateChartData(barChart, labels, data);
            updateChartData(lineChart, labels, data);
            updateChartData(verticalBarChart, labels, data);
            console.log(`Updated charts for: ${timeFrame}`);
        }

        function updateChartData(chart, labels, data) {
            chart.data.labels = labels;
            chart.data.datasets.forEach(dataset => {
                dataset.data = data;
            });
            chart.update();
        }

        // Initialize with daily data
        updateChart('daily');
        showChart('areaChart');
    </script>
