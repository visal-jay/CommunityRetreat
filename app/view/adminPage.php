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
</style>

<body>
    <header class="header">
        <div style="width: 20%;"><a class=" logo ">
                <img src="/Public/assets/visal logo.png ">
            </a>
        </div>
    </header>

    <h1>Admin</h1>
    <div style="display: flex;justify-content: center;flex-direction: column;">
        <div style="text-align:center">
            <search class="flex-row-to-col flex-center border-round">
                <form action="" class="flex-row-to-col flex-center" style="display: flex;">
                    <div class="search-bar" style="height:fit-content">
                        <input type="search" class="form-ctrl clr-white" placeholder="Search">
                        <button type="submit" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                    </div>

                </form>
            </search>
        </div>

        <div class="nav-secondary" style=" text-align:center">
            <div class="nav-secondary-bar margin-lg" style="text-align: center;">
                <a class="btn margin-side-md" style=" margin-bottom:10px;" href="">Complaints</a>
                <a class="btn margin-side-md" style=" margin-bottom:10px;" href="">System Feedbacks</a>
            </div>
        </div>
    </div>


    <div class="container">


        <div class="card-container">
            <div class="" style="font-size: 18px; display: flex; justify-content: space-between;">
                <div style="display: flex; align-items: center;"><b>Total number of Organizations:</b></div>
                <div><input type="text"
                        style="border:none; margin:10px; font-weight: bold; font-size: 18px; text-align:center" name=""
                        id="" value="17">
                </div>
            </div>
        </div>
        <div class="card-container">
            <div class="" style="font-size: 18px; display: flex; justify-content: space-between;">
                <div style="display: flex; align-items: center;"><b>Total number of Registered Users:</b></div>
                <div><input type="text"
                        style="border:none; margin:10px; font-weight: bold; font-size: 18px; text-align:center"
                        class="bold" name="" id="" value="700"></div>
            </div>
        </div>
        <div class="center" style="text-align: center;display: flex; justify-content: center;">
            <canvas id="myChart" style="max-width:800px; margin: 50px;"></canvas>
        </div>
        <div class="center" style="text-align: center;display: flex; justify-content: center;">
            <canvas id="myChart1" style="max-width:800px; margin: 50px;"></canvas>
        </div>
    </div>
</body>

<script>
var xValues = ["Jan 2020", "Feb 2020", "Mar 2020", "Apr 2020", "May 2020", "Jun 2020", "Jul 2020", "Aug 2020",
    "Sep 2020", "Oct 2020",
    "Nov 2020", "Dec 2020"
];
var yValues = [730, 810, 850, 920, 950, 980, 300, 510, 400, 500, 200, 700];

new Chart("myChart", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
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
                    labelString: 'Registered users',
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
var xValues = ["Jan 2020", "Feb 2020", "Mar 2020", "Apr 2020", "May 2020", "Jun 2020", "Jul 2020", "Aug 2020",
    "Sep 2020", "Oct 2020",
    "Nov 2020", "Dec 2020"
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
                    labelString: 'Registered users',
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