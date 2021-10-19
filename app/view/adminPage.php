<!DOCTYPE html>
<html lang="en" id="id1">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>About Event</title>
</head>

<style>
    search {
        width: 100%;
        max-width: 100%;
        padding: 2rem;
        box-sizing: border-box;
    }



    search input[type=search] {
        width: 90%;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    search input[type=search]:focus {
        width: 100%;
    }

    h1 {
        text-align: center;
    }

    .container {
        max-width: none;
        width: 70%;
    }

    .card-container {
        padding: 20px;
        margin: 20px;
    }

    .system-details-cards-container {
        display: flex;
        justify-content: space-evenly;
        flex-direction: row;
        padding: 5rem 0 5rem;

    }

    .system-details-cards {
        display: flex;
        height: 300px;
        justify-content: space-between;
        flex-direction: column;
        text-align: center;

    }

    .graph {
        width: 100%;
    }

    @media screen and (max-width:800px) {
        .system-details-cards-container {
            flex-direction: column;
        }

        .system-details-cards {
            height: 350px;
        }
    }
</style>
<?php include "nav.php" ?>

<body>
    <div class="system-details-cards-container">
        <div class="system-details-cards">
            <div>
                <img src="/Public/assets/org-count.jpg" style=" width: 300px; height: 200px;">
            </div>
            <h3>Total Number of Organizations</h3>
            <h2><?= $org_count ?></h2>
        </div>
        <div class="system-details-cards">
            <div>
                <img src="/Public/assets/reg-count.jpg" style=" width: 300px; height: 200px;">
            </div>
            <h3>Total Number of Registered users</h3>
            <h2><?= $reg_user_count ?></h2>
        </div>
        <div class="system-details-cards">
            <div>
                <img src="/Public/assets/event-count.jpg" style=" width: 350px; height: 200px;">
            </div>
            <h3>Total Number of Published Events</h3>
            <h2><?= $event_count ?></h2>
        </div>
    </div>

    <div class="container">
        <div class="center graph" style="text-align: center;display: flex; justify-content: center; margin:20px;">
            <canvas id="myChart1" style="display: block; height: 350px; width: 750px;"></canvas>
        </div>
        <div class="center graph" style="text-align: center;display: flex; justify-content: center; margin:20px;">
            <canvas id="myChart" style="display: block; height: 350px;width: 750px;"></canvas>
        </div>

    </div>
</body>
<?php include "footer.php" ?>
<script>
    /*send data to the graph*/
    const data = <?= $donations_graph ?>;
    console.log(data);
    const backgroundColor = ['#6F69AC', '#FEC260', '#93B5C6', '#FA8072']
    const borderColor = ['#6F69AC80', '#FEC26080', '#93B5C680', '#FA807280']

    let keys = [];
    let amounts = [];
    for (const event in data) {
        keys.push(data["day"]);
        amounts.push(data["donation_sum"]);
    }

    //console.log(keys, amount);

    var myLineChart = new Chart('myChart', {
        type: 'line',
        data: {
            labels: keys,
            datasets: [{
                label: 'Donations',
                data: amounts,
                backgroundColor: backgroundColor[0],
                borderColor: borderColor[0],
                fill: false
            }]

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
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Date',
                    },
                    ticks: {
                        beginAtZero: true,
                        userCallback: function(label, index, labels) {
                            // when the floored value is the same as the value we have a whole number
                            if (Math.floor(label) === label) {
                                return label;
                            }

                        },
                    }

                }]
            }
        }
    });
</script>

<script>
    var xValues = ["Jan 2021", "Feb 2021", "Mar 2021", "Apr 2021", "May 2021", "Jun 2021", "Jul 2021", "Aug 2021",
        "Sep 2021", "Oct 2021",
        "Nov 2021", "Dec 2021"
    ];
    var yValues = [10, 15, 11, 12, 13, 18, 20, 14, 11, 19, 10, 17];

    new Chart("myChart1", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "#4B3869",
                borderColor: "#E7E0C9",
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
                        labelString: 'Organizations',
                    },
                    ticks: {
                        min: 10,
                        max: 20
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