<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="/Libararies/qrcode/qrcode.js"></script>
    <script src="/Libararies/qrcode/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="icon" href="/Public/assets/visal logo.png" type="image/icon type">
    <title>Communityretreat</title>
</head>

<style>
    table {
        width: 100%;
    }

    table,
    th,
    td {
        padding: 7px 10px 20px;
    }

    .initial-donation-enable-btn {
        text-align: center;
        transform: translate(-50%, -50%);
        left: 50%;
        position: absolute;
        top: 110%;
        width: 100%;
    }

    .blur {
        filter: blur(5px);
    }

    .hide {
        display: hide;
    }

    .form-ctrl {
        margin-bottom: 0;
    }

    .scroll {
        text-align: left;
    }

    .container-size {
        text-align: center;
    }

    .form {
        width: 150px;
        text-align: center;
        height: 28px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .section {
        flex: 1;
    }

    .edit-btn,
    .close-btn,
    .save-btn {
        margin-block-start: 1rem;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }

    .secondary-volunteer-enable-disable-btn {
        margin: 10px;
    }

    .popup .content {
        position: fixed;
        transform: scale(0);
        z-index: 2;
        text-align: center;
        padding: 20px;
        border-radius: 8px;
        background: white;
        box-shadow: 0px 0px 11px 2px rgba(0, 0, 0, 0.93);
        z-index: 1;
        left: 50%;
        top: 50%;
        display: flex;
        flex-direction: column;
    }

    .popup .btn-close {
        position: absolute;
        right: 10px;
        top: 10px;
        width: 30px;
        height: 30px;
        color: black;
        font-size: 1.5rem;
        padding: 2px 5px 7px 5px;

    }

    .popup.active .content {
        transition: all 300ms ease-in-out;
        transform: translate(-50%, -50%);
    }

    .blurred {
        filter: blur(2px);
        overflow: hidden;
    }

    .still {
        overflow: hidden;
    }

    #qrcode {
        margin: 1rem;
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

    .close-btn,
    .save-btn {
        width: 50%;
        font-size: 0.9rem;
    }

    .canvas {
        display: -webkit-inline-box;
        width: 100%;
    }

    .capacity-div {
        width: 500px;
        align-self: center;
    }

    .grey-bar {
        border-radius: 20px;
        overflow: hidden;
        height: 20px;
        background-color: #e5e4e4;
    }

    .filled-bar {
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
        background-color: #f59b91;
        align-items: left;
        font-size: 0.9rem;
    }

    .capacity {
        border-radius: 20px;
        height: 15px;
        width: 50px;
        margin: 10px;
        text-align: center;
    }

    .bar {
        width: 80%;
    }

    .wide {
        width: 100%;
    }

    .bg-image-4 {
        background-image: url(https://wallpaperaccess.com/full/1832900.jpg);
    }

    .card:hover .card__background {
        transform: scale(1.05) translateZ(0);
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

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        grid-gap: 2rem;
        grid-auto-rows: minmax(180px, auto);
        grid-auto-flow: dense;
        padding: 1px;
        margin: 3rem;
    }

    .box {
        backdrop-filter: blur(10px);
        height: 100%;
        width: 100%;
        border-radius: 8px;
    }


    @media screen and (max-width:768px) {

        table,
        th,
        td {
            padding: 5px 8px 12px;
        }

        #mytable .scroll {
            overflow: scroll;
        }

        .edit-btn,
        .close-btn,
        .save-btn {
            font-size: 0.9rem;
        }

        .close-btn,
        .save-btn {
            padding: 8px;
        }

        .save-btn {
            padding: 8px;

        }

        .initial-donation-enable-btn {
            top: 80%;
        }

        .container {
            width: 0;
            margin: auto;
        }

        .card-container {
            align-items: flex-start;
            justify-content: left;
            flex-direction: column;
            height: fit-content;
        }

        .donation-capacity-container {
            display: contents;
        }

        .form {
            width: fit-content;
        }

        .capacity-div {
            width: 320px;
        }

        .income-expenxe-balance-container {
            display: flex;
            flex-direction: column;
            margin: 4px;
        }

        .sum {
            margin: 5px;
            justify-content: space-between;
        }
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
</style>



<body>

    <div class="<?php

                use Twig\Node\Expression\Binary\DivBinary;

                if ($volunteer_status == 0 && count($volunteers) == 0) { ?>blur <?php } ?>flex-center flex-col container-size" id="background">
        <h1>Details of Volunteers</h1>

        <div class="row container donation-capacity-container">

            <div>

                <div class="flex-row-to-col wide">

                    <div class="capacity-div">
                        <h3>Volunteer Capacity</h3>
                        <!-- capacity bars to be checked -->
                        <!-- capacity bars to be checked -->
                        <form action="/Volunteer/updateVolunteerCapacity?event_id=<?= $_GET["event_id"] ?>" method="post" id="volunteer-capacity">
                            <?php
                            $i = 0;
                            foreach ($volunteer_capacities as $capacity) {
                                echo "<div class='flex-row' style='justify-content:space-between;'>";

                                echo "<div style='min-width:fit-content'; >";
                                echo "<p>" . $capacity['event_date'] . "</p>";
                                echo "</div>";

                                echo "<div style='min-width:60%;margin:auto'>";
                                echo "<div class='grey-bar margin-md' style='min-width:40px; min-width:100px; width:" . ($capacity['capacity'] / max(max(array_column($volunteer_capacities, 'capacity')), 1) * 100) . "%'>";
                                $sum_capacity = isset($volunteer_sum[$capacity['event_date']][0]['volunteer_sum']) ? $volunteer_sum[$capacity['event_date']][0]['volunteer_sum'] : 0;
                                $filled_percentage = ($sum_capacity / ($capacity['capacity'] == 0 ? 1 : $capacity['capacity']) * 100);
                                echo "<div class='filled-bar' style='min-width:40px; width: " . ($filled_percentage > 100 ? 100 : $filled_percentage) . "%'>";
                                echo (int)$filled_percentage . "%";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";

                                echo "<div class='flex-col flex-center' style='margin:auto;'>";
                                echo "<p class='data'>" . $volunteer_capacities[$i]['capacity'] . "</p>";
                                echo "<input name='";
                                echo $i;
                                echo "' type='number' value=";
                                echo $volunteer_capacities[$i]['capacity'];
                                echo "  min=";
                                foreach ($volunteer_sum[$volunteer_capacities[$i]['event_date']] as $sum) {
                                    echo $sum['volunteer_sum'];
                                }
                                echo " max='10000000' class='capacity form form-ctrl hidden' style='margin: 0.3rem;' />";
                                $i = $i + 1;
                                echo "</div>";

                                echo "</div>";
                            }
                            ?>
                        </form>

                        <div>
                            <?php if ($status == 'published' || $status == 'added') { ?>
                                <button class="btn btn-solid btn-md data btn-small edit-btn" onclick="edit()">Edit &nbsp;&nbsp; <i class="fas fa-edit "></i></button>
                                <div class="flex-row flex-center">
                                    <div class="edit-save-btn">
                                        <button class=" btn btn-solid bg-red border-red form btn-small hidden close-btn" onclick="edit()">Close &nbsp;&nbsp;<i class="fas fa-times "></i></button>
                                    </div>
                                    <div class="edit-save-btn">
                                        <button class=" btn btn-solid form hidden save-btn btn-small" type="submit" form="volunteer-capacity">Save &nbsp; <i class="fas fa-check "></i></button>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                    </div>

                    <div class="center capacity-div margin-side-lg" style="text-align: center;">
                        <canvas class="canvas" id="myChart"></canvas>
                    </div>

                </div>

                <div class="grid">
                    <?php if ($status == 'published') { ?>
                        <div class="card">
                            <div class="card__background flex-col flex-center bg-image-4">
                                <div class="flex-col flex-center box">
                                    <?php if ($volunteer_status == 1) { ?>
                                        <form action="/Volunteer/disableVolunteer?event_id=<?= $_GET["event_id"] ?>" method="post" class=" secondary-volunteer-enable-disable-btn">
                                            <button class="btn btn-md btn-solid" id="enable-disable-btn" type="submit">Disable<br>Volunteering</button>
                                        </form>
                                    <?php } ?>
                                    <?php if ($volunteer_status == 0) { ?>
                                        <form action="/Volunteer/enableVolunteer?event_id=<?= $_GET["event_id"] ?>" method="post" class=" secondary-volunteer-enable-disable-btn">
                                            <button class="btn btn-md btn-solid" id="enable-disable-btn" type="submit">Enable<br>Volunteering</button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } else if ($status == 'ended') { ?>
                        <div class="card" style="display: none;"></div>
                    <?php } ?>

                    <div class="card">
                        <div class="card__background flex-col flex-center bg-image-4">
                            <div class="flex-col flex-center box donation-details-btn">
                                <button class="btn btn-md btn-solid" onclick="window.location.href=' /Volunteer/volunteerReport?event_id=<?= $_GET['event_id'] ?>'">Full details<br>of volunteers</button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__background flex-col flex-center bg-image-4">
                            <div class="flex-col flex-center box donation-details-btn popup">
                                <button class="btn btn-md btn-solid" onclick="togglePopup('publish'); blur_background('background'); stillBackground('id1')">Generate QR</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <?php if ($status = 'published') { ?>
        <?php if ($volunteer_status == 0 && count($volunteers) == 0) { ?>
            <div class="initial-donation-enable-btn">
                <button onclick="window.location.href='/Volunteer/enableVolunteer?event_id=<?= $_GET['event_id'] ?>'" class="btn btn-lg btn-solid" id="initial-volunteer-enable-btn" onclick="myFunction()">Enable Volunteers</button>
            </div>
        <?php } ?>
    <?php } else if ($status = 'ended') { ?>
        <div class="initial-donation-enable-btn">
            No volunteers
        </div>
    <?php } ?>
    </div>
    <div class="popup" id="publish">
        <div class="content">
            <div>
                <button class="btn-icon btn-close" onclick="togglePopup('publish'); blur_background('background'); stillBackground('id1')"><i class="fas fa-times"></i></button>
                <div id="qrcode" class="flex-col flex-center">
                </div>
                <button class="btn" onclick="printDiv()">Print QR</button>
            </div>
        </div>
    </div>

    <!-- <div class="flex-row flex-center">
        <ul class="pagination">
            <li><a href="/Event/view?event_id=<?= $_GET['event_id'] ?>&&page=volunteers"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>&nbsp;First</a></li>
            <li class="<?php if ($pageno <= 1) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($pageno <= 1) {
                                echo '';
                            } else {
                                echo "/Event/view?event_id=" . $_GET['event_id'] . "&&page=volunteers&&pageno=" . ($pageno - 1);
                            } ?>"><i class="fas fa-chevron-left"></i>&nbsp;Prev</a>
            </li>
            <li class="<?php if ($pageno >= $total_pages) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($pageno >= $total_pages) {
                                echo '';
                            } else {
                                echo "/Event/view?event_id=" . $_GET['event_id'] . "&&page=volunteers&&pageno=" . ($pageno + 1);
                            } ?>">Next&nbsp;<i class="fas fa-chevron-right"></i></a>
            </li>
            <li><a href="/Event/view?event_id=<?= $_GET['event_id'] ?>&&page=volunteers&&pageno=<?php echo $total_pages; ?>">Last&nbsp;<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></li>
        </ul>
    </div> -->

</body>


<script>
    function myFunction() {
        var element = document.getElementById("background");
        element.classList.remove("blur");
        document.getElementById("initial-volunteer-enable-btn").remove();
        //blur class is removed when initial volunteer enable button s clicked
    }

    function hide(id) {
        document.getElementById(id).classList.toggle("hide");
        //
    }

    function change_enable_disable_button(id) {
        var x = document.getElementById(id);
        x.classList.toggle("enable")
        if (x.classList.contains("enable")) {
            x.innerHTML = "Enable Volunteers";
        } else {
            x.innerHTML = "Disable Volunteers";
        }
        //when enable volunteer button is clicked, it changes to disable volunteer button
        //when disable volunteer button is clicked, it changes to enable volunteer button
    }

    function edit() {
        var data = document.getElementsByClassName("data");
        var form = document.getElementsByClassName("form");
        for (var i = 0; i < data.length; i++) {
            data[i].classList.toggle("hidden");
        }
        for (var i = 0; i < form.length; i++) {
            form[i].classList.toggle("hidden");
        }
        //when edit button is clicked, it is hidden
    }


    function togglePopup(id) {
        document.getElementById(id).classList.toggle("active");
    }

    function blur_background(id) {
        document.getElementById(id).classList.toggle("blurred");
    }

    function stillBackground(id) {
        document.getElementById(id).classList.toggle("still");
    }

    function stillBackground(id) {
        document.getElementById(id).classList.toggle("still");
    }

    function myFunction() {
        var element = document.getElementById("background");
        element.classList.remove("blur");
        document.getElementById("initial-donation-enable-btn").remove();
    }

    function hide(id) {
        document.getElementById(id).classList.toggle("hide");
    }

    function change_enable_disable_button(id) {
        var x = document.getElementById(id);
        x.classList.toggle("enable")
        if (x.classList.contains("enable")) {
            x.innerHTML = "Enable Donations";
        } else {
            x.innerHTML = "Disable Donations";
        }
    }

    function edit() {
        var data = document.getElementsByClassName("data");
        var form = document.getElementsByClassName("form");
        for (var i = 0; i < data.length; i++) {
            data[i].classList.toggle("hidden");
        }
        for (var i = 0; i < form.length; i++) {
            form[i].classList.toggle("hidden");
        }
    }

    let x = screen.width;

    function setWidth() {
        console.log("hello");
        x = screen.width;
    }

    window.addEventListener("resize", setWidth);

    var QR_CODE = new QRCode("qrcode", {
        width: x * 0.4,
        height: x * 0.4,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H,
    });

    QR_CODE.makeCode("https://communityretreat.me/Volunteer/volunteerValidate?event_id=<?= $_GET["event_id"] ?>");

    function printDiv() {
        var divContents = document.getElementById("qrcode").innerHTML;
        var a = window.open('', '', 'rel="noopener"');
        a.document.write('<html>');
        a.document.write('<body style="text-align:center" > <h1>Scan your this to mark your participation</h1><div>');
        a.document.write(divContents);
        a.document.write('</div></body></html>');
        a.document.close();
        a.print();
    }

    /*function on() {
    document.getElementById("blur").style.display = "none";
    }*/

    /*function off() {
        document.getElementById("blur").style.display = "block";
    }*/

    const data = <?= $volunteer_graph ?>;
    console.log(data);
    const backgroundColor = ['#FA8072', '#6F69AC', '#FEC260', '#93B5C6']
    const borderColor = ['#FA807280', '#6F69AC80', '#FEC26080', '#93B5C680']

    let keys = [];
    let amounts = [];
    for (const event in data) {
        keys.push(data[event]["day"]);
        amounts.push(data[event]["volunteer_sum"]);
    }

    //console.log(keys, amount);

    var myLineChart = new Chart('myChart', {
        type: 'line',
        data: {
            labels: keys,
            datasets: [{
                label: 'Volunteers',
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
                        labelString: 'Volunteers',
                        precision: 0,
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
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Date',
                    },
                    ticks: {
                        beginAtZero: true
                    }

                }]
            }
        }
    });
</script>

</html>