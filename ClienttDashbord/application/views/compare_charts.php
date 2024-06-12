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
    label {
    font-size: 0.8rem !important;
    margin-top: 0.5rem !important;
}
</style>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12 d-flex justify-content-end ">
                    <form method="post" action="<?php echo site_url('Home/filterGraphs'); ?>">
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
            <!-- <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="mb-4">
                        <button class="btn btn-secondary" onclick="updateChart3('daily')">Daily</button>
                        <button class="btn btn-secondary" onclick="updateChart3('weekly')">Weekly</button>
                        <button class="btn btn-secondary" onclick="updateChart3('monthly')">Monthly</button>
                    </div>
                </div>
            </div> -->
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
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="mb-4">
                        <button class="btn btn-secondary" onclick="updateChart5('daily')">Daily</button>
                        <button class="btn btn-secondary" onclick="updateChart5('weekly')">Weekly</button>
                        <button class="btn btn-secondary" onclick="updateChart5('monthly')">Monthly</button>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Geography</h6>
                    </div>
                </div>
                <div id="geographyareaChart" class="chart-container-5">
                    <canvas id="geographyAreaChart"></canvas>
                </div>
                <div id="geographypieChart" class="chart-container-5">
                    <canvas id="geographyPieChart"></canvas>
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
                <div id="geographytableChart" class="chart-container-5">
                    <canvas id="geographyTableChart"></canvas>
                </div>
                <div class="my-4">
                    <!-- <button class="btn btn-primary" onclick="showChart5('geographyareaChart')">Area Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart5('geographypieChart')">Pie Chart</button>
                    <button class="btn btn-primary" onclick="showChart5('geographybarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart5('geographylineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart5('geographyverticalBarChart')">Column Chart</button>
                    <button class="btn btn-primary" onclick="showChartTable('geographytableChart')"> Table </button>
                </div>
            </div>

            <div class="journalist">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="mb-4">
                        <button class="btn btn-secondary" onclick="updateChart6('daily')">Daily</button>
                        <button class="btn btn-secondary" onclick="updateChart6('weekly')">Weekly</button>
                        <button class="btn btn-secondary" onclick="updateChart6('monthly')">Monthly</button>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Journalist</h6>
                    </div>
                </div>
                <div id="journalistareaChart" class="chart-container-6">
                    <canvas id="journalistAreaChart"></canvas>
                </div>
                <div id="journalistpieChart" class="chart-container-6">
                    <canvas id="journalistPieChart"></canvas>
                </div>
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
                    <button class="btn btn-primary" onclick="showChart6('journalistpieChart')">Pie Chart</button>
                    <button class="btn btn-primary" onclick="showChart6('journalistbarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart6('journalistlineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart6('journalistverticalBarChart')">Column Chart</button>
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
                label: 'Revenue',
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

    let sizeVerticalBarChart = new Chart(sizeVerticalBarChartCtx, {
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
        let data, labels;

        switch (timeFrame) {
            case 'daily':
                labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                data = [12, 19, 3, 5, 2, 3, 7]; 
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

        updateChartData2(sizeAreaChart, labels, data);
        updateChartData2(sizePieChart, labels.slice(0, 3), data.slice(0, 3)); 
        updateChartData2(sizeBarChart, labels, data);
        updateChartData2(sizeLineChart, labels, data);
        updateChartData2(sizeVerticalBarChart, labels, data);
        console.log(`Updated size charts for: ${timeFrame}`);
    }
    function updateChartData2(chart, labels, data) {
        chart.data.labels = labels;
        chart.data.datasets.forEach(dataset => {
            dataset.data = data;
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

    console.log(final_data);
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


    let publicationBarChart = new Chart(publicationBarChartCtx, {
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

    let publicationLineChart = new Chart(publicationLineChartCtx, {
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

    let publicationVerticalBarChart = new Chart(publicationVerticalBarChartCtx, {
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
        chart.data.labels = labels;
        chart.data.datasets.forEach(dataset => {
            dataset.data = data;
        });
        chart.update();
    }

    //geography
    const geographyAreaChartCtx = document.getElementById('geographyAreaChart').getContext('2d');
    const geographyPieChartCtx = document.getElementById('geographyPieChart').getContext('2d');
    const geographyBarChartCtx = document.getElementById('geographyBarChart').getContext('2d');
    const geographyLineChartCtx = document.getElementById('geographyLineChart').getContext('2d');
    const geographyVerticalBarChartCtx = document.getElementById('geographyVerticalBarChart').getContext('2d');

    let geographyAreaChart = new Chart(geographyAreaChartCtx, {
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

    let geographyPieChart = new Chart(geographyPieChartCtx, {
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

    let geographyBarChart = new Chart(geographyBarChartCtx, {
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

    let geographyLineChart = new Chart(geographyLineChartCtx, {
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

    let geographyVerticalBarChart = new Chart(geographyVerticalBarChartCtx, {
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

        updateChartData5(geographyAreaChart, labels, data);
        updateChartData5(geographyPieChart, labels.slice(0, 3), data.slice(0, 3)); 
        updateChartData5(geographyBarChart, labels, data);
        updateChartData5(geographyLineChart, labels, data);
        updateChartData5(geographyVerticalBarChart, labels, data);
        console.log(`Updated size charts for: ${timeFrame}`);
    }
    function updateChartData5(chart, labels, data) {
        chart.data.labels = labels;
        chart.data.datasets.forEach(dataset => {
            dataset.data = data;
        });
        chart.update();
    }

    //journalist
    const journalistAreaChartCtx = document.getElementById('journalistAreaChart').getContext('2d');
    const journalistPieChartCtx = document.getElementById('journalistPieChart').getContext('2d');
    const journalistBarChartCtx = document.getElementById('journalistBarChart').getContext('2d');
    const journalistLineChartCtx = document.getElementById('journalistLineChart').getContext('2d');
    const journalistVerticalBarChartCtx = document.getElementById('journalistVerticalBarChart').getContext('2d');

    let journalistAreaChart = new Chart(journalistAreaChartCtx, {
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

    let journalistPieChart = new Chart(journalistPieChartCtx, {
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

    let journalistBarChart = new Chart(journalistBarChartCtx, {
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

    let journalistLineChart = new Chart(journalistLineChartCtx, {
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

    let journalistVerticalBarChart = new Chart(journalistVerticalBarChartCtx, {
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

        updateChartData6(journalistAreaChart, labels, data);
        updateChartData6(journalistPieChart, labels.slice(0, 3), data.slice(0, 3)); 
        updateChartData6(journalistBarChart, labels, data);
        updateChartData6(journalistLineChart, labels, data);
        updateChartData6(journalistVerticalBarChart, labels, data);
        console.log(`Updated size charts for: ${timeFrame}`);
    }
    function updateChartData6(chart, labels, data) {
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
        if (selectedValue === 'Quantity') {
            quantityCharts.style.display = 'block';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'none';
        } else if (selectedValue === 'Size') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'block';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'none';
        } else if (selectedValue === 'Media') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'block';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'none';
        }else if (selectedValue === 'Publication') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'block';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'none';
        }else if (selectedValue === 'Geography') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'block';
            journalistCharts.style.display = 'none';
        }else if (selectedValue === 'Journalist') {
            quantityCharts.style.display = 'none';
            sizeCharts.style.display = 'none';
            mediaCharts.style.display = 'none';
            publicationCharts.style.display = 'none';
            geographyCharts.style.display = 'none';
            journalistCharts.style.display = 'block';
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



