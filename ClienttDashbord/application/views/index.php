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
                <div class="col-md-12 d-flex justify-content-between ">
                <div class="div d-flex">
                        <form action="<?php echo site_url('Home/AnalyticsCharts');?>" method="post" class="d-flex" style="height:35px;">
                            <label class="px-1 font-weight-bold mt-1" for="publication_type">Select Client</label>
                                <select class="form-control" name="select_client" id="select_client" style="width:200px;">
                                    <option disbled>Select</option>
                                        <?php foreach($clients as $values){?>
                                        <option value="<?php echo $values['client_id'];?>"> <?php echo $values['client_name'];?></option>
                                        <?php }?>
                            </select>
                            &nbsp; <button type="submit" class="bg-primary border-primary text-light"> <i class="fa fa-search "></i></button>
                        </form>
                        </div>
                        <div class="d-flex">
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
            </div>
            <div class="quantity">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <div class="mb-4">
                            <button class="btn btn-secondary" onclick="updateChart('daily')">Daily</button>
                            <button class="btn btn-secondary" onclick="updateChart('weekly')">Weekly</button>
                            <button class="btn btn-secondary" onclick="updateChart('monthly')">Monthly</button>

                        </div>
                        
                    </div>
                </div>

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
                <!-- <div id="quantityShowTable" class="chart-container">
                    <canvas id="quantityTable"></canvas>
                </div> -->
                <div id="quantityShowTable" class="chart-container" style="display: none;">
                    <table id="quantityTable" style="width:100%; border: 1px solid gray;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid gray;">Day</th>
                                <th style="border: 1px solid gray;">News Count</th>
                                <th style="border: 1px solid gray;">AVE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be appended here -->
                        </tbody>
                    </table>
                </div>
                <div class="my-4">
                    <!-- <button class="btn btn-primary" onclick="showChart('areaChart')">Area Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart('pieChart')">Pie Chart</button>
                    <button class="btn btn-primary" onclick="showChart('barChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart('lineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart('verticalBarChart')">Column Chart</button>
                    <button class="btn btn-primary" onclick="showChart('quantityShowTable')">Show Table</button>

                </div>
            </div>

            <hr>
            <div class="size">

            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="mb-4">
                        <button class="btn btn-secondary" onclick="updateChart2('daily')">Daily</button>
                        <button class="btn btn-secondary" onclick="updateChart2('weekly')">Weekly</button>
                        <button class="btn btn-secondary" onclick="updateChart2('monthly')">Monthly</button>
                    </div>
                    
                </div>
            </div>
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
                <div id="sizeShowTable" class="chart-container-2" style="display: none;">
                <table id="sizeTable" style="width:100%; border: 1px solid gray;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid gray;">Category</th>
                            <!-- Month headers will be populated dynamically -->
                            <!-- Example: <th style="border: 1px solid gray;">June</th> -->
                            <!-- Example: <th style="border: 1px solid gray;">July</th> -->
                            <th style="border: 1px solid gray;">AVE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be appended here -->
                    </tbody>
                </table>
            </div>
                <div class="my-4">
                    <!-- <button class="btn btn-primary" onclick="showChart2('sizeareaChart')">Area Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart2('sizepieChart')">Pie Chart</button>
                    <button class="btn btn-primary" onclick="showChart2('sizebarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart2('sizelineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart2('sizeverticalBarChart')">Column Chart</button>
                    <button class="btn btn-primary" onclick="showChart2('sizeShowTable')">Show Table</button>
                </div>
            </div>
            <div class="media">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="mb-4">
                        <button class="btn btn-secondary" onclick="updateChart3('daily')">Daily</button>
                        <button class="btn btn-secondary" onclick="updateChart3('weekly')">Weekly</button>
                        <button class="btn btn-secondary" onclick="updateChart3('monthly')">Monthly</button>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Media</h6>
                    </div>
                </div>
                <div id="mediaareaChart" class="chart-container-3">
                    <canvas id="MediaAreaChart"></canvas>
                </div>
                <div id="mediapieChart" class="chart-container-3">
                    <canvas id="mediaPieChart"></canvas>
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
                <div id="mediaShowTable" class="chart-container-3" style="display: none;">
                <table id="mediaTable" style="width:100%; border: 1px solid gray;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid gray;">Media Type</th>
                            <!-- Month headers will be populated dynamically -->
                            <!-- Example: <th style="border: 1px solid gray;">June</th> -->
                            <!-- Example: <th style="border: 1px solid gray;">July</th> -->
                            <th style="border: 1px solid gray;">AVE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be appended here -->
                    </tbody>
                </table>
            </div>
                <div class="my-4">
                    <!-- <button class="btn btn-primary" onclick="showChart3('mediaareaChart')">Area Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart3('mediapieChart')">Stacked  Chart</button>
                    <button class="btn btn-primary" onclick="showChart3('mediabarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart3('medialineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart3('mediaverticalBarChart')">Column Chart</button>
                    <button class="btn btn-primary" onclick="showChart3('mediaShowTable')">Show Table</button>
                </div>
            </div>

            <div class="publication">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="mb-4">
                        <button class="btn btn-secondary" onclick="updateChart4('daily')">Daily</button>
                        <button class="btn btn-secondary" onclick="updateChart4('weekly')">Weekly</button>
                        <button class="btn btn-secondary" onclick="updateChart4('monthly')">Monthly</button>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-primary">Overview / Publication</h6>
                    </div>
                </div>
                <div id="publicationareaChart" class="chart-container-4">
                    <canvas id="publicationAreaChart"></canvas>
                </div>
                <div id="publicationpieChart" class="chart-container-4">
                    <canvas id="publicationPieChart"></canvas>
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
                <div id="publicationShowTable" class="chart-container-4" style="display: none;">
                <table id="publicationTable" style="width:100%; border: 1px solid gray;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid gray;">Publication</th>
                            <!-- Month headers will be populated dynamically -->
                            <!-- Example: <th style="border: 1px solid gray;">June</th> -->
                            <!-- Example: <th style="border: 1px solid gray;">July</th> -->
                            <th style="border: 1px solid gray;">AVE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be appended here -->
                    </tbody>
                </table>
            </div>
                <div class="my-4">
                    <!-- <button class="btn btn-primary" onclick="showChart4('publicationareaChart')">Area Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart4('publicationpieChart')">Stacked Chart</button>
                    <button class="btn btn-primary" onclick="showChart4('publicationbarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart4('publicationlineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart4('publicationverticalBarChart')">Column Chart</button>
                    <button class="btn btn-primary" onclick="showChart4('publicationShowTable')">Show Table</button>
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
                <!-- <div id="geographytableChart" class="chart-container-5">
                    <canvas id="geographyTableChart"></canvas>
                </div> -->
                <div id="geographyShowTable" class="chart-container-5" style="display: none;">
                <table id="geographyTable" style="width:100%; border: 1px solid gray;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid gray;">Geography</th>
                            <!-- Month headers will be populated dynamically -->
                            <!-- Example: <th style="border: 1px solid gray;">June</th> -->
                            <!-- Example: <th style="border: 1px solid gray;">July</th> -->
                            <th style="border: 1px solid gray;">AVE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be appended here -->
                    </tbody>
                </table>
            </div>
                <div class="my-4">
                    <!-- <button class="btn btn-primary" onclick="showChart5('geographyareaChart')">Area Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart5('geographypieChart')">Stacked Chart</button>
                    <button class="btn btn-primary" onclick="showChart5('geographybarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart5('geographylineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart5('geographyverticalBarChart')">Column Chart</button>
                    <button class="btn btn-primary" onclick="showChart5('geographyShowTable')">Show Table</button>
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
                <div id="journalistShowTable" class="chart-container-6" style="display: none;">
                <table id="journalistTable" style="width:100%; border: 1px solid gray;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid gray;">Journalist</th>
                            <!-- Month headers will be populated dynamically -->
                            <!-- Example: <th style="border: 1px solid gray;">June</th> -->
                            <!-- Example: <th style="border: 1px solid gray;">July</th> -->
                            <th style="border: 1px solid gray;">AVE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be appended here -->
                    </tbody>
                </table>
            </div>
                <div class="my-4">
                    <!-- <button class="btn btn-primary" onclick="showChart6('journalistareaChart')">Area Chart</button> -->
                    <button class="btn btn-primary" onclick="showChart6('journalistpieChart')">Stacked Chart</button>
                    <button class="btn btn-primary" onclick="showChart6('journalistbarChart')">Bar Chart</button>
                    <button class="btn btn-primary" onclick="showChart6('journalistlineChart')">Line Chart</button>
                    <button class="btn btn-primary" onclick="showChart6('journalistverticalBarChart')">Column Chart</button>
                    <button class="btn btn-primary" onclick="showChart6('journalistShowTable')">Show Table</button>
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
// Define quantityData with sample data structure
let quantityData = {
    daily: <?php echo json_encode($quantity_graph_daily); ?>,
    weekly: <?php echo json_encode($quantity_graph_weekly); ?>,
    monthly: <?php echo json_encode($quantity_graph_monthly); ?>
};

