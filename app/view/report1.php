<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title>Report</title>
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
</head>
<style>
h1,
h3 {
    text-align: center;
}

.background {
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 100%;
}

.center {
    justify-content: center;
    display: flex;
    margin-bottom: 50px;
}

@media screen and (max-width:800px) {
    canvas {
        max-width: 900px;
    }
}
</style>


<body>
    <div class="background">
        <h1>Report</h1>
        <h3>Donations</h3>

        <div class="center">
            <canvas id="myChart" style="width:100%;max-width:900px"></canvas>
        </div>
        <div class="center">
            <canvas id="myChart1" style="width:100%;max-width:900px"></canvas>
        </div>
        <h3>Volunteers</h3>
        <div class="center">
            <canvas id="myChart2" style="width:100%;max-width:900px"></canvas>
        </div>
        <div class="center">
            <canvas id="myChart3" style="width:100%;max-width:900px"></canvas>
        </div>
    </div>
</body>

<script>
var xValues = ["Jan 2020", "Feb 2020", "Mar 2020", "Apr 2020", "May 2020", "Jun 2020", "Jul 2020", "Aug 2020",
    "Sep 2020", "Oct 2020",
    "Nov 2020", "Dec 2020"
];
var yValues = [100000, 500000, 100000, 200000, 300000, 800000, 200000, 400000, 110000, 900000, 100000, 700000];

new Chart("myChart", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "#2a555e",
            borderColor: "#d3dcc8",
            data: yValues
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Amount(Rs.)',
                },
                ticks: {
                    min: 100000,
                    max: 1000000
                }
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Month',
                },

            }]
        }
    }
});
</script>

<script>
var xValues = ["event 1", "event 2", "event 3", "event 4", "event 5"];
var yValues = [20, 49, 84, 24, 90];
var barColors = ['#f6d2ac', '#e6ae74', '#d6834f', '#a35233', '#42281c'];

new Chart("myChart1", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 10,
                    max: 100,
                    callback: function(value) {
                        return (value / 100 * 100).toFixed(0) + '%'; // convert it to percentage
                    },
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Percentage',
                },
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'events',
                },

            }]
        },
    }
});
</script>

<script>
var xValues = ["Jan 2020", "Feb 2020", "Mar 2020", "Apr 2020", "May 2020", "Jun 2020", "Jul 2020", "Aug 2020",
    "Sep 2020", "Oct 2020",
    "Nov 2020", "Dec 2020"
];
var yValues = [1000, 500, 1000, 200, 300, 800, 200, 400, 110, 900, 100, 700];

new Chart("myChart2", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "#2a555e",
            borderColor: "#d3dcc8",
            data: yValues
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Volunteers',
                },
                ticks: {
                    min: 100,
                    max: 1000
                }
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Month',
                },

            }]
        }
    }
});
</script>

<script>
var xValues = ["event 1", "event 2", "event 3", "event 4", "event 5"];
var yValues = [80, 22, 58, 43, 60];
var barColors = ['#f6d2ac', '#e6ae74', '#d6834f', '#a35233', '#42281c'];

new Chart("myChart3", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 100,
                    callback: function(value) {
                        return (value / 100 * 100).toFixed(0) + '%'; // convert it to percentage
                    },
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Percentage',
                },
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'events',
                },

            }]
        },
    }
});
</script>

<script>
var volunteer_percent = <?= $volunteer_percent ?>;

new Chart("myChart3", {
    type: "bar",
    data: {
        labels: Object.keys(volunteer_percent),
        datasets: [{
            backgroundColor: barColors,
            data: Object.values(volunteer_percent)
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 100,
                    callback: function(value) {
                        return (value / 100 * 100).toFixed(0) + '%'; // convert it to percentage
                    },

                },
                scaleLabel: {
                    display: true,
                    labelString: 'Percentage',
                },

            }],
        }
    }
});
</script>

</html>