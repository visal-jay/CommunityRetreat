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
        width: 70%;
        text-align: center;
    }

    .form {
        text-align: center;
    }

    .amount {
        text-align: right;
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


    .still {
        overflow: hidden;
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

    .edit-save-btn{
        margin-left: 5px;
        margin-right: 5px;
    }

    .left{
        text-align: left;
        
    }

    .terms-and-conditions-box{
        background-color: white;
        box-shadow: 5px 5px 15px 5px #000000;
    }

    .center{
        text-align: center;
    }

@media screen and (max-width:800px) {
    .btn-lg{

    }

    table,
    th,
    td {
        padding: 5px 8px 12px;
    }

    #table .overflow {
        overflow: scroll;
    }

    .edit-btn,
    .close-btn,
    .save-btn {
        font-size: 0.9rem;
        padding: 8px;
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

    .terms-and-conditions-box{
        background-color: white;
        box-shadow: 5px 5px 15px 5px #000000;
    }
}


@media screen and (max-width:400px) {
    .initial-donation-enable-btn {
        top: 600px;
    }
}

</style>



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
                        <!--Display the donation capacity-->
                        <a><?= $donation_capacity ?></a>
                    </div>
                    <form action="/Donations/updateDonationCapacity?event_id=<?= $_GET["event_id"] ?>" method="post" class="flex-col flex-center"
                        id="donation-capacity">
                        <!--enter the donation capacity and save it in the database-->
                        <label for="" class="hidden"> </label>
                        <input name="donation_capacity" type="number" value="<?= $donation_capacity ?>"
                            min="<?= $donation_sum ?>" class=" form form-ctrl hidden" required/>
                    </form>
                </div>
            </div>
            <div>
                <button class="btn btn-solid data edit-btn" onclick="edit()">Edit
                    &nbsp;&nbsp; <i class="fas fa-edit "></i></button>
                <div class="flex-row flex-center">
                    <div class="edit-save-btn">
                        <button class=" btn btn-solid bg-red border-red form hidden close-btn" onclick="edit()">Close &nbsp;&nbsp;<i class="fas fa-times "></i></button>
                    </div>
                    <div class="edit-save-btn">
                        <button class=" btn btn-solid form hidden save-btn" type="submit" form="donation-capacity">Save &nbsp; <i class="fas fa-check "></i></button>
                    </div> 
                </div>
            </div>


            <?php if($donation_status==1){ ?>
            <form action="/Donations/disableDonation?event_id=<?= $_GET["event_id"] ?>" method="post"
                class=" secondary-donation-enable-disable-btn">
                <button class="btn btn-md btn-solid" id="enable-disable-btn" type="submit">Disable
                    Donations</button>
            </form>
            <?php } ?>

            <?php if($donation_status==0){ ?>
            <form action="/Donations/enableDonation?event_id=<?= $_GET["event_id"] ?>" method="post"
                class=" secondary-donation-enable-disable-btn">
                    <button class="btn btn-md btn-solid" id="enable-disable-btn" type="submit">Enable
                        Donations</button>
            </form>
            <?php } ?>
            <!--enable or disable donations-->

            <div class="bold sum donation-sum-container">
                <!--Display the sum of donation-->
                <div>Sum of Donations:</div>
                <div> <?php echo 'Rs. ' .number_format($donation_sum, 2) ?> </div>
            </div>

            <div>
                <!--Display all the donations-->
                <table id="table" class="center table">
                    <col style="width:30%">
                    <col style="width:40%">
                    <col style="width:30%">
                    <thead>
                        <tr class="headers">
                            <th class="overflow">Name</th>
                            <th>Date</th>
                            <th class="amount">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($donations as $donation){ ?>
                        <tr>
                            <td class="overflow"><?= $donation["username"] ?></td>
                            <td><?= $donation["date"] ?></td>
                            <td class="amount">
                                <?php echo 'Rs. ' .number_format($donation["amount"], 2)?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr>
            </div>

            <div class="full-donation-details-btn">
                <!--Display the full donation details-->
                <button class="btn btn-md btn-solid"
                    onclick="window.location.href=' /Donations/donationReport?event_id=<?= $_GET['event_id'] ?>'">Full
                    donation details</button>
            </div>

        </div>
    </div>
    <?php if($donation_status==0 && count($donations)==0){ ?>

    <div class=" initial-donation-enable-btn">
    <?php if($have_account_number == "TRUE" && ($organization || $treasurer)){?>
        <button onclick="window.location.href='/Donations/enableDonation?event_id= <?= $_GET['event_id']?>'" class="btn btn-lg btn-solid"  id="initial-donation-enable-btn" onclick='blur_background() ' disabled>Enable Donations</button> 
    <?php } else if($have_account_number == "FALSE" && ($organization)){?>
        <button onclick="window.location.href='/Organisation/profile?email_Update_Err=Please+insert+bank+account+details'" class="btn btn-lg btn-solid"  id="initial-donation-enable-btn" disabled>Enable Donations</button> 
    <?php } else if($have_account_number == "FALSE" && ($treasurer)){ ?>
            <p class="clr-red"><i class='fas fa-exclamation-circle clr-red'></i>You're not authorized to enable donations</p>
    <?php } ?>

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
                    <input type="checkbox" min="0" name="terms" id="terms" onchange="activateButton()"> I Agree Terms & Coditions
                </div>
            </p>
        <?php } ?>
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

</html>