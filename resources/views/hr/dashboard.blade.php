@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

                <div class="card-body d-flex justify-content-between align-items-center"
                     style="background: linear-gradient(135deg, #4e73df, #36b9cc); color: white;">

                    <div>
                        <h6 class="mb-1 text-uppercase text-center">Employees</h6>
                        <h2 class="mb-0 fw-bold text-center">{{ $employeeCount }}</h2>
                    </div>

                    <div style="font-size: 40px; opacity: 0.7;">
                        👨‍💼
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

                <div class="card-body d-flex justify-content-between align-items-center"
                     style="background: linear-gradient(135deg, #1cc88a, #17a673); color: white;">

                    <div>
                        <h6 class="mb-1 text-uppercase">Departments</h6>
                        <h2 class="mb-0 fw-bold text-center">{{ $departmentCount }}</h2>
                    </div>

                    <div style="font-size: 40px; opacity: 0.7;">
                        🏢
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

                <div class="card-body d-flex justify-content-between align-items-center"
                     style="background: linear-gradient(135deg, #C9C9FF, #1AEAEAFF); color: white;">

                    <div>
                        <h6 class="mb-1 text-uppercase ">Jobs</h6>
                        <h2 class="mb-0 fw-bold text-center">{{ $jobCount }}</h2>
                    </div>

                    <div style="font-size: 40px; opacity: 0.7;">
                        💼
                    </div>

                </div>

            </div>
        </div>

    </div>

    {{--    chart--}}
    <div class="row mt-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm" style="height: 350px">
                <div class="card-header bg-primary text-white">
                    Job Type Wise Employees
                </div>
                <div class="card-body" style=" height: 350px;">
                    <canvas id="jobChart" style="width:100%;max-width:350px"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm" style="height: 350px;">
                <div class="card-header bg-primary text-white">
                    Month Wise Salary
                </div>

                <div class="card-body" style="height: 290px; position: relative;">
                    <canvas id="salaryPieChart"></canvas>
                </div>
            </div>
        </div>

{{--        <div class="col-md-4">--}}
{{--            <div class="card shadow-sm" style="height: 350px;">--}}
{{--                <div class="card-header bg-primary text-white">--}}
{{--                    Month Wise Salary--}}
{{--                </div>--}}

{{--                <div class="card-body d-flex align-items-end justify-content-center">--}}
{{--                    <canvas id="salaryPieChart" style="height: 350px;"></canvas>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-md-4">
            <div class="card shadow-sm" style="height:350px">
                <div class="card-header bg-primary text-white">
                    Department Wise Salary Last Month
                </div>

                <div class="card-body">
                    <div id="pieChart" style="width:100%; height:280px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div style="height: 10px">

    </div>

@endsection


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>

<script>
    let jobChart = null;

    // pie chart
    function jobTypeWiseEmployee() {
        $.ajax({
            url: "/hr/job-type-data",
            type: "GET",
            success: function (res) {

                let labels = res.map(item => item.job_type);
                let data = res.map(item => item.total);
                const barColors = [
                    "#b91d47",
                    "#00aba9",
                    "#2b5797",
                    "#e8c3b9",
                    "#1e7145"
                ];

                if (jobChart) jobChart.destroy();

                //let ctx = document.getElementById('jobChart').getContext('2d');
                const ctx = document.getElementById('jobChart');
                new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: labels,
                        datasets: [{
                            backgroundColor: barColors,
                            data: data
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {display: true},
                            title: {
                                display: true,
                                font: {size: 16}
                            }
                        }
                    }
                });
            }
        });
    }

    $(document).ready(function () {
        jobTypeWiseEmployee();
        setInterval(jobTypeWiseEmployee, 5000);
    });

    // bar chart chart
    let salaryChart = null;

    function monthlySalaryChart() {

        $.ajax({
            url: "/hr/job-type-data",
            type: "GET",
            success: function (res) {

                let labels = res.map(item => item.job_type);
                let values = res.map(item => item.total);

                let maxValue = Math.max(...values);

                const ctx = document.getElementById('salaryPieChart');

                // Destroy previous chart
                if (salaryChart) {
                    salaryChart.destroy();
                }

                salaryChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: [
                                "#4e73df",
                                "#1cc88a",
                                "#36b9cc",
                                "#f6c23e",
                                "#e74a3b",
                                "#858796"
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // VERY IMPORTANT
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: maxValue + 5
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });
    }

    $(document).ready(function () {
        monthlySalaryChart();
        setInterval(monthlySalaryChart, 5000);
    });


    //google Chart
    function salaryJobChart() {

        $.ajax({
            url: "/hr/job-type-data",
            type: "GET",
            success: function (res) {

                let chartData = [
                    ['Job Type', 'Employees']
                ];

                res.forEach(function (item) {
                    chartData.push([
                        item.job_type ?? ('Job ' + item.job_type),
                        Number(item.total)
                    ]);
                });

                let data = google.visualization.arrayToDataTable(chartData);

                let options = {
                    title: '',
                    pieHole: 0.5,
                    legend: {
                        position: 'bottom'
                    },
                    chartArea: {
                        width: '90%',
                        height: '80%'
                    }
                };

                let chart = new google.visualization.PieChart(
                    document.getElementById('pieChart')
                );

                chart.draw(data, options);
            }
        });
    }

    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(salaryJobChart);


</script>
