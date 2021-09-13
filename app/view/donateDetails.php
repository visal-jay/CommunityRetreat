<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Donation details</title>
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


<?php 
if(!isset($moderator)) $moderator= false;
if(!isset($treasurer)) $treasurer= false;
$organization = $admin =$registered_user = $guest_user = false;

if(isset($_SESSION ["user"] ["user_type"])){
    if($_SESSION ["user"] ["user_type"] == "organization"){
        $organization = true;
    }
    
    if($_SESSION ["user"] ["user_type"] == "admin"){
        $admin = true;
    }

    if($_SESSION ["user"] ["user_type"] == "registered_user"){
        $registered_user = true;
    }
    
}else{
    $guest_user= true;
}
?>


<body>

    <div class="<?php if($donation_status==0 && count($donations)==0){ ?>blur <?php }?>flex-center flex-col"
        id="background">
        <div class="container-size">
            <h1>Donation Details</h1>

            <div class="row container donation-capacity-container">
                <div class="column section">
                    <h4>Donation capacity</h4>
                </div>
                <div class="column section">
                    <div class="data">
                        <a><?= $donation_capacity ?></a>
                    </div>
                    <form action="/event/updateDonationCapacity?event_id=<?= $_GET["event_id"] ?>" method="post"
                        id="donation-capacity">
                        <input name="donation_capacity" type="number" value="<?= $donation_capacity ?>"
                            min="<?= $donation_sum ?>" max="10000000" class=" form form-ctrl hidden" />
                    </form>
                </div>
            </div>
            <div>
                <button class="btn btn-solid btn-md data edit-btn" onclick="edit()">Edit
                    &nbsp;&nbsp; <i class="fas fa-edit "></i></button>
                <div class="flex-row-to-col">
                    <button class=" btn btn-solid btn-md bg-red border-red form hidden close-btn" onclick="edit()">
                        Close
                        &nbsp;&nbsp;
                        <i class="fas fa-times "></i></button>
                    <button class=" btn btn-solid btn-md form hidden save-btn" type="submit"
                        form="donation-capacity">Save &nbsp; <i class="fas fa-check "></i></button>
                </div>
            </div>


            <?php if($donation_status==1){ ?>
            <form action="/event/disableDonation?event_id=<?= $_GET["event_id"] ?>" method="post"
                class=" secondary-donation-enable-disable-btn">
                <button class="btn btn-md btn-solid" id="enable-disable-btn" type="submit">Disable
                    Donations</button>
            </form>
            <?php } ?>

            <?php if($donation_status==0){ ?>
            <form action="/event/enableDonation?event_id=<?= $_GET["event_id"] ?>" method="post"
                class=" secondary-donation-enable-disable-btn">
                <button class="btn btn-md btn-solid" id="enable-disable-btn" type="submit">Enable
                    Donations</button>
            </form>
            <?php } ?>

            <div class="bold sum donation-sum-container">
                <div>Sum of Donations:</div>
                <div><?= $donation_sum ?></div>
            </div>

            <div>
                <table id="mytable" class="center">
                    <col style="width:30%">
                    <col style="width:40%">
                    <col style="width:30%">
                    <thead>
                        <tr class="headers">
                            <th class="scroll">Name</th>
                            <th>Date</th>
                            <th class="amount">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($donations as $donation){ ?>
                        <tr>
                            <td class=" scroll"><?= $donation["username"] ?></td>
                            <td><?= $donation["date"] ?></td>
                            <td class="amount"><?= $donation["amount"] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr>
            </div>

            <div class="donation-details-btn">
                <button class="btn btn-md btn-solid">Full donation details</button>
            </div>
        </div>
    </div>
    <?php if($donation_status==0 && count($donations)==0){ ?>
    <div class="initial-donation-enable-btn">
        <button class="btn btn-lg btn-solid" id="initial-donation-enable-btn" onclick="myFunction()">Enable
            Donations</button>
    </div>
    <?php } ?>
</body>

<script>
function myFunction() {
    var element = document.getElementById("background");
    element.classList.remove("blur");
    document.getElementById("initial-donation-enable-btn").remove();
    //blur class is removed when initial donation enable button s clicked
}

function hide(id) {
    document.getElementById(id).classList.toggle("hide");
    //
}

function change_enable_disable_button(id) {
    var x = document.getElementById(id);
    x.classList.toggle("enable")
    if (x.classList.contains("enable")) {
        x.innerHTML = "Enable Donations";
    } else {
        x.innerHTML = "Disable Donations";
    }
    //when enable donation button is clicked, it changes to disable donation button
    //when disable donation button is clicked, it changes to enable donation button
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
</script>

</html>