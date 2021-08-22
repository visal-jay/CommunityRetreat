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
        margin: unset
    }

    .icon-width{
        width: 20px;
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
        padding: 0px 5px;
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
    input[type="date"]:valid::before { display: none }

    input[type="time"]::before { 
	content: attr(data-placeholder);
	width: 100%;
    }

    input[type="time"]:focus::before,
    input[type="time"]:valid::before { display: none }

    @media screen and (max-width:800px) {

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

    }
</style>

<body>
    <div id="background">
        <?php include "nav.php" ?>
        <div class="flex-col flex-center">
            <h1>About</h1>
            <div class="content border-round container-size margin-md" style="background-color: #eeeeee">

                <div class="date-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon icon-width far fa-calendar-alt clr-green margin-side-lg"></i>
                        <h4 class="head-margin data">28th October 2021</h4>
                        <input type="date" name="Event date" class="form form-ctrl hidden" data-placeholder="Event is on?" required></input>
                    </div>
                </div>

                <div class="time-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon icon-width far fa-clock clr-green margin-side-lg"></i>
                        <h4 class="head-margin data">10.00 AM</h4>
                        <input type="time" name="Event time" class="form form-ctrl hidden" data-placeholder="Event starts at?" required></input>
                    </div>
                </div>

                <div class="venue-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon icon-width fas fa-map-marker-alt clr-green margin-side-lg"></i>
                        <h4 class="head-margin data">Mount Lavinia Beach</h4>
                        <input type="text" name="Event location" class="form form-ctrl hidden" placeholder="Event is in?" required></input>
                    </div>
                </div>

                <div class="human-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon icon-width fas fa-user-friends clr-green margin-side-lg"></i>
                        <h4 class="head-margin data">100 people volunteered</h4>
                        <input type="text" name="Volunteers" class="form form-ctrl hidden" placeholder="Number of volunteers?" required></input>
                    </div>
                </div>

                <div class="human-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon icon-width fas fa-hand-holding-usd clr-green margin-side-lg"></i>
                        <h4 class="head-margin data">15 people donated</h4>
                        <input type="text" name="Donations" class="form form-ctrl hidden" placeholder="Number of donators?" required></input>
                    </div>
                </div>

                <div class="flag-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon icon-width far fa-flag clr-green margin-side-lg"></i>
                        <div class="flex-row">
                            <p class="head-margin data">Event by <b>AIESEC in University of Colombo</b></p>
                            <input type="text" name="Organizer" class="form form-ctrl hidden" placeholder="Organized by?" required></input>
                        </div>
                    </div>
                </div>

                <div class="globe-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon icon-width fas fa-globe clr-green margin-side-lg"></i>
                        <h4 class="head-margin data">Physical Event</h4>
                        <form action="/action_page.php" class="hidden form" required>
                            <select class="form-ctrl" id="mode" required>
                                <option value="" disabled selected>Select the mode of the event</option>
                                <option value="Physical">Physical</option>
                                <option value="Virtual">Virtual</option>
                                <option value="Physical & Virtual">Physical & Virtual</option>
                            </select>
                        </form>
                    </div>
                </div>

            </div>

            <div class="flex-col content border-round container-size margin-md" style="background-color: #eeeeee">
            <h3 class="margin-lg">Description</h3>
                <div class="data">
                    <p class="margin-lg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                </div>
                <textarea name="description" class="form form-ctrl margin-lg hidden" placeholder="Enter about us">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vitae magni eveniet porro, ipsa mollitia dolores ipsam optio aliquam, debitis voluptatum accusamus cum perferendis, amet facere expedita nostrum laboriosam quas iste!</textarea>
            </div>

            <div class="flex-col flex-center content border-round container-size margin-md" style="background-color: #03142d">
                <p class="margin-md" style="color:white; text-align:center">Interested in joining hands with us?</p>
                <div class="progress" data-width="100%">
                    <div class="volunteers-progress-bar"></div>
                </div>
                <button class="btn clr-green margin-md"><i class="fas fa-user-friends"></i>&nbsp;I want to volunteer</button>
            </div>

            <div class="flex-col flex-center content border-round container-size margin-md" style="background-color: #03142d">
                <p class="margin-md" style="color:white; text-align:center">Would you like to give value to your hard-earned money by contributing to this community service project?</p>
                <div class="progress" data-width="15%">
                    <div class="donaters-progress-bar"></div>
                </div>
                <button class="btn clr-green margin-md" onclick="togglePopup('form'); blur_background('background');stillBackground('id1')"><i class="fas fa-hand-holding-usd"></i>&nbsp;Donate Now!</button>
            </div>

            <div class="flex-row flex-center content border-round container-size">
                <button class="btn data" onclick="edit()">Edit &nbsp;&nbsp; <i class="fas fa-edit "></i></button>
                <button class="btn btn-solid bg-red border-red form hidden" onclick="edit()">Close &nbsp;&nbsp; <i class="fas fa-times "></i></button>
                <button class="btn btn-solid form hidden">Save &nbsp; <i class="fas fa-check "></i></button>
                <button id="publish-btn" class="btn margin-lg" onclick="togglePopup('publish'); blur_background('background'); stillBackground('id1')">Publish</button>
            </div>
        </div>
    </div>

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
                    <input type="checkbox" min="0" name="terms" id="terms" onchange="activateButton(this)"> I Agree Terms & Coditions
                </div>

                <button class="btn btn-solid margin-md" type="submit" id="donate-btn" disabled>Donate</button>
            </form>
        </div>
    </div>

</body>

<script>

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

    function animateProgressBar(el, width) {
        el.animate({
            width: width
        }, {
            duration: 2000,
            step: function(now, fx) {
                if (fx.prop == 'width') {
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