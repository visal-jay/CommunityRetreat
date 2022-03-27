<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js" charset="utf-8"></script>
    <link rel="icon" href="/Public/assets/visal logo.png" type="image/icon type">
    <title>Communityretreat</title>
</head>

<style>
    table,
    th,
    td {
        padding: 7px 10px 20px;
    }

    .table {
        width: 100%;
    }

    .full-donation-details-btn {
        margin: 25px;
    }

    .initial-donation-enable-btn {
        text-align: center;
        transform: translate(-50%, -50%);
        top: 800px;
        left: 50%;
        position: absolute;
        width: 100%;
    }

    .blur {
        filter: blur(5px);
    }

    .form-ctrl {
        margin-bottom: 0;
    }

    .overflow {
        text-align: left;
    }

    .container-size {
        width: 80%;
        text-align: center;
    }

    .form {
        text-align: center;
    }

    .amount {
        text-align: right;
    }

    .edit-btn,
    .close-btn,
    .save-btn {
        margin-block-start: 1rem;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }

    .secondary-donation-enable-disable-btn {
        margin: 10px;
    }

    .bold {
        font-weight: 700;
        align-items: center;
        display: flex;
    }

    .donation-sum-container {
        border-color: #16c79a;
        border-radius: 8px;
        background-color: #eeeeee;
        box-shadow: 2px 4px #ccbcbc;
        padding: 17px;
        text-align: center;
        margin: 20px;
        display: flex;
        justify-content: space-between;
    }

    .edit-save-btn {
        margin-left: 5px;
        margin-right: 5px;
    }

    .left {
        text-align: left;

    }

    .center {
        text-align: center;
    }

    .progress-box .box .chart {
        position: relative;
        width: 100%;
        text-align: center;
        font-size: 27px;
        font-weight: 600;
        line-height: 160px;
        height: 160 px;
        color: white;
    }

    .progress-box .box {
        display: block;
        text-align: center;
        width: 100%;
    }

    .progress-box {
        display: grid;
        grid-template-columns: repeat(1, 160px);
        justify-content: center;
        justify-items: center;
        height: 60%;
        margin-top: 10px;
    }

    .progress-box .box canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        width: 100%;
    }

    .card {
        border-radius: 8px;
        position: relative;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;

    }

    .card:before {
        content: '';
        display: block;
        width: 100%;
    }


    .card__background {
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
        background-size: 200% 200%;
        animation: gradient 15s ease infinite;
        border-radius: 8px;
        bottom: 0;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        transform-origin: center;
        transform: scale(1) translateZ(0);
        transition:
            filter 200ms linear,
            transform 200ms linear;
    }

    .card:hover .card__background {
        transform: scale(1.05) translateZ(0);
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .box {
        backdrop-filter: blur(10px);
        height: 100%;
        width: 100%;
        border-radius: 8px;
    }

    .bg-image-4 {
        background-image: url(https://thumbs.dreamstime.com/z/green-marble-abstract-acrylic-background-marbling-artwork-texture-agate-ripple-pattern-gold-powder-green-marble-abstract-acrylic-123987448.jpg);
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        grid-gap: 3rem;
        grid-auto-rows: minmax(180px, auto);
        grid-auto-flow: dense;
        padding: 1px;
        margin: 3rem;
    }

    .donation_capacity {
        color: white;
    }

    @media screen and (max-width:800px) {


        table,
        th,
        td {
            padding: 5px 8px 12px;
        }

        #table .overflow {
            overflow: scroll;
        }

        .container-size {
            width: 90%;
        }

        .initial-donation-enable-btn {
            top: 650px;
        }

        .container {
            width: 0;
            margin: auto;
        }

        .donation-capacity-container {
            display: contents;
        }

        .form {
            width: fit-content;
        }
    }

    @media screen and (max-width:400px) {
        .initial-donation-enable-btn {
            top: 600px;
        }
    }
</style>



<body>

    <div class="<?php if ($donation_status == 0 && count($donations) == 0) { ?>blur <?php } ?>flex-center flex-col" id="background">
        <div class="container-size">
            <h1>Donation Details</h1>

            <div id="container" class="grid card-grid">

                <div class="card">
                    <div class="card__background flex-col flex-center bg-image-4">
                        <div class="flex-col flex-center box">
                            <h2 class="clr-white">Donations</h2>
                            <div class="progress-box">
                                <div class="box" style="width: 60%; height: 60%;">
                                    <div class="chart flex-row flex-center" style="height: 100%;" data-percent="<?= $donation_percent ?>%"><?php echo  (int)$donation_percent ?>%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card__background flex-col flex-center bg-image-4">
                        <div class="flex-col flex-center box">
                            <h2 class="clr-white">Capacity</h2>
                            <h2 class="clr-white data"><?php echo 'Rs. ' . number_format($donation_capacity, 2) ?></h2>
                            <?php if ($status == 'published') { ?>
                                <form action="/Donations/updateDonationCapacity?event_id=<?= $_GET["event_id"] ?>" method="post" class="flex-col flex-center" id="donation-capacity">
                                    <!--enter the donation capacity and save it in the database-->
                                    <label for="" class="hidden"> </label>
                                    <input name="donation_capacity" type="number" value="<?= $donation_capacity ?>" min="<?= $donation_sum ?>" class=" form form-ctrl donation_capacity hidden" style="width: 80%;" required />
                                </form>
                                <button class="btn btn-small btn-solid data edit-btn" onclick="edit()">Edit
                                    &nbsp;&nbsp; <i class="fas fa-edit "></i></button>
                                <div class="flex-row flex-center">
                                    <div class="edit-save-btn ">
                                        <button class=" btn btn-solid bg-red border-red form hidden btn-small close-btn" onclick="edit()">Close &nbsp;&nbsp;<i class="fas fa-times "></i></button>
                                    </div>
                                    <div class="edit-save-btn">
                                        <button class=" btn btn-solid form hidden btn-small save-btn" type="submit" form="donation-capacity">Save &nbsp; <i class="fas fa-check "></i></button>
                                    </div>
                                </div>
                            <?php } else if ($status == 'ended') { ?>
                                <form action="/Donations/updateDonationCapacity?event_id=<?= $_GET["event_id"] ?>" method="post" class="flex-col flex-center" style="display: none;" id="donation-capacity">
                                    <!--enter the donation capacity and save it in the database-->
                                    <label for="" class="hidden"> </label>
                                    <input name="donation_capacity" type="number" value="<?= $donation_capacity ?>" min="<?= $donation_sum ?>" class=" form form-ctrl donation_capacity hidden" style="width: 80%;" required />
                                </form>
                                <button class="btn btn-solid data edit-btn" style="display: none;" onclick="edit()">Edit
                                    &nbsp;&nbsp; <i class="fas fa-edit "></i></button>
                                <div class="flex-row flex-center">
                                    <div class="edit-save-btn ">
                                        <button class=" btn btn-solid bg-red border-red form hidden btn-small close-btn" onclick="edit()">Close &nbsp;&nbsp;<i class="fas fa-times "></i></button>
                                    </div>
                                    <div class="edit-save-btn">
                                        <button class=" btn btn-solid form hidden btn-small save-btn" type="submit" form="donation-capacity">Save &nbsp; <i class="fas fa-check "></i></button>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if ($donation_status == 1 && $status == 'published') { ?>
                    <div class="card">
                        <div class="card__background flex-col flex-center bg-image-4">
                            <div class="flex-col flex-center box">
                                <form action="/Donations/disableDonation?event_id=<?= $_GET["event_id"] ?>" method="post" class=" secondary-donation-enable-disable-btn">
                                    <button class="btn btn-sm btn-solid" id="enable-disable-btn" type="submit">Disable
                                        Donations</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else if ($status == 'ended') { ?>
                    <div class="card" style="display:none">

                    </div>
                <?php } ?>

                <?php if ($donation_status == 0 && $status == 'published') { ?>
                    <div class="card">
                        <div class="card__background flex-col flex-center bg-image-4">
                            <div class="flex-col flex-center box">
                                <form action="/Donations/enableDonation?event_id=<?= $_GET["event_id"] ?>" method="post" class=" secondary-donation-enable-disable-btn">
                                    <button class="btn btn-sm btn-solid" id="enable-disable-btn" type="submit">Enable
                                        Donations</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else if ($status == 'ended') { ?>
                    <div class="card" style="display:none">

                    </div>
                <?php } ?>

                <div class="card">
                    <div class="card__background flex-col flex-center bg-image-4">
                        <div class="flex-col flex-center box">
                            <div class="full-donation-details-btn">
                                <!--Display the full donation details-->
                                <button class="btn btn-sm btn-solid" onclick="window.location.href=' /Donations/donationReport?event_id=<?= $_GET['event_id'] ?>'">Full
                                    donation details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="center canvas-graph">
                <canvas id="myChart"></canvas>
            </div>

            <div class="bold sum donation-sum-container">
                <!--Display the sum of donation-->
                <div>Sum of Donations:</div>
                <div> <?php echo 'Rs. ' . number_format($donation_sum, 2) ?> </div>
            </div>

            <div>
                <!--Display all the donations-->
                <table id="table" class="center table">
                    <thead>
                        <tr class="headers">
                            <th class="overflow">Name</th>
                            <th class="amount">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($donations as $donation) { ?>
                            <tr>
                                <td class="overflow"><?= $donation["username"] ?></td>
                                <td class="amount">
                                    <?php echo 'Rs. ' . number_format($donation["amount"], 2) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr>
            </div>

            <div class="flex-row flex-center">
                <ul class="pagination">
                    <li><a href="/Event/view?event_id=<?= $_GET['event_id'] ?>&&page=donations&&pageno=1"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>&nbsp;First</a></li>
                    <li class="<?php if ($pageno <= 1) {
                                    echo 'disabled';
                                } ?>">
                        <a href="<?php if ($pageno <= 1) {
                                        echo '';
                                    } else {
                                        echo "/Event/view?event_id=" . $_GET['event_id'] . "&&page=donations&&pageno=" . ($pageno - 1);
                                    } ?>"><i class="fas fa-chevron-left"></i>&nbsp;Prev</a>
                    </li>
                    <li class="<?php if ($pageno >= $total_pages) {
                                    echo 'disabled';
                                } ?>">
                        <a href="<?php if ($pageno >= $total_pages) {
                                        echo '#';
                                    } else {
                                        echo "/Event/view?event_id=" . $_GET['event_id'] . "&&page=donations&&pageno=" . ($pageno + 1);
                                    } ?>">Next&nbsp;<i class="fas fa-chevron-right"></i></a>
                    </li>
                    <li><a href="/Event/view?event_id=<?= $_GET['event_id'] ?>&&page=donations&&pageno=<?php echo $total_pages; ?>">Last&nbsp;<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></li>
                </ul>
            </div>

        </div>
    </div>
    <?php if ($donation_status == 0 && count($donations) == 0) { ?>

        <div class=" initial-donation-enable-btn">
            <!--initally enable the donations-->
            <div class="bg-white flex-col flex-center">
                <?php if ($organization) { ?>
                    <p>
                    <ul class="left">
                        <h3 class="center">Terms and Conditions</h3>
                        <li>All organizations will be allowed to collect donations and these donations will be<br> credited to a bank account owned by the CommunityRetreat.</li>
                        <li>At the end of the event, donations will be credited to the bank account belongs to<br> the Organization.</li>
                        <li>Organization is not allowed to collect donations that exceed the donation capacity.</li>
                        <li>If an Organization is removed from the system, all the donations will be refunded.</li>
                    </ul>
                    <div>
                        <input type="checkbox" min="0" name="terms" id="terms" onchange="activateButton()" required> I Agree Terms & Coditions
                    </div>
                    </p>
                <?php } ?>
            </div>
            <?php if ($have_account_number == "TRUE" && ($organization || $treasurer)) { ?>
                <button onclick="window.location.href='/Donations/enableDonation?event_id=<?= $_GET['event_id'] ?>'" class="btn btn-lg btn-solid" id="initial-donation-enable-btn" onclick='blur_background() ' >Enable Donations</button>
            <?php } else if ($have_account_number == "FALSE" && ($organization)) { ?>
                <button onclick="window.location.href='/Organisation/profile?email_Update_Err=Please+insert+bank+account+details'" class="btn btn-lg btn-solid" id="initial-donation-enable-btn" >Enable Donations</button>
            <?php } else if ($have_account_number == "FALSE" && ($treasurer)) { ?>
                <p class="clr-red"><i class='fas fa-exclamation-circle clr-red'></i>You're not authorized to enable donations</p>
            <?php } ?>
        </div>

    <?php }
    if ($donation_status == 0 && count($donations) == 0 && $status == 'ended') { ?>
        <div class=" initial-donation-enable-btn">
            <!--initally enable the donations-->
            <div class=" flex-col flex-center">
                <h2>No donations collected</h2>
            </div>
        </div>


    <?php } ?>
</body>

<script src="/Public/assets/js/input_validation.js"></script>

<script>
    function blur_background() {
        var element = document.getElementById("background");
        element.classList.remove("blur");
        document.getElementById("initial-donation-enable-btn").remove();
        /*blur class is removed when initial donation enable button s clicked*/
    }

    function change_enable_disable_button(id) {
        var x = document.getElementById(id);
        x.classList.toggle("enable");
        if (x.classList.contains("enable")) {
            x.innerHTML = "Enable Donations";
        } else {
            x.innerHTML = "Disable Donations";
        }
        /*when enable donation button is clicked, it changes to disable donation button*/
        /*when disable donation button is clicked, it changes to enable donation button*/
    }

    function edit() {
        var data = document.getElementsByClassName("data");
        var form = document.getElementsByClassName("form");
        for (var
                i = 0; i < data.length; i++) {
            data[i].classList.toggle("hidden");
        }
        for (var i = 0; i < form.length; i++) {
            form[i].classList.toggle("hidden");
        }
        /*when edit button is clicked, it is hidden*/
    }

    function activateButton() {
        document.getElementById("initial-donation-enable-btn").disabled = false;
    }
</script>


<script>
    /*send data to the graph*/
    const data = <?= $donations_graph ?>;

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
                borderColor: '#F08080',
                backgroundColor: '#FFC0CB'
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
<script type="text/javascript">
    $(function() {
        $('.chart').easyPieChart({
            barColor: "#ffffff",
            scaleLength: 0,
            lineWidth: 15,
            trackColor: "transparent",
            lineCap: "circle",
            animate: 2000,
        });
    });
</script>

</html>