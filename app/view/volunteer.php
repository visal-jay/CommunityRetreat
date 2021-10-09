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
    <title>Details of Volunteers</title>
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

    .donation-details-btn {
        margin: 25px;
    }

    .initial-donation-enable-btn {
        text-align: center;
        transform: translate(-50%, -50%);
        top: 110%;
        left: 50%;
        position: absolute;

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
        width: 70%;
        text-align: center;
    }

    .form {
        width: 150px;
        text-align: center;
        height: 28px;
    }

    .amount {
        text-align: right;
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

    .secondary-donation-enable-disable-btn {
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

        .container-size {
            width: 90%;
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
    }
</style>



<body>


    <div class="<?php if ($volunteer_status == 0 && count($volunteers) == 0) { ?>blur <?php } ?>flex-center flex-col" id="background">
        <div class="container-size">
            <h1>Details of Volunteers</h1>

            <div class="row container donation-capacity-container">
                <div class="column section">
                    <h4>Volunteer capacity</h4>
                </div>
                <div class="column section">
                    <table class="data">
                        <tr>
                            <td>
                                <h3>Event date</h3>
                            </td>
                            <td>
                                <h3>Capacity</h3>
                            </td>
                        </tr>
                        <tbody>
                            <?php for ($i = 0; $i < count($volunteer_capacities); $i++) {
                                echo "<tr>";
                                echo "<td>";
                                echo $volunteer_capacities[$i]['event_date'];
                                echo "</td><td>";
                                echo $volunteer_capacities[$i]['capacity'];
                                echo "</td>";
                                echo "</tr>";
                            } ?>
                        </tbody>

                    </table>
                    <form action="/Volunteer/updateVolunteerCapacity?event_id=<?= $_GET["event_id"] ?>" method="post" id="volunteer-capacity" class="flex-col flex-center">

                        <?php for ($i = 0; $i < count($volunteer_capacities); $i++) {
                            echo "<label  class='form  hidden'>";
                            echo $volunteer_capacities[$i]['event_date'];
                            echo "</label>
                            <input name='";
                            echo $i;
                            echo "' type='number' value=";
                            echo $volunteer_capacities[$i]['capacity'];
                            echo "  min=";
                            foreach ($volunteer_sum[$volunteer_capacities[$i]['event_date']] as $sum) {
                                echo $sum['volunteer_sum'];
                            }
                            echo " max='10000000' class='form form-ctrl hidden' style='margin: 0.3rem;' />";
                        } ?>
                    </form>
                </div>
            </div>
            <div>
                <button class="btn btn-solid btn-md data btn-small edit-btn" onclick="edit()">Edit &nbsp;&nbsp; <i class="fas fa-edit "></i></button>
                <div class="flex-row-to-col">
                    <div class="edit-save-btn">
                        <button class=" btn btn-solid bg-red border-red form btn-small hidden close-btn" onclick="edit()">Close &nbsp;&nbsp;<i class="fas fa-times "></i></button>
                    </div>
                    <div class="edit-save-btn">
                        <button class=" btn btn-solid form hidden save-btn btn-small" type="submit" form="volunteer-capacity">Save &nbsp; <i class="fas fa-check "></i></button>
                    </div>
                </div>
            </div>


            <?php if ($volunteer_status == 1) { ?>
                <form action="/Volunteer/disableVolunteer?event_id=<?= $_GET["event_id"] ?>" method="post" class=" secondary-donation-enable-disable-btn">
                    <button class="btn btn-md btn-solid" id="enable-disable-btn" type="submit">Disable Volunteering</button>
                </form>
            <?php } ?>

            <?php if ($volunteer_status == 0) { ?>
                <form action="/Volunteer/enableVolunteer?event_id=<?= $_GET["event_id"] ?>" method="post" class=" secondary-volunteer-enable-disable-btn">
                    <button class="btn btn-md btn-solid" id="enable-disable-btn" type="submit">Enable Volunteering</button>
                </form>
            <?php } ?>

            <form action="/Event/view?page=volunteers&event_id=<?= $_GET["event_id"] ?>" method="post">
                <label for="volunteer_date">Sort by volunteering date</label>
                <select class="form-ctrl" id="volunteer_date" required name="volunteer_date" onchange="this.form.submit()">
                    <option value="" selected>All</option>
                    <?php for ($i = 0; $i < count($volunteer_capacities); $i++) { 
                        if($volunteer_date_req ==$volunteer_capacities[$i]['event_date']) { ?>
                        <option value="<?= $volunteer_capacities[$i]['event_date'] ?>" selected><?= $volunteer_capacities[$i]['event_date'] ?></option>
                       <?php } else {  ?>
                        <option value="<?= $volunteer_capacities[$i]['event_date'] ?>"><?= $volunteer_capacities[$i]['event_date'] ?></option>
                    <?php } } ?>
                </select>
            </form>
            <div class="bold sum donation-sum-container">
                <div>Total number of Volunteers:</div>
                
                <div><?php $total_sum = 0;
                        if(!$volunteer_date_req){
                            for ($i = 0; $i < count($volunteer_capacities); $i++) {
                                foreach ($volunteer_sum[$volunteer_capacities[$i]['event_date']] as $sum) {
                                    $total_sum +=  $sum['volunteer_sum'];
                                }
                            }
                        }
                        else{
                            for ($i = 0; $i < count($volunteer_capacities); $i++) {
                                foreach ($volunteer_sum[$volunteer_capacities[$i]['event_date']] as $sum) {

                                    if($volunteer_capacities[$i]['event_date']==$volunteer_date_req)
                                    $total_sum = $sum['volunteer_sum'];
                                }
                            }
                        }
                        echo $total_sum;

                        ?></div>
            </div>

            <div>
                <table id="mytable" class="center">
                    <col style="width:40%">
                    <col style="width:40%">
                    <col style="width:20%">
                    <thead>
                        <tr class="headers">
                            <th>Name</th>
                            <th>Volunteer Date</th>
                            <th>Participation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($volunteers as $volunteer) { ?>
                            <tr>
                                <td class=" scroll"><?= $volunteer["username"] ?></td>
                                <td><?= $volunteer["volunteer_date"] ?></td>
                                <td><?php if ($volunteer["participated"] == 1) {
                                        echo '<i class="fas fa-check" style="color:green" ></i>';
                                    } else {
                                        echo '<i class="fas fa-times" style="color:red"></i>';
                                    } ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr>
            </div>

            <div class="donation-details-btn">
                <button class="btn btn-md btn-solid" onclick="window.location.href=' /Volunteer/volunteerReport?event_id=<?= $_GET['event_id'] ?>'">Full details of volunteers</button>
            </div>
            <div class="donation-details-btn popup">
                <button class="btn btn-md btn-solid" onclick="togglePopup('publish'); blur_background('background'); stillBackground('id1')">Generate QR</button>
            </div>
        </div>
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
    <?php if ($volunteer_status == 0 && count($volunteers) == 0) { ?>
        <div class="initial-donation-enable-btn">
            <button onclick="window.location.href='/Volunteer/enableVolunteer?event_id=<?= $_GET['event_id'] ?>'" class="btn btn-lg btn-solid" id="initial-volunteer-enable-btn" onclick="myFunction()">Enable Volunteers</button>
        </div>
    <?php } ?>


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

    QR_CODE.makeCode("https://communityretreat/Volunteer/volunteerValidate?event_id=<?= $_GET["event_id"] ?>");

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
</script>

</html>