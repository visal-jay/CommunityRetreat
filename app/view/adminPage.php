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
    <title>CommunityRetreat</title>
</head>

<style>
    .container {
        max-width: none;
        width: 70%;
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
        <h2 style="display:flex; justify-content: center">Volunteers</h2>
        <div class="center graph" style="text-align: center;display: flex; justify-content: center; margin:20px;">
            <canvas id="myChart1" style="display: block; height: 350px; width: 750px;"></canvas>
        </div>
        <h2 style="display:flex; justify-content: center">Donations</h2>
        <div class="center graph" style="text-align: center;display: flex; justify-content: center; margin:20px;">
            <canvas id="myChart" style="display: block; height: 350px;width: 750px;"></canvas>
        </div>

    </div>
</body>
<?php include "footer.php" ?>
<script>
    /*send donation data to the graph*/
    const data = <?= $donations_graph ?>;

    const backgroundColor = ['#6F69AC', '#FEC260', '#93B5C6', '#FA8072']
    const borderColor = ['#6F69AC80', '#FEC26080', '#93B5C680', '#FA807280']

    let keys = [];
    let amounts = [];
    for (const event in data) {
        keys.push(data[event]["day"]);
        amounts.push(data[event]["donation_sum"]);
    }

    console.log(keys, amounts);

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
                    }

                }]
            }
        }
    });
</script>

<script>
    /*send volunteer data to the graph*/
    const volunteer_data = <?= $volunteers_graph ?>;



    let volunteer_keys = [];
    let volunteers = [];
    for (const event in volunteer_data) {
        volunteer_keys.push(volunteer_data[event]["day"]);
        volunteers.push(volunteer_data[event]["volunteer_sum"]);
    }

    console.log(keys, amounts);

    var myLineChart = new Chart('myChart1', {
        type: 'line',
        data: {
            labels: volunteer_keys,
            datasets: [{
                label: 'Volunteers',
                data: volunteers,
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
                        labelString: 'Count',
                    },
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Date',
                    },
                    ticks: {
                        beginAtZero: true,
                    }

                }]
            }
        }
    });
</script>