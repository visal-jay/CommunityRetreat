<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en" id="id1">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>About Event</title>
</head>

<style>
    .container-size {
        width: 70%;
    }

    .head-margin {
        margin: unset;
    }

    .popup .content {
        position: fixed;
        transform: scale(0);
        width: 40%;
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

    .progress {
        width: 43%;
        background: #eeeeee;
        height: 28px;
        margin: 15px;
        border-radius: 20px;
    }

    .volunteers-progress-bar,
    .donaters-progress-bar {
        width: 0;
        background: #16c79a;
        color: #fff;
        height: 28px;
        line-height: 28px;
        border-radius: 20px;
        text-align: center;
        vertical-align: middle;
    }

    .still {
        overflow: hidden;
    }



    textarea {
        height: 150px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
    }

    .form-ctrl {
        margin-bottom: 0px;
    }

    input[type="date"]::before {
        content: attr(data-placeholder);
        width: 100%;
    }

    input[type="date"]:focus::before,
    input[type="date"]:valid::before {
        display: none
    }

    input[type="time"]::before {
        content: attr(data-placeholder);
        width: 100%;
    }

    input[type="time"]:focus::before,
    input[type="time"]:valid::before {
        display: none
    }

    .icon-width {
        width: 20px;
    }

    ::placeholder {
        color: black;
        opacity: 1;
    }

    label {
        height: fit-content;
    }

    .flex-row-to-col {
        display: flex;
        flex-direction: row;
    }

    @media screen and (max-width:800px) {
        .progress {
            width: 75%;
        }



        .container-size {
            width: 90%;
        }

        .popup .content {
            width: 70%;
            height: 65vh;
            position: fixed;
            text-align: center;
            top: 50%;
            left: 50%;

        }

        .form {
            width: 100%;
        }

        .textbox {
            box-sizing: border-box;
            padding: 1rem;
        }

        .flex-row-to-col {
            flex-direction: column;
        }

    }
</style>

<?php
$_SESSION["user"]["user_type"] = "organization";

if (!isset($moderator)) $moderator = false;
if (!isset($treasurer)) $treasurer = false;
$organization = $admin = $registered_user = $guest_user = false;

if (isset($_SESSION["user"]["user_type"])) {
    if ($_SESSION["user"]["user_type"] == "organization") {
        $organization = true;
    }
    if ($_SESSION["user"]["user_type"] == "admin") {
        $$admin = true;
    }
    if ($_SESSION["user"]["user_type"] == "registered_user") {
        $registered_user = true;
    }
} else {
    $guest_user = true;
}
?>



<body>
    <div id="background">
        <div class="flex-col flex-center">
            <h1>About</h1>
            <div class="content border-round container-size margin-md" style="background-color: #eeeeee">
                <?php if ($organization || $moderator) { ?>
                    <form action="/event/updateDetails" method="post" id="update-form">
                    <?php } ?>
                    <div class="date-container">
                        <div class="flex-row margin-lg">
                            <i class="btn-icon icon-width far fa-calendar-alt clr-green margin-side-lg"></i>
                            <h4 class="head-margin data"><?= $start_date ?></h4>
                            <?php if ($organization || $moderator) { ?>
                                <div class="flex-row flex-center">
                                    <label class="form hidden margin-side-md" for="start_date">Event date</label>
                                    <input type="date" value="<?= $start_date ?>" name="start_date" class="form form-ctrl hidden" data-placeholder="Event is on?" value="<?= $start_date ?>" required></input>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="time-container">
                        <div class="flex-row margin-lg">
                            <i class="btn-icon icon-width far fa-clock clr-green margin-side-lg"></i>
                            <h4 class="head-margin data"><?= $start_time ?></h4>
                            <?php if ($organization || $moderator) { ?>
                                <div class="flex-row flex-center">
                                    <label class="form hidden margin-side-md" for="start_time">Starts at?</label>
                                    <input type="time" value="<?= $start_time ?>" name="start_time" class="form form-ctrl hidden" data-placeholder="Event starts at?" required></input>
                                    <label class="form hidden margin-side-md" for="end_time">Ends at?</label>
                                    <input type="time" value="<?= $end_time ?>" name="end_time" class="form form-ctrl hidden" data-placeholder="Event ends at?" required></input>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="time-container">
                        <div class="flex-row margin-lg">
                            <i class="btn-icon icon-width fas fa-hourglass-start clr-green margin-side-lg"></i>
                            <h4 class="head-margin"><?= $duration ?></h4>
                        </div>
                    </div>

                    <!-- Visal meka balanna input class="form"-->
                    <div class="venue-container">
                        <div class="flex-row margin-lg">
                            <i class="btn-icon icon-width fas fa-map-marker-alt clr-green margin-side-lg"></i>
                            <h4 class="head-margin data">Mount Lavinia Beach</h4>
                            <?php if ($organization || $moderator) { ?>
                                <input type="text" name="Event location" class="form-ctrl hidden" placeholder="Event is in?"></input>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="globe-container">
                        <div class="flex-row margin-lg">
                            <i class="btn-icon icon-width fas fa-globe clr-green margin-side-lg"></i>
                            <h4 class="head-margin data"><?= $mode ?></h4>
                            <?php if ($organization || $moderator) { ?>
                                <div class="form hidden">
                                    <div class="flex-row flex-center">
                                        <label class="form hidden margin-side-md" for="mode">Event mode</label>
                                        <select name="mode" class="form-ctrl" id="mode" required>
                                            <option value="<?= $mode ?>" selected><?= $mode ?></option>
                                            <?php $options = ["Physical", "Virtual", "Physical & Virtual"];
                                            foreach ($options as $option) {
                                                if ($option != $mode) { ?>
                                                    <option value="<?= $option ?>"><?= $option ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="flag-container">
                        <div class="flex-row margin-lg">
                            <i class="btn-icon icon-width far fa-flag clr-green margin-side-lg"></i>
                            <div class="flex-row">
                                <p class="head-margin">Event by <b><?= $organisation_username ?></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="human-container">
                        <div class="flex-row margin-lg">
                            <i class="btn-icon icon-width fas fa-user-friends clr-green margin-side-lg"></i>
                            <h4 class="head-margin"><?= $volunteered ?> people volunteered</h4>
                        </div>
                    </div>

                    <div class="human-container">
                        <div class="flex-row margin-lg">
                            <i class="btn-icon icon-width fas fa-hand-holding-usd clr-green margin-side-lg"></i>
                            <h4 class="head-margin"><?= $donations ?> people donated</h4>
                        </div>
                    </div>

                    <div class="textbox flex-col content border-round container-size margin-md" style="background-color: #eeeeee">
                        <h3 class="margin-lg">Description</h3>
                        <div class="data">
                            <p class="margin-lg"><?= $about ?></p>
                        </div>
                        <textarea name="about" value="<?= $about ?>" class="form form-ctrl margin-lg hidden" placeholder="Enter about us">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vitae magni eveniet porro, ipsa mollitia dolores ipsam optio aliquam, debitis voluptatum accusamus cum perferendis, amet facere expedita nostrum laboriosam quas iste!</textarea>
                    </div>

                    <?php if ($organization || $moderator) { ?>
                    </form>
                <?php } ?>

            </div>



            <div class="flex-col flex-center content border-round container-size margin-md" style="background-color: #03142d">
                <p class="margin-md" style="color:white; text-align:center">Interested in joining hands with us?</p>
                <div class="progress" data-width="100%">
                    <div class="volunteers-progress-bar"></div>
                </div>
                <button class="btn clr-green margin-md"><i class="fas fa-user-friends"></i>&nbsp;I want to
                    volunteer</button>
            </div>

            <div class="flex-col flex-center content border-round container-size margin-md" style="background-color: #03142d; text-align:center">
                <p style="color:white">Would you like to give value to your hard-earned money by contributing to this
                    community service project?</p>
                <div class="progress" data-width="10%">
                    <div class="donaters-progress-bar"></div>
                </div>
                <button class="btn clr-green margin-md" onclick="togglePopup('form'); blur_background('background');stillBackground('id1')"><i class="fas fa-hand-holding-usd"></i>&nbsp;Donate Now!</button>
            </div>

            <div class="flex-row flex-center content border-round container-size">
                <button class="btn data" onclick="edit()">Edit &nbsp;&nbsp; <i class="fas fa-edit "></i></button>
                <button type="button" class="btn btn-solid bg-red border-red form margin-side-md hidden" onclick="edit()">Close &nbsp;&nbsp; <i class="fas fa-times "></i></button>
                <button name="event_id" value="<?= $_GET["event_id"] ?>" form="update-form" type="submit" class="btn btn-solid form hidden">Save &nbsp; <i class="fas fa-check "></i></button>
                <?php if ($status == "added") { ?>
                    <button id="publish-btn" class="btn margin-lg" onclick="togglePopup('publish'); blur_background('background'); stillBackground('id1')">Publish</button>
                <?php } ?>
            </div>
        </div>
    </div>

    <form action="/search" method="post" id="id1">
        <input type="text">
    </form>
    <button type="submit" form="id1"></button>


    <div class="popup" id="publish">
        <div class="content">
            <div>
                <h2>Event Published!</h2>
            </div>

            <div>
                <button class="btn-icon btn-close" onclick="togglePopup('publish'); blur_background('background'); stillBackground('id1')"><i class="fas fa-times"></i></button>
            </div>
        </div>
    </div>

    <div class="popup" id="form">
        <div class="content">
            <div>
                <h2>Donation form</h2>
            </div>
            <div>
                <button class="btn-icon btn-close" onclick="togglePopup('form'); blur_background('background'); stillBackground('id1')"><i class="fas fa-times"></i></button>
            </div>
            <form action="/action_page.php" class="form-container">

                <div class="form-item">
                    <label>Name</label>
                    <input type="text" required class="form-ctrl" placeholder="Enter Your Name">
                </div>

                <div class="form-item">
                    <label>Address</label>
                    <input type="text" required class="form-ctrl" placeholder="Enter Your Address">
                </div>

                <div class="form-item">
                    <label>Contact Number</label>
                    <input type="tel" pattern="^[+]?[0-9]{10,12}$" required class="form-ctrl" placeholder="Enter Your Contact Number">
                </div>

                <div class="form-item">
                    <label>Amount</label>
                    <input type="number" min="1000" step="10" required class="form-ctrl" placeholder="Enter The Amount(LKR)">
                </div>

                <div class="form-item">
                    <label>Credit card number</label>
                    <input type="tel" inputmode="numeric" class="form-ctrl" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx">
                </div>

                <div onload="disableSubmit()">
                    <input type="checkbox" min="0" name="terms" id="terms" onchange="activateButton(this)"> I Agree
                    Terms & Coditions
                </div>

                <button class="btn btn-solid margin-md" type="submit" id="donate-btn" disabled>Donate</button>
            </form>
        </div>
    </div>

</body>



<script>
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

    <?php if (isset($_GET["volunteerErr"])) echo "edit();" ?>

    function togglePopup(id) {
        document.getElementById(id).classList.toggle("active");
    }

    function blur_background(id) {
        document.getElementById(id).classList.toggle("blurred")
    }

    function disableSubmit() {
        document.getElementById("donate-btn").disabled = true;
    }

    function stillBackground(id) {
        document.getElementById(id).classList.toggle("still");
    }

    function activateButton(element) {

        if (element.checked) {
            document.getElementById("donate-btn").disabled = false;
        } else {
            document.getElementById("donate-btn").disabled = true;
        }

    }

    function animateProgressBar(el, width) {

        var usedWidth = width;
        if (parseInt(width.replace('%', '')) < 20) {
            usedWidth = '20%';
        }

        el.animate({
            width: usedWidth
        }, {
            duration: 2000,
            step: function(now, fx) {
                if (fx.prop == 'width') {
                    if (parseInt(width.replace('%', '')) < now) {
                        now = parseInt(width.replace('%', ''));
                    }
                    el.html(Math.round(now * 100) / 100 + '%');
                }
            }
        });
    }

    $('.progress').each(function() {
        animateProgressBar($(this).find("div"), $(this).data("width"))
    });
</script>

</html>