<style>
    body {
        width: 100;
    }
    .chart-container {
        display: none !important;
        height: 400px;
    }
    .chart-container.active {
        display: block !important;
        height: 400px;
    }
    .chart-container-2 {
        display: none !important;
        height: 400px;
    }
    .chart-container-2.active {
        display: block !important;
        height: 400px;
    }
    .chart-container-3 {
        display: none !important;
        height: 400px;
    }
    .chart-container-3.active {
        display: block !important;
        height: 400px;
    }
    .chart-container-4 {
        display: none !important;
        height: 400px;
    }
    .chart-container-4.active {
        display: block !important;
        height: 400px;
    }
    .chart-container-5 {
        display: none !important;
        height: 400px;
    }
    .chart-container-5.active {
        display: block !important;
        height: 400px;
    }
    .chart-container-6 {
        display: none !important;
        height: 400px;
    }
    .chart-container-6.active {
        display: block !important;
        height: 400px;
    }
    .chart-container-7 {
        display: none !important;
        height: 400px;
    }
    .chart-container-7.active {
        display: block !important;
        height: 400px;
    }
    label {
    font-size: 0.8rem !important;
    margin-top: 0.5rem !important;
}
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12 d-flex justify-content-end ">
                    <form method="post" action="<?php echo site_url('Home/compareFilterGraphs2'); ?>">
                    <div class="d-flex ">
                            <label for="from-date"> From: </label> &nbsp;
                            <input id="from-date" name="from" class="form-control" type="date" value="<?php echo $this->uri->segment(3); ?>" required> &nbsp;
                            <label for="to-date"> To: </label> &nbsp;
                            <input id="to-date" name="to" class="form-control" type="date" value="<?php echo $this->uri->segment(4); ?>" required>
                            &nbsp;<button type="submit" class="bg-primary border-primary text-light"> <i class="fa fa-search "></i></button> 
                    </div>
                    </form> &nbsp;&nbsp;
                    <!-- <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" /> -->
                    <div class="mb-4">
                            <select name="" id="chartTypeSelector" class="form-control" onchange="handleChartTypeChange()">
                                <option value="Quantity">Quantity</option>
                                <option value="Size">Size</option>
                                <option value="Media">Media</option>
                                <option value="Publication">Publication</option>
                                <option value="Geography">Geography</option>
                                <option value="Journalist">Journalist</option>
                                <option value="ave">AVE</option>
                            </select>
                        </div>
                </div>
            </div>
            <div class="quantity">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Quantity</h6>
                    </div>
                </div>
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
                    <!-- <button class="btn btn-primary" onclick="showChart('areaChart')">Area Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart('pieChart')">Pie Chart</button>
                    <button class="btn btn-primary" onclick="showChart('barChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart('lineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart('verticalBarChart')">Column Chart</button>
                </div>
            </div>

            <hr>
            <div class="size">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Size</h6>
                    </div>
                </div>
                <div id="sizeareaChart" class="chart-container-2">
                    <canvas id="sizeAreaChart"></canvas>
                </div>
                <div id="sizepieChart" class="chart-container-2">
                    <canvas id="sizePieChart"></canvas>
                </div>
                <div id="sizebarChart" class="chart-container-2">
                    <canvas id="sizeBarChart"></canvas>
                </div>
                <div id="sizelineChart" class="chart-container-2">
                    <canvas id="sizeLineChart"></canvas>
                </div>
                <div id="sizeverticalBarChart" class="chart-container-2">
                    <canvas id="sizeVerticalBarChart"></canvas>
                </div>
                <div class="my-4">
                    <!-- <button class="btn btn-primary" onclick="showChart2('sizeareaChart')">Area Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart2('sizepieChart')">Pie Chart</button>
                    <button class="btn btn-primary" onclick="showChart2('sizebarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart2('sizelineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart2('sizeverticalBarChart')">Column Chart</button>
                </div>
            </div>
            <div class="media">
           
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Media</h6>
                    </div>
                </div>
               
                <div id="mediabarChart" class="chart-container-3">
                    <canvas id="mediaBarChart"></canvas>
                </div>
                <div id="medialineChart" class="chart-container-3">
                    <canvas id="mediaLineChart"></canvas>
                </div>
                <div id="mediaverticalBarChart" class="chart-container-3">
                    <canvas id="mediaVerticalBarChart"></canvas>
                </div>
                <div id="showMediaTableData" class="chart-container-3" style="display: none;">
                    <table id="mediaTable">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Media Type</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be appended here -->
                        </tbody>
                    </table>
                </div>
                <div class="my-4">
                    <button class="btn btn-primary" onclick="showChart3('mediabarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart3('medialineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart3('mediaverticalBarChart')">Column Chart</button>
                </div>
            </div>
            <div class="publication">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Publication</h6>
                    </div>
                </div>
                <div id="publicationbarChart" class="chart-container-4">
                    <canvas id="publicationBarChart"></canvas>
                </div>
                <div id="publicationlineChart" class="chart-container-4">
                    <canvas id="publicationLineChart"></canvas>
                </div>
                <div id="publicationverticalBarChart" class="chart-container-4">
                    <canvas id="publicationVerticalBarChart"></canvas>
                </div>
                <div class="my-4">
                    <button class="btn btn-primary" onclick="showChart4('publicationbarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart4('publicationlineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart4('publicationverticalBarChart')">Column Chart</button>
                </div>
            </div>
            <div class="geography">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">SOV / Geography</h6>
                    </div>
                </div>
                <div id="geographybarChart" class="chart-container-5">
                    <canvas id="geographyBarChart"></canvas>
                </div>
                <div id="geographylineChart" class="chart-container-5">
                    <canvas id="geographyLineChart"></canvas>
                </div>
                <div id="geographyverticalBarChart" class="chart-container-5">
                    <canvas id="geographyVerticalBarChart"></canvas>
                </div>
                <div class="my-4">
                    <button class="btn btn-primary" onclick="showChart5('geographybarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart5('geographylineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart5('geographyverticalBarChart')">Column Chart</button>
                </div>
            </div>

            <div class="journalist">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Journalist</h6>
                    </div>
                </div>
                <!-- <div id="journalistareaChart" class="chart-container-6">
                    <canvas id="journalistAreaChart"></canvas>
                </div>
                <div id="journalistpieChart" class="chart-container-6">
                    <canvas id="journalistPieChart"></canvas>
                </div> -->
                <div id="journalistbarChart" class="chart-container-6">
                    <canvas id="journalistBarChart"></canvas>
                </div>
                <div id="journalistlineChart" class="chart-container-6">
                    <canvas id="journalistLineChart"></canvas>
                </div>
                <div id="journalistverticalBarChart" class="chart-container-6">
                    <canvas id="journalistVerticalBarChart"></canvas>
                </div>
                <div class="my-4">
                    <!-- <button class="btn btn-primary" onclick="showChart6('journalistareaChart')">Area Chart</button> -->
                    <!-- <button class="btn btn-primary" onclick="showChart6('journalistpieChart')">Pie Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart6('journalistbarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart6('journalistlineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart6('journalistverticalBarChart')">Column Chart</button>
                </div>
            </div>

            <div class="ave">
           
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Media</h6>
                    </div>
                </div>
               <div id="aveareaChart" class="chart-container-7">
                    <canvas id="aveAreaChart"></canvas>
                </div>
                <div id="avepieChart" class="chart-container-7">
                    <canvas id="avePieChart"></canvas>
                </div>
                <div id="avebarChart" class="chart-container-7">
                    <canvas id="aveBarChart"></canvas>
                </div>
                <div id="avelineChart" class="chart-container-7">
                    <canvas id="aveLineChart"></canvas>
                </div>
                <div id="aveverticalBarChart" class="chart-container-7">
                    <canvas id="aveVerticalBarChart"></canvas>
                </div>
                <div id="showaveTableData" class="chart-container-7" style="display: none;">
                    <table id="mediaTable">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Media Type</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be appended here -->
                        </tbody>
                    </table>
                </div>
                <div class="my-4">
                    <button class="btn btn-primary" onclick="showChart7('avepieChart')">Pie Chart</button>
                    <button class="btn btn-primary" onclick="showChart7('avebarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart7('avelineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart7('aveverticalBarChart')">Column Chart</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Quantity Charts
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
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let pieChart = new Chart(pieChartCtx, {
        type: 'doughnut',
        data: {
            labels: [],
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
                label: '',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
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
                label: '',
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
                            return value + '';
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
                label: '',
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
                            return value + '';
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
        let data = [];
        let labels = [];
        var quantityGraphDaily = <?php echo json_encode($get_quantity_compare_data); ?>;
        var quantityGraphWeekly = <?php echo json_encode($get_quantity_compare_data); ?>;
        var quantityGraphMonthly = <?php echo json_encode($get_quantity_compare_data); ?>;
        
        switch (timeFrame) {    
            case 'daily':
                for (var i = 0; i < quantityGraphDaily.length; i++) {
                    labels.push(quantityGraphDaily[i].label);
                    data.push(quantityGraphDaily[i].count);
                }
                break;
            case 'weekly':
                for (var i = 0; i < quantityGraphWeekly.length; i++) {
                    labels.push(quantityGraphWeekly[i].label);
                    data.push(quantityGraphWeekly[i].count);
                }
                break;
            case 'monthly':
                for (var i = 0; i < quantityGraphMonthly.length; i++) {
                    labels.push(quantityGraphMonthly[i].label);
                    data.push(quantityGraphMonthly[i].count);
                }
                break;
        }        
        updateChartData(areaChart, labels, data);
        updateChartData(pieChart, labels.slice(0, 3), data.slice(0, 3)); 
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

//size chart section
const sizeAreaChartCtx = document.getElementById('sizeAreaChart').getContext('2d');
    const sizePieChartCtx = document.getElementById('sizePieChart').getContext('2d');
    const sizeBarChartCtx = document.getElementById('sizeBarChart').getContext('2d');
    const sizeLineChartCtx = document.getElementById('sizeLineChart').getContext('2d');
    const sizeVerticalBarChartCtx = document.getElementById('sizeVerticalBarChart').getContext('2d');

    let sizeAreaChart = new Chart(sizeAreaChartCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Small',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
                fill: true
            },{
                label: 'Medium',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
                fill: true
            },{
                label: 'Large',
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
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let sizePieChart = new Chart(sizePieChartCtx, {
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

    let sizeBarChart = new Chart(sizeBarChartCtx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Small',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            },{
                label: 'Medium',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            },{
                label: 'Large',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let sizeLineChart = new Chart(sizeLineChartCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Small',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
                fill: true
            },{
                label: 'Medium',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
                fill: true
            },{
                label: 'Large',
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
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let sizeVerticalBarChart = new Chart(sizeVerticalBarChartCtx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Samll',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            },{
                label: 'Medium',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            },{
                label: 'Large',
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
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    function showChart2(chartId) {
        const charts = document.querySelectorAll('.chart-container-2');
        charts.forEach(chart => {
            chart.classList.remove('active');
        });
        document.getElementById(chartId).classList.add('active');
        console.log(`Showing chart: ${chartId}`);
    }

    function updateChart2(timeFrame) {
       
        let size_data = <?php echo json_encode($size_data); ?>;

        let labels = [];
        let data = [
            [], // For 'small'
            [], // For 'medium'
            [], // For 'large'
        ];

        // Populate labels array and initialize data arrays with zeros
        size_data.forEach(item => {
            if (!labels.includes(item.label)) {
                labels.push(item.label);
            }
        });

        // Initialize data arrays with zeros
        labels.forEach(() => {
            data[0].push(0); // For 'small'
            data[1].push(0); // For 'medium'
            data[2].push(0); // For 'large'
        });

        // Populate data arrays with counts from size_data
        size_data.forEach(item => {
            let labelIndex = labels.indexOf(item.label);
            if (item.category === 'small') {
                data[0][labelIndex] = item.count;
            } else if (item.category === 'medium') {
                data[1][labelIndex] = item.count;
            } else if (item.category === 'large') {
                data[2][labelIndex] = item.count;
            }
        });

        switch (timeFrame) {
            case 'daily':
                labels = labels;
                data = data; 
                break;
            case 'weekly':
                labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                data = [[10, 30, 10, 40], [30, 30, 10, 40], [20, 30, 10, 40]]; 
                break;
            case 'monthly':
                labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                data = [[30, 40, 20, 50, 60, 70, 80, 90, 100, 110, 120, 130], [50, 40, 20, 50, 60, 70, 80, 90, 100, 110, 120, 130], [60, 40, 20, 50, 60, 70, 80, 90, 100, 110, 120, 130]]; 
                break;
        }

        updateChartData2(sizeAreaChart, labels, data);
        updateChartData2(sizePieChart, labels.slice(0, 3), data.slice(0, 3)); 
        updateChartData2(sizeBarChart, labels, data);
        updateChartData2(sizeLineChart, labels, data);
        updateChartData2(sizeVerticalBarChart, labels, data);
        console.log(`Updated size charts for: ${timeFrame}`);
    }
    function updateChartData2(chart, labels, data) {
        chart.data.labels = labels;
        var i = 0;
        chart.data.datasets.forEach(dataset => {
            dataset.data = data[i];
            i++;
        });
        chart.update();
    }

  // media
    const mediaBarChartCtx = document.getElementById('mediaBarChart').getContext('2d');
    const mediaLineChartCtx = document.getElementById('mediaLineChart').getContext('2d');
    const mediaVerticalBarChartCtx = document.getElementById('mediaVerticalBarChart').getContext('2d');

    let news_data = <?php echo json_encode($media_data); ?>;
    let media_dataset_line = [];
    let media_dataset_bar = [];
    let media_dataset_column = [];
    let media_lable = [];
    let clientNames = new Set();
    for (let mediaType in news_data) {
        if (news_data.hasOwnProperty(mediaType)) {
            // mediaType will be 'Newspaper', 'Online', etc.
            console.log("Media Type:", mediaType);
            media_lable.push(mediaType);
            // Access the array of news details for this media type
            let clientNames = new Set();
            
        }
        news_data[mediaType].forEach(news => clientNames.add(news.Client_name));
    }

    clientNames = Array.from(clientNames);

    // Create final data array
    let final_data = clientNames.map(clientName => {
        let counts = [];
        for (let mediaType in news_data) {
            let mediaData = news_data[mediaType];
            let countData = mediaData.find(news => news.Client_name === clientName);
            counts.push(countData ? countData.Count : 0);
        }
        return {
            lable: clientName,
            count: counts
        };
    });

    console.log('Final media data '+final_data);
    function getRandomColor(opacity) {
    let r = Math.floor(Math.random() * 255);
    let g = Math.floor(Math.random() * 255);
    let b = Math.floor(Math.random() * 255);
    return {
        background: `rgba(${r}, ${g}, ${b}, ${opacity})`,
        border: `rgba(${r}, ${g}, ${b}, 1)`
    };
}
    for (let i = 0; i < final_data.length; i++) {
        let color = getRandomColor(0.1);
        media_dataset_line.push({
                label: final_data[i]['lable'],
                data: final_data[i]['count'],
                backgroundColor: color.background,
                borderColor: color.border,
                borderWidth: 2,
                fill: true
            })

            media_dataset_bar.push({
                label: final_data[i]['lable'],
                data: final_data[i]['count'],
                backgroundColor: color.background,
                borderColor: color.border,
                borderWidth: 1
            })

            media_dataset_column.push({
                label: final_data[i]['lable'],
                data: final_data[i]['count'],
                 backgroundColor: color.background,
                borderColor: color.border,
                borderWidth: 1
            })
    }

    let mediaBarChart = new Chart(mediaBarChartCtx, {
        type: 'bar',
        data: {
            labels: media_lable,
            datasets: media_dataset_bar
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    
    let mediaLineChart = new Chart(mediaLineChartCtx, {
        type: 'line',
        data: {
            labels: media_lable,
            datasets: media_dataset_line
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });


    let mediaVerticalBarChart = new Chart(mediaVerticalBarChartCtx, {
        type: 'bar',
        data: {
            labels: media_lable,
            datasets: media_dataset_column
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    
    function showChart3(chartId) {
        const charts = document.querySelectorAll('.chart-container-3');
        charts.forEach(chart => {
            chart.classList.remove('active');
        });
        document.getElementById(chartId).classList.add('active');
        console.log(`Showing chart: ${chartId}`);
    }

    function updateChart3(timeFrame) {
        let data = [];
        let labels = [];
        var mediaGraphDaily = <?php echo json_encode($get_quantity_compare_data); ?>;
        var mediaGraphWeekly = <?php echo json_encode($get_quantity_compare_data); ?>;
        var mediaGraphMonthly = <?php echo json_encode($get_quantity_compare_data); ?>;
        switch (timeFrame) {
            case 'daily':
                
                for (var i = 0; i < mediaGraphDaily.length; i++) {
                labels.push(`${mediaGraphDaily[i].label} - ${mediaGraphDaily[i].MediaType}`);
                data.push(mediaGraphDaily[i].count);
                break;
                }
            case 'weekly':
                for (var i = 0; i < mediaGraphWeekly.length; i++) {
                labels.push(`${mediaGraphWeekly[i].label} - ${mediaGraphWeekly[i].MediaType}`);
                data.push(mediaGraphWeekly[i].count);
            }
                break;
            case 'monthly':
                for (var i = 0; i < mediaGraphMonthly.length; i++) {
                labels.push(`${mediaGraphMonthly[i].label} - ${mediaGraphMonthly[i].MediaType}`);
                data.push(mediaGraphMonthly[i].count);
                }
                break;
        }

        updateChartData3(mediaBarChart, labels, data);
        updateChartData3(mediaLineChart, labels, data);
        updateChartData3(mediaVerticalBarChart, labels, data);
        console.log(`Updated size charts for: ${timeFrame}`);
    }
    function updateChartData3(chart, labels, data) {
        // console.log(data)
        //     console.log(chart.data.datasets);
        //     chart.data.labels = labels;
        //     var i = 0;
        //     chart.data.datasets.forEach(dataset => {
        //         dataset.data = data[i];
        //         i++;
        //     });
        // chart.data.labels = labels;
        // chart.data.datasets.forEach(dataset => {
        //     dataset.data = data;
        // });
        chart.update();
    }

   
    //Publication
    const publicationBarChartCtx = document.getElementById('publicationBarChart').getContext('2d');
    const publicationLineChartCtx = document.getElementById('publicationLineChart').getContext('2d');
    const publicationVerticalBarChartCtx = document.getElementById('publicationVerticalBarChart').getContext('2d');

    let Publication_news_data = <?php echo json_encode($Publication_data); ?>;
    let publication_dataset_line = [];
    let publication_dataset_bar = [];
    let publication_dataset_column = [];
    let publication_lable = [];
    let pub_clientNames = new Set();

    for (let publication in Publication_news_data) {
        if (Publication_news_data.hasOwnProperty(publication)) {
            console.log("Publication:", publication);
            publication_lable.push(publication);
            // Collect client names
            Publication_news_data[publication].forEach(news => pub_clientNames.add(news.Client_name));
        }
    }

    pub_clientNames = Array.from(pub_clientNames);

    // Create final data array
    let publication_final_data = pub_clientNames.map(clientName => {
        let counts = [];
        for (let publication in Publication_news_data) {
            let publicationData = Publication_news_data[publication];
            let count = publicationData
                .filter(news => news.Client_name === clientName)
                .reduce((sum, news) => sum + news.Count, 0);
            counts.push(count);
        }
        return {
            label: clientName,
            count: counts
        };
    });

    console.log("Publication final data:", publication_final_data);
    function getRandomColor(opacity) {
        let r = Math.floor(Math.random() * 255);
        let g = Math.floor(Math.random() * 255);
        let b = Math.floor(Math.random() * 255);
        return {
            background: `rgba(${r}, ${g}, ${b}, ${opacity})`,
            border: `rgba(${r}, ${g}, ${b}, 1)`
        };
    }

    for (let i = 0; i < publication_final_data.length; i++) {
        let color = getRandomColor(0.1);
        publication_dataset_line.push({
            label: publication_final_data[i]['label'],
            data: publication_final_data[i]['count'],
            backgroundColor: color.background,
            borderColor: color.border,
            borderWidth: 2,
            fill: true
        });

        publication_dataset_bar.push({
            label: publication_final_data[i]['label'],
            data: publication_final_data[i]['count'],
            backgroundColor: color.background,
            borderColor: color.border,
            borderWidth: 1
        });

        publication_dataset_column.push({
            label: publication_final_data[i]['label'],
            data: publication_final_data[i]['count'],
            backgroundColor: color.background,
            borderColor: color.border,
            borderWidth: 1
        });
    }

    let publicationBarChart = new Chart(publicationBarChartCtx, {
        type: 'bar',
        data: {
            labels: publication_lable, // Corrected from 'label' to 'labels'
            datasets: publication_dataset_column // Corrected from 'data' to 'datasets'
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let publicationLineChart = new Chart(publicationLineChartCtx, {
        type: 'line',
        data: {
            labels: publication_lable, // Corrected from 'label' to 'labels'
            datasets: publication_dataset_line // Corrected from 'data' to 'datasets'
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let publicationVerticalBarChart = new Chart(publicationVerticalBarChartCtx, {
        type: 'bar',
        data: {
            labels: publication_lable, // Corrected from 'label' to 'labels'
            datasets: publication_dataset_column // Corrected from 'data' to 'datasets'
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    function showChart4(chartId) {
        const charts = document.querySelectorAll('.chart-container-4');
        charts.forEach(chart => {
            chart.classList.remove('active');
        });
        document.getElementById(chartId).classList.add('active');
        console.log(`Showing chart: ${chartId}`);
    }
  
    function updateChart4(timeFrame) {
        let data = [];
        let labels = [];
        var publicationGraphDaily = <?php echo json_encode($get_quantity_compare_data); ?>;
        var publicationGraphWeekly = <?php echo json_encode($get_quantity_compare_data); ?>;
        var publicationGraphMonthly = <?php echo json_encode($get_quantity_compare_data); ?>;
        switch (timeFrame) {
            case 'daily':
                for (var i = 0; i < publicationGraphDaily.length; i++) {
                labels.push(`${publicationGraphDaily[i].label} - ${publicationGraphDaily[i].MediaOutlet}`);
                data.push(publicationGraphDaily[i].count);
                }
                break;
            case 'weekly':
                for (var i = 0; i < publicationGraphWeekly.length; i++) {
                labels.push(`${publicationGraphWeekly[i].label} - ${publicationGraphWeekly[i].MediaOutlet}`);
                data.push(publicationGraphWeekly[i].count);
                }
                break;
            case 'monthly':
                for (var i = 0; i < publicationGraphMonthly.length; i++) {
                labels.push(`${publicationGraphMonthly[i].label} - ${publicationGraphMonthly[i].MediaOutlet}`);
                data.push(publicationGraphMonthly[i].count);
                } 
                break;
        }

        // updateChartData4(publicationAreaChart, labels, data);
        // updateChartData4(publicationPieChart, labels.slice(0, 3), data.slice(0, 3)); 
        updateChartData4(publicationBarChart, labels, data);
        updateChartData4(publicationLineChart, labels, data);
        updateChartData4(publicationVerticalBarChart, labels, data);
        console.log(`Updated size charts for: ${timeFrame}`);
    }
    function updateChartData4(chart, labels, data) {
        // chart.data.labels = labels;
        // chart.data.datasets.forEach(dataset => {
        //     dataset.data = data;
        // });
        chart.update();
    }

    //geography 
    const geographyBarChartCtx = document.getElementById('geographyBarChart').getContext('2d');
    const geographyLineChartCtx = document.getElementById('geographyLineChart').getContext('2d');
    const geographyVerticalBarChartCtx = document.getElementById('geographyVerticalBarChart').getContext('2d');
    
    let geography_news_data = <?php echo json_encode($geography_data); ?>;
    let geography_dataset_line = [];
    let geography_dataset_bar = [];
    let geography_dataset_column = [];
    let geography_lable = [];
    let geography_clientNames = new Set();

    for (let geography in geography_news_data) {
        if (geography_news_data.hasOwnProperty(geography)) {
            console.log("geography:", geography);
            geography_lable.push(geography);
            // Collect client names
            geography_news_data[geography].forEach(news => geography_clientNames.add(news.Client_name));
        }
    }

    geography_clientNames = Array.from(geography_clientNames);
    // Create final data array
    let geography_final_data = geography_clientNames.map(clientName => {
        let counts = [];
        for (let geography in geography_news_data) {
            let geographyData = geography_news_data[geography];
            let count = geographyData
                .filter(news => news.Client_name === clientName)
                .reduce((sum, news) => sum + news.Count, 0);
            counts.push(count);
        }
        return {
            label: clientName,
            count: counts
        };
    });

    console.log("geography final data:", geography_final_data);
    function getRandomColor(opacity) {
        let r = Math.floor(Math.random() * 255);
        let g = Math.floor(Math.random() * 255);
        let b = Math.floor(Math.random() * 255);
        return {
            background: `rgba(${r}, ${g}, ${b}, ${opacity})`,
            border: `rgba(${r}, ${g}, ${b}, 1)`
        };
    }

    for (let i = 0; i < geography_final_data.length; i++) {
        let color = getRandomColor(0.1);
        geography_dataset_line.push({
            label: geography_final_data[i]['label'],
            data: geography_final_data[i]['count'],
            backgroundColor: color.background,
            borderColor: color.border,
            borderWidth: 2,
            fill: true
        });

        geography_dataset_bar.push({
            label: geography_final_data[i]['label'],
            data: geography_final_data[i]['count'],
            backgroundColor: color.background,
            borderColor: color.border,
            borderWidth: 1
        });

        geography_dataset_column.push({
            label: geography_final_data[i]['label'],
            data: geography_final_data[i]['count'],
            backgroundColor: color.background,
            borderColor: color.border,
            borderWidth: 1
        });
    }

    let geographyBarChart = new Chart(geographyBarChartCtx, {
        type: 'bar',
         data: {
            labels: geography_lable, // Corrected from 'label' to 'labels'
            datasets: geography_dataset_bar // Corrected from 'data' to 'datasets'
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let geographyLineChart = new Chart(geographyLineChartCtx, {
        type: 'line',
        data: {
            labels: geography_lable, // Corrected from 'label' to 'labels'
            datasets: geography_dataset_line // Corrected from 'data' to 'datasets'
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let geographyVerticalBarChart = new Chart(geographyVerticalBarChartCtx, {
        type: 'bar',
        data: {
            labels: geography_lable, // Corrected from 'label' to 'labels'
            datasets: geography_dataset_column // Corrected from 'data' to 'datasets'
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    function showChart5(chartId) {
        const charts = document.querySelectorAll('.chart-container-5');
        charts.forEach(chart => {
            chart.classList.remove('active');
        });
        document.getElementById(chartId).classList.add('active');
        console.log(`Showing chart: ${chartId}`);
    }

    function updateChart5(timeFrame) {
        let data = [];
        let labels = [];
        var geographyGraphDaily = <?php echo json_encode($get_quantity_compare_data); ?>;
        var geographyGraphWeekly = <?php echo json_encode($get_quantity_compare_data); ?>;
        var geographyGraphMonthly = <?php echo json_encode($get_quantity_compare_data); ?>;
        switch (timeFrame) {
            case 'daily':
                for (var i = 0; i < geographyGraphDaily.length; i++) {
                labels.push(`${geographyGraphDaily[i].label} - ${geographyGraphDaily[i].Edition}`);
                data.push(geographyGraphDaily[i].count);
            }
            break;
            case 'weekly':
                for (var i = 0; i < geographyGraphWeekly.length; i++) {
                labels.push(`${geographyGraphWeekly[i].label} - ${geographyGraphWeekly[i].Edition}`);
                data.push(geographyGraphWeekly[i].count);
            }
            break;
            case 'monthly':
                for (var i = 0; i < geographyGraphMonthly.length; i++) {
                labels.push(`${geographyGraphMonthly[i].label} - ${geographyGraphMonthly[i].Edition}`);
                data.push(geographyGraphMonthly[i].count);
            }
            break;
        }

        updateChartData5(geographyBarChart, labels, data);
        updateChartData5(geographyLineChart, labels, data);
        updateChartData5(geographyVerticalBarChart, labels, data);
        console.log(`Updated size charts for: ${timeFrame}`);
    }
    function updateChartData5(chart, labels, data) {
        // chart.data.labels = labels;
        // chart.data.datasets.forEach(dataset => {
        //     dataset.data = data;
        // });
        chart.update();
    }

    //journalist
   
    const journalistBarChartCtx = document.getElementById('journalistBarChart').getContext('2d');
    const journalistLineChartCtx = document.getElementById('journalistLineChart').getContext('2d');
    const journalistVerticalBarChartCtx = document.getElementById('journalistVerticalBarChart').getContext('2d');

    
    let Journalist_news_data = <?php echo json_encode($Journalist_data); ?>;
    let Journalist_dataset_line = [];
    let Journalist_dataset_bar = [];
    let Journalist_dataset_column = [];
    let Journalist_lable = [];
    let Journalist_clientNames = new Set();

    for (let Journalist in Journalist_news_data) {
        if (Journalist_news_data.hasOwnProperty(Journalist)) {
            console.log("Journalist:", Journalist);
            Journalist_lable.push(Journalist);
            // Collect client names
            Journalist_news_data[Journalist].forEach(news => Journalist_clientNames.add(news.Client_name));
        }
    }

    Journalist_clientNames = Array.from(Journalist_clientNames);
    // Create final data array
    let Journalist_final_data = Journalist_clientNames.map(clientName => {
        let counts = [];
        for (let Journalist in Journalist_news_data) {
            let JournalistData = Journalist_news_data[Journalist];
            let count = JournalistData
                .filter(news => news.Client_name === clientName)
                .reduce((sum, news) => sum + news.Count, 0);
            counts.push(count);
        }
        return {
            label: clientName,
            count: counts
        };
    });

    console.log("Journalist final data:", Journalist_final_data);
    function getRandomColor(opacity) {
        let r = Math.floor(Math.random() * 255);
        let g = Math.floor(Math.random() * 255);
        let b = Math.floor(Math.random() * 255);
        return {
            background: `rgba(${r}, ${g}, ${b}, ${opacity})`,
            border: `rgba(${r}, ${g}, ${b}, 1)`
        };
    }

    for (let i = 0; i < Journalist_final_data.length; i++) {
        let color = getRandomColor(0.1);
        Journalist_dataset_line.push({
            label: Journalist_final_data[i]['label'],
            data: Journalist_final_data[i]['count'],
            backgroundColor: color.background,
            borderColor: color.border,
            borderWidth: 2,
            fill: true
        });

        Journalist_dataset_bar.push({
            label: Journalist_final_data[i]['label'],
            data: Journalist_final_data[i]['count'],
            backgroundColor: color.background,
            borderColor: color.border,
            borderWidth: 1
        });

        Journalist_dataset_column.push({
            label: Journalist_final_data[i]['label'],
            data: Journalist_final_data[i]['count'],
            backgroundColor: color.background,
            borderColor: color.border,
            borderWidth: 1
        });
    }


    let journalistBarChart = new Chart(journalistBarChartCtx, {
        type: 'bar',
        data: {
            labels: Journalist_lable, // Corrected from 'label' to 'labels'
            datasets: Journalist_dataset_bar // Corrected from 'data' to 'datasets'
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let journalistLineChart = new Chart(journalistLineChartCtx, {
        type: 'line',
        data: {
            labels: Journalist_lable, // Corrected from 'label' to 'labels'
            datasets: Journalist_dataset_line // Corrected from 'data' to 'datasets'
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let journalistVerticalBarChart = new Chart(journalistVerticalBarChartCtx, {
        type: 'bar',
        data: {
            labels: Journalist_lable, // Corrected from 'label' to 'labels'
            datasets: Journalist_dataset_column // Corrected from 'data' to 'datasets'
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    function showChart6(chartId) {
        const charts = document.querySelectorAll('.chart-container-6');
        charts.forEach(chart => {
            chart.classList.remove('active');
        });
        document.getElementById(chartId).classList.add('active');
        console.log(`Showing chart: ${chartId}`);
    }

    function updateChart6(timeFrame) {
        let data = [];
        let labels = [];
        var JournalistGraphDaily = <?php echo json_encode($get_quantity_compare_data); ?>;
        var JournalistGraphWeekly = <?php echo json_encode($get_quantity_compare_data); ?>;
        var JournalistGraphMonthly = <?php echo json_encode($get_quantity_compare_data); ?>;

        switch (timeFrame) {
            case 'daily':
                for (var i = 0; i < JournalistGraphDaily.length; i++) {
                labels.push(`${JournalistGraphDaily[i].label} - ${JournalistGraphDaily[i].Journalist}`);
                data.push(JournalistGraphDaily[i].count);
            }
                break;
            case 'weekly':
                for (var i = 0; i < JournalistGraphWeekly.length; i++) {
                labels.push(`${JournalistGraphWeekly[i].label} - ${JournalistGraphWeekly[i].Journalist}`);
                data.push(JournalistGraphWeekly[i].count);
            }
                break;
            case 'monthly':
                for (var i = 0; i < JournalistGraphMonthly.length; i++) {
                labels.push(`${JournalistGraphMonthly[i].label} - ${JournalistGraphMonthly[i].Journalist}`);
                data.push(JournalistGraphMonthly[i].count);
            }
                break;
        }

        updateChartData6(journalistBarChart, labels, data);
        updateChartData6(journalistLineChart, labels, data);
        updateChartData6(journalistVerticalBarChart, labels, data);
        console.log(`Updated size charts for: ${timeFrame}`);
    }
    function updateChartData6(chart, labels, data) {
        // chart.data.labels = labels;
        // chart.data.datasets.forEach(dataset => {
        //     dataset.data = data;
        // });
        chart.update();
    }

    //AVE Charts
    const aveAreaChartCtx = document.getElementById('aveAreaChart').getContext('2d');
    const avePieChartCtx = document.getElementById('avePieChart').getContext('2d');
    const aveBarChartCtx = document.getElementById('aveBarChart').getContext('2d');
    const aveLineChartCtx = document.getElementById('aveLineChart').getContext('2d');
    const aveVerticalBarChartCtx = document.getElementById('aveVerticalBarChart').getContext('2d');

    let aveAreaChart = new Chart(aveAreaChartCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: '',
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
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let avePieChart = new Chart(avePieChartCtx, {
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
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            let dataset = tooltipItem.dataset;
                            let total = dataset.data.reduce((sum, value) => sum + value, 0);
                            let currentValue = dataset.data[tooltipItem.dataIndex];
                            let percentage = ((currentValue / total) * 100).toFixed(2);
                            return `${tooltipItem.label}: ${percentage}%`;
                        }
                    }
                }
            }
        }
    });

    let aveBarChart = new Chart(aveBarChartCtx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: '',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let aveLineChart = new Chart(aveLineChartCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: '',
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
                    beginAtZero: false,
                    min: function(context) {
                        let data = context.chart.data.datasets[0].data;
                        let minValue = Math.min(...data);
                        return minValue - (minValue / 2); // Calculate the minimum value
                    },
                    ticks: {
                        callback: function(value) {
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    let aveVerticalBarChart = new Chart(aveVerticalBarChartCtx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: '',
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
                            return value + '';
                        }
                    }
                }
            }
        }
    });

    function showChart7(chartId) {
        const charts = document.querySelectorAll('.chart-container-7');
        charts.forEach(chart => {
            chart.classList.remove('active');
        });
        document.getElementById(chartId).classList.add('active');
        console.log(`Showing chart: ${chartId}`);
    }

    function updateChart7(timeFrame) {
        let ave_data = <?php echo json_encode($ave_data); ?>;
        let labels = [];
        let data = [];

        // Extract labels and data from ave_data
        ave_data.forEach(item => {
            labels.push(item.label);
            data.push(item.ave);
        });

         console.log('Updated Labels:', labels);
        console.log('Updated Data:', data);

        switch (timeFrame) {
            case 'daily':
                labels = labels;
                data = data; 
                break;
            case 'weekly':
                labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                data = [20, 30, 10, 40]; 
                break;
            case 'monthly':
                labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                data = [30, 40, 20, 50, 60, 70, 80, 90, 100, 110, 120, 130]; 
                break;
        }

        updateChartData7(aveAreaChart, labels, data);
        updateChartData7(avePieChart, labels.slice(0, 3), data.slice(0, 3)); 
        updateChartData7(aveBarChart, labels, data);
        updateChartData7(aveLineChart, labels, data);
        updateChartData7(aveVerticalBarChart, labels, data);
        console.log(`Updated ave charts for: ${timeFrame}`);
    }
    function updateChartData7(chart, labels, data) {
        chart.data.labels = labels;
        chart.data.datasets.forEach(dataset => {
            dataset.data = data;
        });
        chart.update();
    }

    function handleChartTypeChange() {
        const selectedValue = document.getElementById('chartTypeSelector').value;
        const quantityCharts = document.querySelector('.quantity');
        const sizeCharts = document.querySelector('.size');
        const mediaCharts = document.querySelector('.media');
        const publicationCharts = document.querySelector('.publication');
        const geographyCharts = document.querySelector('.geography');
        const journalistCharts = document.querySelector('.journalist');
        const aveCharts = document.querySelector('.ave');
        if (selectedValue === 'Quantity') {
            quantityCharts.style.display = 'block';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'none';
            aveCharts.style.display = 'none';
        } else if (selectedValue === 'Size') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'block';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'none';
            aveCharts.style.display = 'none';
        } else if (selectedValue === 'Media') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'block';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'none';
            aveCharts.style.display = 'none';
        }else if (selectedValue === 'Publication') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'block';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'none';
            aveCharts.style.display = 'none';
        }else if (selectedValue === 'Geography') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'block';
            journalistCharts.style.display = 'none';
            aveCharts.style.display = 'none';
        }else if (selectedValue === 'Journalist') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'block';
            aveCharts.style.display = 'none';
        } else if(selectedValue === 'ave') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'none';
            aveCharts.style.display = 'block';
        }
    }

    updateChart('daily');
    showChart('lineChart');
    updateChart2('daily');
    showChart2('sizelineChart');
    updateChart3('daily');
    showChart3('medialineChart');
    updateChart4('daily');
    showChart4('publicationlineChart');
    updateChart5('daily');
    showChart5('geographylineChart');
    updateChart6('daily');
    showChart6('journalistlineChart');
    updateChart7('daily');
    showChart7('avelineChart');
    handleChartTypeChange();
</script>
<script>
        function getCurrentDate() {
            const date = new Date();
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        document.getElementById('to-date').value = getCurrentDate();
    </script>



