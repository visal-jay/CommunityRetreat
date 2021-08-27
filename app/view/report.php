<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title>Report</title>
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
</head>
<style>

    h1,h3{
        text-align: center;
    }

    .background {
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;       
    }

    .center{
        justify-content: center;
        display: flex;
        margin-bottom: 50px;
    }

    @media screen and (max-width:800px) {
        canvas{
            max-width:900px;
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
  const donations = {
    "05 Jan": [200000, 300000, 400000],         
    "08 Jan": [800000, 500000, 900000],
    "11 Jan": [500000, 850000, 450000],
    "14 Jan": [100000, 625000, 356000],
    "18 Jan": [500000, 450000, 650000],
    "23 Jan": [500000, 340000, 890000],
    "27 Jan": [1000000, 170000, 990000]
}

var myLineChart = new Chart('myChart', {
  type: 'line',
  data: {
    labels: Object.keys(donations),
    datasets: [{
        label: "Event 1",
        data: Object.values(donations).map(v => v[0]),
        backgroundColor: 'rgba(0,0,255,1.0)',
        borderColor: 'rgba(0,0,255,0.1)',
        fill: false
      },
      {
        label: "Event 2",
        data: Object.values(donations).map(v => v[1]),
        backgroundColor: 'rgb(233, 150, 122)',
        borderColor: 'rgb(250, 235, 215)',
        fill: false
      },
      {
        label: "Event 3",
        data: Object.values(donations).map(v => v[2]),
        backgroundColor: 'rgb(218, 165, 32)',
        borderColor: 'rgb(238, 232, 170)',
        fill: false
      }
    ]
  },
  options: {
    responsive: true,
    scales: {
      yAxes: [{
        ticks: {
            min: 100000,
            max: 1000000,
          stepSize: 100000
        },
        scaleLabel: {
        display: true,
        labelString: 'Amount',
      }, 
      }]
    }
  }
});
</script>

<script>
    var xValues = ["Event 1", "Event 2", "Event 3", "Event 4", "Event 5"];
    var yValues = [20, 80, 50, 90, 50];
    var barColors = ['#c6c3b3', '#ccaf9b', '#a06b39', '#873c1e', '#312921'];

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
                        callback: function (value) {
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
    const volunteers = {
    "05 Jan": [20, 35, 42],         
    "08 Jan": [83, 55, 90],
    "11 Jan": [50, 75, 82],
    "14 Jan": [10, 62, 35],
    "18 Jan": [52, 21, 36],
    "23 Jan": [15, 34, 89],
    "27 Jan": [100, 17, 99]
}

var myLineChart = new Chart('myChart2', {
  type: 'line',
  data: {
    labels: Object.keys(volunteers),
    datasets: [{
        label: "Event 1",
        data: Object.values(volunteers).map(v => v[0]),
        backgroundColor: 'rgba(0,0,255,1.0)',
        borderColor: 'rgba(0,0,255,0.1)',
        fill: false
      },
      {
        label: "Event 2",
        data: Object.values(volunteers).map(v => v[1]),
        backgroundColor: 'rgb(233, 150, 122)',
        borderColor: 'rgb(250, 235, 215)',
        fill: false
      },
      {
        label: "Event 3",
        data: Object.values(volunteers).map(v => v[2]),
        backgroundColor: 'rgb(218, 165, 32)',
        borderColor: 'rgb(238, 232, 170)',
        fill: false
      }
    ]
  },
  options: {
    responsive: true,
    scales: {
      yAxes: [{
        ticks: {
            min: 10,
            max: 100,
          stepSize: 10
        },
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
    var xValues = ["Event 1", "Event 2", "Event 3", "Event 4", "Event 5"];
    var yValues = [20, 80, 55, 92, 85];
    var barColors = ['#c6c3b3', '#ccaf9b', '#a06b39', '#873c1e', '#312921'];

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
                        min: 10,
                        max: 100,
                        callback: function (value) {
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