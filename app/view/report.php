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
        min-height: max-content;
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
<?php include "nav.php" ?>

<body>
    <div class="background">
        <h1>Report</h1>
        <h3>Donations</h3>

        <div class="center">
            <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
        </div>
        <div class="center">
            <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>
        </div>
        <h3>Volunteers</h3>
        <div class="center">
            <canvas id="myChart2" style="width:100%;max-width:700px"></canvas>
        </div>
        <div class="center">
            <canvas id="myChart3" style="width:100%;max-width:700px"></canvas>
        </div>
    </div>
</body>

<script>
    const data = <?= $donation ?>;

    const backgroundColor = ['#6F69AC', '#FEC260', '#93B5C6', '#FA8072']
    const borderColor = ['#6F69AC80', '#FEC26080', '#93B5C680', '#FA807280']
    var keys = Object.keys(data);
    let max_keys = []
    keys.forEach(el => {
        if (Object.keys(data[el]).length > max_keys.length) {
            max_keys = Object.keys(data[el]);
        }
    })


    var myLineChart = new Chart('myChart', {
        type: 'line',
        data: {
            labels: max_keys,
            datasets: Object.keys(data).map((event, i) => ({
                label: event,
                data: Object.values(data[event]).map(n => Number(n)),
                backgroundColor: backgroundColor[i % 4],
                borderColor: borderColor[i % 4],
                fill: false
            }))

        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Amount',
                    },
                }],

                x: {
                    beginAtZero: true,
                }
            }
        }
    });
</script>

<script>
    const donation_percent = <?= $donation_percent ?>;
    var percent_keys = Object.keys(donation_percent);
    console.log(percent_keys);
    var barColors = ['#6F69AC', '#FEC260', '#93B5C6', '#FA8072']

    new Chart("myChart1", {
        type: "bar",
        data: {
            labels: Object.keys(donation_percent),
            datasets: [{
                backgroundColor: barColors,
                data: Object.values(donation_percent)
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
            }
        }
    });
</script>

<script>
    const volunteers = <?= $volunteer ?>

    var keys = Object.keys(volunteers);
    let max_keys_volunteers = []
    keys.forEach(el => {
        if (Object.keys(volunteers[el]).length > max_keys.length) {
            max_keys_volunteers = Object.keys(volunteers[el]);
        }
    })


    var myLineChart = new Chart('myChart2', {
        type: 'line',
        data: {
            labels: max_keys_volunteers,
            datasets: Object.keys(volunteers).map((event, i) => ({
                label: event,
                data: Object.values(volunteers[event]).map(n => Number(n)),
                backgroundColor: backgroundColor[i % 4],
                borderColor: borderColor[i % 4],
                fill: false
            }))

        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Volunteers',
                    },
                }]
            }
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
<?php include "footer.php" ?>

</html>