// Chart contexts
const areaChartCtx = document.getElementById('myAreaChart').getContext('2d');
const pieChartCtx = document.getElementById('myPieChart').getContext('2d');
const barChartCtx = document.getElementById('myBarChart').getContext('2d');
const lineChartCtx = document.getElementById('myLineChart').getContext('2d');
const verticalBarChartCtx = document.getElementById('myVerticalBarChart').getContext('2d');

// Initialize Chart.js charts
let areaChart = new Chart(areaChartCtx, {
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

    // Function to show the selected chart and populate quantity table
    function showChart(chartId) {
        const charts = document.querySelectorAll('.chart-container');
        charts.forEach(chart => {
            chart.classList.remove('active');
        });
        document.getElementById(chartId).classList.add('active');
        console.log(`Showing chart: ${chartId}`);
        
        if (chartId === 'quantityShowTable') {
            populateQuantityTable(quantityData.daily); // Adjust according to your data structure
        }
    }

    // Function to populate the quantity table with data
    function populateQuantityTable(data) {
        const tableBody = document.querySelector("#quantityTable tbody");
        tableBody.innerHTML = ""; // Clear existing data

        data.forEach(item => {
            let row = document.createElement("tr");

            let labelCell = document.createElement("td");
            labelCell.textContent = item.label || "N/A";
            labelCell.style.border = "1px solid gray"; // Adding border style
            row.appendChild(labelCell);

            let countCell = document.createElement("td");
            countCell.textContent = item.count || "N/A";
            countCell.style.border = "1px solid gray"; // Adding border style
            row.appendChild(countCell);

            let aveCell = document.createElement("td");
            aveCell.textContent = item.total_ave || "N/A";
            aveCell.style.border = "1px solid gray"; // Adding border style
            row.appendChild(aveCell);

            tableBody.appendChild(row);
        });
    }

    // Function to update all charts based on selected time frame
    function updateChart(timeFrame) {
        let data = [];
        let labels = [];
        let selectedData = quantityData[timeFrame]; // Access data based on selected time frame

        selectedData.forEach(item => {
            labels.push(item.label);
            data.push(item.count);
        });

        updateChartData(areaChart, labels, data);
        updateChartData(pieChart, labels.slice(0, 3), data.slice(0, 3)); 
        updateChartData(barChart, labels, data);
        updateChartData(lineChart, labels, data);
        updateChartData(verticalBarChart, labels, data);

        // Update the quantity table
        populateQuantityTable(selectedData);
        console.log(`Updated charts and table for: ${timeFrame}`);
    }

    // Function to update data for a given chart
    function updateChartData(chart, labels, data) {
        chart.data.labels = labels;
        chart.data.datasets.forEach(dataset => {
            dataset.data = data;
        });
        chart.update();
    }

    let sizeData = {
    daily: <?php echo json_encode($size_daily_data); ?>, 
    weekly: <?php echo json_encode($size_weekly_data); ?>,
    monthly: <?php echo json_encode($size_monthly_data); ?>
    };
    
    const sizeAreaChartCtx = document.getElementById('sizeAreaChart').getContext('2d');
    const sizePieChartCtx = document.getElementById('sizePieChart').getContext('2d');
    const sizeBarChartCtx = document.getElementById('sizeBarChart').getContext('2d');
    const sizeLineChartCtx = document.getElementById('sizeLineChart').getContext('2d');
    const sizeVerticalBarChartCtx = document.getElementById('sizeVerticalBarChart').getContext('2d')

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
                label: 'LArge',
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
            }, {
                label: 'large',
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

   function showChart2(chartId) {
    const charts = document.querySelectorAll('.chart-container-2');
    charts.forEach(chart => {
        chart.classList.remove('active');
    });

    // Hide table view
    console.log('Attempting to hide table view');
    document.getElementById('sizeShowTable').style.display = 'none';
    console.log('Hiding table view');

    // Show selected chart
    document.getElementById(chartId).classList.add('active');
    console.log(`Showing chart: ${chartId}`);

    // Update chart and table based on chartId
    if (chartId === 'sizeShowTable') {
        populateSizeTable(sizeData.daily); // Adjust according to your data structure
    }
}
 // Function to populate the quantity table with data
 function populateSizeTable(data) {
    const tableBody = document.querySelector("#sizeTable tbody");
    const tableHeader = document.querySelector("#sizeTable thead tr");

    // Clear existing headers and rows
    tableHeader.innerHTML = "";
    tableBody.innerHTML = "";

    // Initialize an object to store grouped data
    let groupedData = {};

    // Group data by category and month
    data.forEach(item => {
        if (!groupedData[item.category]) {
            groupedData[item.category] = {};
        }
        if (!groupedData[item.category][item.label]) {
            groupedData[item.category][item.label] = {
                count: 0,
                total_ave: 0
            };
        }
        groupedData[item.category][item.label].count += parseInt(item.count);
        groupedData[item.category][item.label].total_ave += parseInt(item.total_ave);
    });

    // Prepare headers for each unique month
    let uniqueMonths = [...new Set(data.map(item => item.label))];
    let headerRow = "<th style='border: 1px solid gray;'>Category</th>";
    uniqueMonths.forEach(month => {
        headerRow += `<th style='border: 1px solid gray;'>${month}</th>`;
    });
    headerRow += "<th style='border: 1px solid gray;'>AVE</th>";
    tableHeader.innerHTML = headerRow;

    // Loop through categories to populate rows
    Object.keys(groupedData).forEach(category => {
        let row = document.createElement("tr");

        let categoryCell = document.createElement("td");
        categoryCell.textContent = category || "N/A";
        categoryCell.style.border = "1px solid gray";
        row.appendChild(categoryCell);

        // Populate counts for each month
        let totalAve = 0;
        uniqueMonths.forEach(month => {
            let count = groupedData[category][month] ? groupedData[category][month].count : 0;
            let countCell = document.createElement("td");
            countCell.textContent = count;
            countCell.style.border = "1px solid gray";
            row.appendChild(countCell);
        });

        // Calculate and populate average values for each category
        uniqueMonths.forEach(month => {
            totalAve += groupedData[category][month] ? groupedData[category][month].total_ave : 0;
        });

        let aveCell = document.createElement("td");
        aveCell.textContent = totalAve;
        aveCell.style.border = "1px solid gray";
        row.appendChild(aveCell);

        tableBody.appendChild(row);
    });

    // Add a row for totals
    let totalRow = document.createElement("tr");
    let totalCell = document.createElement("td");
    totalCell.textContent = "Total";
    totalCell.style.border = "1px solid gray";
    totalRow.appendChild(totalCell);

    // Calculate totals across all months
    uniqueMonths.forEach(month => {
        let totalMonthCount = 0;
        data.forEach(item => {
            if (item.label === month) {
                totalMonthCount += parseInt(item.count);
            }
        });

        let totalMonthCell = document.createElement("td");
        totalMonthCell.textContent = totalMonthCount;
        totalMonthCell.style.border = "1px solid gray";
        totalRow.appendChild(totalMonthCell);
    });

    // Calculate total average across all months
    let totalAve = 0;
    data.forEach(item => {
        totalAve += parseInt(item.total_ave);
    });

    let totalAveCell = document.createElement("td");
    totalAveCell.textContent = totalAve;
    totalAveCell.style.border = "1px solid gray";
    totalRow.appendChild(totalAveCell);

    tableBody.appendChild(totalRow);
}
    function updateChart2(timeFrame) {
      
      var size_daily_data = <?php echo json_encode($size_daily_data); ?>;
      var size_weekly_data = <?php echo json_encode($size_weekly_data); ?>;
      var size_monthly_data = <?php echo json_encode($size_monthly_data); ?>;

      let labels = [];
      let data = [
          [], // For 'small'
          [], // For 'medium'
          [], // For 'large'
      ];
      let selectedData = sizeData[timeFrame]; // Access data based on selected time frame

        selectedData.forEach(item => {
            labels.push(item.label);
            data.push(item.count);
        });
      switch (timeFrame) {
            case 'daily':
                size_daily_data.forEach(item => {
                    if (!labels.includes(item.label)) {
                        labels.push(item.label);
                    }
                });

                labels.forEach(label => {
                    // Find the counts for each category (small, medium, large) for the current label
                    let smallCount = 0, mediumCount = 0, largeCount = 0;

                    size_daily_data.forEach(item => {
                        if (item.label === label) {
                            if (item.category === 'small') smallCount = item.count;
                            else if (item.category === 'medium') mediumCount = item.count;
                            else if (item.category === 'large') largeCount = item.count;
                        }
                    });

                    data[0].push(smallCount);
                    data[1].push(mediumCount);
                    data[2].push(largeCount);
                });

                labels = labels;
                data = data; 
                break;
            case 'weekly':
                size_weekly_data.forEach(item => {
                    if (!labels.includes(item.label)) {
                        labels.push(item.label);
                    }
                });

                labels.forEach(label => {
                    // Find the counts for each category (small, medium, large) for the current label
                    let smallCount = 0, mediumCount = 0, largeCount = 0;

                    size_weekly_data.forEach(item => {
                        if (item.label === label) {
                            if (item.category === 'small') smallCount = item.count;
                            else if (item.category === 'medium') mediumCount = item.count;
                            else if (item.category === 'large') largeCount = item.count;
                        }
                    });

                    data[0].push(smallCount);
                    data[1].push(mediumCount);
                    data[2].push(largeCount);
                });

                labels = labels;
                data = data; 
                break;
            case 'monthly':
                size_monthly_data.forEach(item => {
                    if (!labels.includes(item.label)) {
                        labels.push(item.label);
                    }
                });

                labels.forEach(label => {
                    // Find the counts for each category (small, medium, large) for the current label
                    let smallCount = 0, mediumCount = 0, largeCount = 0;

                    size_monthly_data.forEach(item => {
                        if (item.label === label) {
                            if (item.category === 'small') smallCount = item.count;
                            else if (item.category === 'medium') mediumCount = item.count;
                            else if (item.category === 'large') largeCount = item.count;
                        }
                    });

                    data[0].push(smallCount);
                    data[1].push(mediumCount);
                    data[2].push(largeCount);
                });

                labels = labels;
                data = data; 
                break;
        }
        updateChartData2(sizeAreaChart, labels, data);
        updateChartData2(sizePieChart, labels.slice(0, 3), data.slice(0, 3)); 
        updateChartData2(sizeBarChart, labels, data);
        updateChartData2(sizeLineChart, labels, data);
        updateChartData2(sizeVerticalBarChart, labels, data);
        console.log(`Updated size charts for: ${timeFrame}`);

        populateSizeTable(selectedData);
        console.log(`Updated charts and table for: ${timeFrame}`);
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
  let mediaData = {
    daily: <?php echo json_encode($media_graph_daily); ?>, 
    weekly: <?php echo json_encode($media_graph_weekly); ?>,
    monthly: <?php echo json_encode($media_graph_monthly); ?>
};

const mediaAreaChartCtx = document.getElementById('MediaAreaChart').getContext('2d');
const mediaPieChartCtx = document.getElementById('mediaPieChart').getContext('2d');
const mediaBarChartCtx = document.getElementById('mediaBarChart').getContext('2d');
const mediaLineChartCtx = document.getElementById('mediaLineChart').getContext('2d');
const mediaVerticalBarChartCtx = document.getElementById('mediaVerticalBarChart').getContext('2d');

let MediaAreaChart = new Chart(mediaAreaChartCtx, {
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

let mediaPieChart = new Chart(mediaPieChartCtx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [
            {
                label: '',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            },
            {
                label: '',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                stacked: true,
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    }
                }
            },
            x: {
                stacked: true
            }
        }
    }
});

let mediaBarChart = new Chart(mediaBarChartCtx, {
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

let mediaLineChart = new Chart(mediaLineChartCtx, {
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

let mediaVerticalBarChart = new Chart(mediaVerticalBarChartCtx, {
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

function showChart3(chartId) {
    const charts = document.querySelectorAll('.chart-container-3');
    charts.forEach(chart => {
        chart.classList.remove('active');
    });
    document.getElementById(chartId).classList.add('active');
    console.log(`Showing chart: ${chartId}`);
    if (chartId === 'mediaShowTable') {
        populateMediaTable(mediaData.daily); // Adjust according to your data structure
    }
}

function populateMediaTable(data) {
    const tableBody = document.querySelector("#mediaTable tbody");
    const tableHeader = document.querySelector("#mediaTable thead tr");

    // Clear existing headers and rows
    tableHeader.innerHTML = "";
    tableBody.innerHTML = "";

    // Initialize an object to store grouped data
    let groupedData = {};

    // Group data by category and month
    data.forEach(item => {
        if (!groupedData[item.MediaType]) {
            groupedData[item.MediaType] = {};
        }
        if (!groupedData[item.MediaType][item.label]) {
            groupedData[item.MediaType][item.label] = {
                count: 0,
                total_ave: 0
            };
        }
        groupedData[item.MediaType][item.label].count += parseInt(item.count);
        groupedData[item.MediaType][item.label].total_ave += parseInt(item.total_ave);
    });

    // Prepare headers for each unique month
    let uniqueMonths = [...new Set(data.map(item => item.label))];
    let headerRow = "<th style='border: 1px solid gray;'>Media Type</th>";
    uniqueMonths.forEach(month => {
        headerRow += `<th style='border: 1px solid gray;'>${month}</th>`;
    });
    headerRow += "<th style='border: 1px solid gray;'>AVE</th>";
    tableHeader.innerHTML = headerRow;

    // Loop through categories to populate rows
    Object.keys(groupedData).forEach(MediaType => {
        let row = document.createElement("tr");

        let MediaTypeCell = document.createElement("td");
        MediaTypeCell.textContent = MediaType || "N/A";
        MediaTypeCell.style.border = "1px solid gray";
        row.appendChild(MediaTypeCell);

        // Populate counts for each month
        let totalAve = 0;
        uniqueMonths.forEach(month => {
            let count = groupedData[MediaType][month] ? groupedData[MediaType][month].count : 0;
            let countCell = document.createElement("td");
            countCell.textContent = count;
            countCell.style.border = "1px solid gray";
            row.appendChild(countCell);
        });

        // Calculate and populate average values for each category
        uniqueMonths.forEach(month => {
            totalAve += groupedData[MediaType][month] ? groupedData[MediaType][month].total_ave : 0;
        });

        let aveCell = document.createElement("td");
        aveCell.textContent = totalAve;
        aveCell.style.border = "1px solid gray";
        row.appendChild(aveCell);

        tableBody.appendChild(row);
    });

    // Add a row for totals
    let totalRow = document.createElement("tr");
    let totalCell = document.createElement("td");
    totalCell.textContent = "Total";
    totalCell.style.border = "1px solid gray";
    totalRow.appendChild(totalCell);

    // Calculate totals across all months
    uniqueMonths.forEach(month => {
        let totalMonthCount = 0;
        data.forEach(item => {
            if (item.label === month) {
                totalMonthCount += parseInt(item.count);
            }
        });

        let totalMonthCell = document.createElement("td");
        totalMonthCell.textContent = totalMonthCount;
        totalMonthCell.style.border = "1px solid gray";
        totalRow.appendChild(totalMonthCell);
    });

    // Calculate total average across all months
    let totalAve = 0;
    data.forEach(item => {
        totalAve += parseInt(item.total_ave);
    });

    let totalAveCell = document.createElement("td");
    totalAveCell.textContent = totalAve;
    totalAveCell.style.border = "1px solid gray";
    totalRow.appendChild(totalAveCell);

    tableBody.appendChild(totalRow);
}

function updateChart3(timeFrame) {
    let data = [];
    let labels = [];
    let selectedData = mediaData[timeFrame]; // Access data based on selected time frame

    selectedData.forEach(item => {
        labels.push(item.label);
        data.push(item.count);
    });

    switch (timeFrame) {
        case 'daily':
            labels = [];
            data = [];
            for (var i = 0; i < mediaData.daily.length; i++) {
                labels.push(`${mediaData.daily[i].label} - ${mediaData.daily[i].MediaType}`);
                data.push(mediaData.daily[i].count);
            }
            break;
        case 'weekly':
            labels = [];
            data = [];
            for (var i = 0; i < mediaData.weekly.length; i++) {
                labels.push(`${mediaData.weekly[i].label} - ${mediaData.weekly[i].MediaType}`);
                data.push(mediaData.weekly[i].count);
            }
            break;
        case 'monthly':
            labels = [];
            data = [];
            for (var i = 0; i < mediaData.monthly.length; i++) {
                labels.push(`${mediaData.monthly[i].label} - ${mediaData.monthly[i].MediaType}`);
                data.push(mediaData.monthly[i].count);
            }
            break;
    }

    updateChartData3(MediaAreaChart, labels, data);
    updateChartData3(mediaPieChart, labels.slice(0, 3), data.slice(0, 3)); 
    updateChartData3(mediaBarChart, labels, data);
    updateChartData3(mediaLineChart, labels, data);
    updateChartData3(mediaVerticalBarChart, labels, data);
    console.log(`Updated size charts for: ${timeFrame}`);
    populateMediaTable(selectedData);
    console.log(`Updated charts and table for: ${timeFrame}`);
}

function updateChartData3(chart, labels, data) {
    chart.data.labels = labels;
    chart.data.datasets.forEach(dataset => {
        dataset.data = data;
    });
    chart.update();
}

//Publication
let publicationData = {
    daily: <?php echo json_encode($publication_graph_daily); ?>, 
    weekly: <?php echo json_encode($publication_graph_weekly); ?>,
    monthly: <?php echo json_encode($publication_graph_monthly); ?>
};

const publicationAreaChartCtx = document.getElementById('publicationAreaChart').getContext('2d');
const publicationPieChartCtx = document.getElementById('publicationPieChart').getContext('2d');
const publicationBarChartCtx = document.getElementById('publicationBarChart').getContext('2d');
const publicationLineChartCtx = document.getElementById('publicationLineChart').getContext('2d');
const publicationVerticalBarChartCtx = document.getElementById('publicationVerticalBarChart').getContext('2d');

let publicationAreaChart = new Chart(publicationAreaChartCtx, {
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

let publicationPieChart = new Chart(publicationPieChartCtx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [
            {
                label: '',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            },
            {
                label: '',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                stacked: true,
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    }
                }
            },
            x: {
                stacked: true
            }
        }
    }
});

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
    if (chartId === 'publicationShowTable') {
        populatePublicationTable(publicationData.daily); // Adjust according to your data structure
    }
    console.log(`Showing chart: ${chartId}`);
}

function populatePublicationTable(data) {
    const tableBody = document.querySelector("#publicationTable tbody");
    const tableHeader = document.querySelector("#publicationTable thead tr");

    // Clear existing headers and rows
    tableHeader.innerHTML = "";
    tableBody.innerHTML = "";

    // Initialize an object to store grouped data
    let groupedData = {};

    // Group data by category and month
    data.forEach(item => {
        if (!groupedData[item.MediaOutlet]) {
            groupedData[item.MediaOutlet] = {};
        }
        if (!groupedData[item.MediaOutlet][item.label]) {
            groupedData[item.MediaOutlet][item.label] = {
                count: 0,
                total_ave: 0
            };
        }
        groupedData[item.MediaOutlet][item.label].count += parseInt(item.count);
        groupedData[item.MediaOutlet][item.label].total_ave += parseInt(item.total_ave);
    });

    // Prepare headers for each unique month
    let uniqueMonths = [...new Set(data.map(item => item.label))];
    let headerRow = "<th style='border: 1px solid gray;'>Media Outlet</th>";
    uniqueMonths.forEach(month => {
        headerRow += `<th style='border: 1px solid gray;'>${month}</th>`;
    });
    headerRow += "<th style='border: 1px solid gray;'>AVE</th>";
    tableHeader.innerHTML = headerRow;

    // Loop through categories to populate rows
    Object.keys(groupedData).forEach(MediaOutlet => {
        let row = document.createElement("tr");

        let MediaOutletCell = document.createElement("td");
        MediaOutletCell.textContent = MediaOutlet || "N/A";
        MediaOutletCell.style.border = "1px solid gray";
        row.appendChild(MediaOutletCell);

        // Populate counts for each month
        let totalAve = 0;
        uniqueMonths.forEach(month => {
            let count = groupedData[MediaOutlet][month] ? groupedData[MediaOutlet][month].count : 0;
            let countCell = document.createElement("td");
            countCell.textContent = count;
            countCell.style.border = "1px solid gray";
            row.appendChild(countCell);
        });

        // Calculate and populate average values for each category
        uniqueMonths.forEach(month => {
            totalAve += groupedData[MediaOutlet][month] ? groupedData[MediaOutlet][month].total_ave : 0;
        });

        let aveCell = document.createElement("td");
        aveCell.textContent = totalAve;
        aveCell.style.border = "1px solid gray";
        row.appendChild(aveCell);

        tableBody.appendChild(row);
    });

    // Add a row for totals
    let totalRow = document.createElement("tr");
    let totalCell = document.createElement("td");
    totalCell.textContent = "Total";
    totalCell.style.border = "1px solid gray";
    totalRow.appendChild(totalCell);

    // Calculate totals across all months
    uniqueMonths.forEach(month => {
        let totalMonthCount = 0;
        data.forEach(item => {
            if (item.label === month) {
                totalMonthCount += parseInt(item.count);
            }
        });

        let totalMonthCell = document.createElement("td");
        totalMonthCell.textContent = totalMonthCount;
        totalMonthCell.style.border = "1px solid gray";
        totalRow.appendChild(totalMonthCell);
    });

    // Calculate total average across all months
    let totalAve = 0;
    data.forEach(item => {
        totalAve += parseInt(item.total_ave);
    });

    let totalAveCell = document.createElement("td");
    totalAveCell.textContent = totalAve;
    totalAveCell.style.border = "1px solid gray";
    totalRow.appendChild(totalAveCell);

    tableBody.appendChild(totalRow);
}

function updateChart4(timeFrame) {
    let data = [];
    let labels = [];
    let selectedData = publicationData[timeFrame]; // Access data based on selected time frame

    selectedData.forEach(item => {
        labels.push(`${item.label} - ${item.MediaOutlet}`);
        data.push(item.count);
    });

    updateChartData4(publicationAreaChart, labels, data);
    updateChartData4(publicationPieChart, labels.slice(0, 3), data.slice(0, 3)); 
    updateChartData4(publicationBarChart, labels, data);
    updateChartData4(publicationLineChart, labels, data);
    updateChartData4(publicationVerticalBarChart, labels, data);
    console.log(`Updated publication charts for: ${timeFrame}`);
    populatePublicationTable(selectedData);
    console.log(`Updated charts and table for: ${timeFrame}`);
}

function updateChartData4(chart, labels, data) {
    chart.data.labels = labels;
    chart.data.datasets.forEach(dataset => {
        dataset.data = data;
    });
    chart.update();
}

    //geography
    let geographyData = {
    daily: <?php echo json_encode($geography_graph_daily); ?>, 
    weekly: <?php echo json_encode($geography_graph_weekly); ?>,
    monthly: <?php echo json_encode($geography_graph_monthly); ?>
};

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
    type: 'bar',
    data: {
        labels: [],
        datasets: [
            {
                label: '',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            },
            {
                label: '',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                stacked: true,
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    }
                }
            },
            x: {
                stacked: true
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

function showChart5(chartId) {
    const charts = document.querySelectorAll('.chart-container-5');
    charts.forEach(chart => {
        chart.classList.remove('active');
    });
    document.getElementById(chartId).classList.add('active');
    console.log(`Showing chart: ${chartId}`);
    if (chartId === 'geographyShowTable') {
        populateGeographyTable(geographyData.daily); // Adjust according to your data structure geographyTable
    }
}

function populateGeographyTable(data) {
    const tableBody = document.querySelector("#geographyTable tbody");
    const tableHeader = document.querySelector("#geographyTable thead tr");

    // Clear existing headers and rows
    tableHeader.innerHTML = "";
    tableBody.innerHTML = "";

    // Initialize an object to store grouped data
    let groupedData = {};

    // Group data by category and month
    data.forEach(item => {
        if (!groupedData[item.Edition]) {
            groupedData[item.Edition] = {};
        }
        if (!groupedData[item.Edition][item.label]) {
            groupedData[item.Edition][item.label] = {
                count: 0,
                total_ave: 0
            };
        }
        groupedData[item.Edition][item.label].count += parseInt(item.count);
        groupedData[item.Edition][item.label].total_ave += parseInt(item.total_ave);
    });

    // Prepare headers for each unique month
    let uniqueMonths = [...new Set(data.map(item => item.label))];
    let headerRow = "<th style='border: 1px solid gray;'>Media Type</th>";
    uniqueMonths.forEach(month => {
        headerRow += `<th style='border: 1px solid gray;'>${month}</th>`;
    });
    headerRow += "<th style='border: 1px solid gray;'>AVE</th>";
    tableHeader.innerHTML = headerRow;

    // Loop through categories to populate rows
    Object.keys(groupedData).forEach(Edition => {
        let row = document.createElement("tr");

        let EditionCell = document.createElement("td");
        EditionCell.textContent = Edition || "N/A";
        EditionCell.style.border = "1px solid gray";
        row.appendChild(EditionCell);

        // Populate counts for each month
        let totalAve = 0;
        uniqueMonths.forEach(month => {
            let count = groupedData[Edition][month] ? groupedData[Edition][month].count : 0;
            let countCell = document.createElement("td");
            countCell.textContent = count;
            countCell.style.border = "1px solid gray";
            row.appendChild(countCell);
        });

        // Calculate and populate average values for each category
        uniqueMonths.forEach(month => {
            totalAve += groupedData[Edition][month] ? groupedData[Edition][month].total_ave : 0;
        });

        let aveCell = document.createElement("td");
        aveCell.textContent = totalAve;
        aveCell.style.border = "1px solid gray";
        row.appendChild(aveCell);

        tableBody.appendChild(row);
    });

    // Add a row for totals
    let totalRow = document.createElement("tr");
    let totalCell = document.createElement("td");
    totalCell.textContent = "Total";
    totalCell.style.border = "1px solid gray";
    totalRow.appendChild(totalCell);

    // Calculate totals across all months
    uniqueMonths.forEach(month => {
        let totalMonthCount = 0;
        data.forEach(item => {
            if (item.label === month) {
                totalMonthCount += parseInt(item.count);
            }
        });

        let totalMonthCell = document.createElement("td");
        totalMonthCell.textContent = totalMonthCount;
        totalMonthCell.style.border = "1px solid gray";
        totalRow.appendChild(totalMonthCell);
    });

    // Calculate total average across all months
    let totalAve = 0;
    data.forEach(item => {
        totalAve += parseInt(item.total_ave);
    });

    let totalAveCell = document.createElement("td");
    totalAveCell.textContent = totalAve;
    totalAveCell.style.border = "1px solid gray";
    totalRow.appendChild(totalAveCell);

    tableBody.appendChild(totalRow);
}

function updateChart5(timeFrame) {
    let data = [];
    let labels = [];
    let selectedData = geographyData[timeFrame]; // Access data based on selected time frame

    selectedData.forEach(item => {
        labels.push(`${item.label} - ${item.Edition}`);
        data.push(item.count);
    });

    updateChartData5(geographyAreaChart, labels, data);
    updateChartData5(geographyPieChart, labels.slice(0, 3), data.slice(0, 3)); 
    updateChartData5(geographyBarChart, labels, data);
    updateChartData5(geographyLineChart, labels, data);
    updateChartData5(geographyVerticalBarChart, labels, data);
    console.log(`Updated charts for: ${timeFrame}`);
    populateGeographyTable(selectedData);
    console.log(`Updated charts and table for: ${timeFrame}`);
}

function updateChartData5(chart, labels, data) {
    chart.data.labels = labels;
    chart.data.datasets.forEach(dataset => {
        dataset.data = data;
    });
    chart.update();
}

    //journalist
    let journalistData = {
    daily: <?php echo json_encode($Journalist_graph_daily); ?>, 
    weekly: <?php echo json_encode($Journalist_graph_weekly); ?>,
    monthly: <?php echo json_encode($Journalist_graph_monthly); ?>
};

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
    type: 'bar',
    data: {
        labels: [],
        datasets: [
            {
                label: '',
                data: [],
                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            },
            {
                label: '',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                stacked: true,
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    }
                }
            },
            x: {
                stacked: true
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
    if (chartId === 'journalistShowTable') {
        populateJournalistTable(journalistData.daily); // Adjust according to your data structure
    }
}

function populateJournalistTable(data) {
    const tableBody = document.querySelector("#journalistTable tbody");
    const tableHeader = document.querySelector("#journalistTable thead tr");

    // Clear existing headers and rows
    tableHeader.innerHTML = "";
    tableBody.innerHTML = "";

    // Initialize an object to store grouped data
    let groupedData = {};

    // Group data by category and month
    data.forEach(item => {
        if (!groupedData[item.Journalist]) {
            groupedData[item.Journalist] = {};
        }
        if (!groupedData[item.Journalist][item.label]) {
            groupedData[item.Journalist][item.label] = {
                count: 0,
                total_ave: 0
            };
        }
        groupedData[item.Journalist][item.label].count += parseInt(item.count);
        groupedData[item.Journalist][item.label].total_ave += parseInt(item.total_ave);
    });

    // Prepare headers for each unique month
    let uniqueMonths = [...new Set(data.map(item => item.label))];
    let headerRow = "<th style='border: 1px solid gray;'>Journalist</th>";
    uniqueMonths.forEach(month => {
        headerRow += `<th style='border: 1px solid gray;'>${month}</th>`;
    });
    headerRow += "<th style='border: 1px solid gray;'>AVE</th>";
    tableHeader.innerHTML = headerRow;

    // Loop through categories to populate rows
    Object.keys(groupedData).forEach(Journalist => {
        let row = document.createElement("tr");

        let MediaTypeCell = document.createElement("td");
        MediaTypeCell.textContent = Journalist || "N/A";
        MediaTypeCell.style.border = "1px solid gray";
        row.appendChild(MediaTypeCell);

        // Populate counts for each month
        let totalAve = 0;
        uniqueMonths.forEach(month => {
            let count = groupedData[Journalist][month] ? groupedData[Journalist][month].count : 0;
            let countCell = document.createElement("td");
            countCell.textContent = count;
            countCell.style.border = "1px solid gray";
            row.appendChild(countCell);
        });

        // Calculate and populate average values for each category
        uniqueMonths.forEach(month => {
            totalAve += groupedData[Journalist][month] ? groupedData[Journalist][month].total_ave : 0;
        });

        let aveCell = document.createElement("td");
        aveCell.textContent = totalAve;
        aveCell.style.border = "1px solid gray";
        row.appendChild(aveCell);

        tableBody.appendChild(row);
    });

    // Add a row for totals
    let totalRow = document.createElement("tr");
    let totalCell = document.createElement("td");
    totalCell.textContent = "Total";
    totalCell.style.border = "1px solid gray";
    totalRow.appendChild(totalCell);

    // Calculate totals across all months
    uniqueMonths.forEach(month => {
        let totalMonthCount = 0;
        data.forEach(item => {
            if (item.label === month) {
                totalMonthCount += parseInt(item.count);
            }
        });

        let totalMonthCell = document.createElement("td");
        totalMonthCell.textContent = totalMonthCount;
        totalMonthCell.style.border = "1px solid gray";
        totalRow.appendChild(totalMonthCell);
    });

    // Calculate total average across all months
    let totalAve = 0;
    data.forEach(item => {
        totalAve += parseInt(item.total_ave);
    });

    let totalAveCell = document.createElement("td");
    totalAveCell.textContent = totalAve;
    totalAveCell.style.border = "1px solid gray";
    totalRow.appendChild(totalAveCell);

    tableBody.appendChild(totalRow);
}

function updateChart6(timeFrame) {
    let data = [];
    let labels = [];
    let selectedData = journalistData[timeFrame]; // Access data based on selected time frame

    selectedData.forEach(item => {
        labels.push(item.label);
        data.push(item.count);
    });

    updateChartData6(journalistAreaChart, labels, data);
    updateChartData6(journalistPieChart, labels.slice(0, 3), data.slice(0, 3)); 
    updateChartData6(journalistBarChart, labels, data);
    updateChartData6(journalistLineChart, labels, data);
    updateChartData6(journalistVerticalBarChart, labels, data);
    console.log(`Updated charts for: ${timeFrame}`);
    populateJournalistTable(selectedData);
    console.log(`Updated charts and table for: ${timeFrame}`);
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