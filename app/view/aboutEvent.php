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

    .progress {
        width: 75%;
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
                        <i class="btn-icon far fa-calendar-alt clr-green margin-side-lg"></i>
                        <h4 class="head-margin">28th October 2021</h4>
                    </div>
                </div>

                <div class="time-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon far fa-clock clr-green margin-side-lg"></i>
                        <h4 class="head-margin">10.00 AM</h4>
                    </div>
                </div>

                <div class="venue-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon fas fa-map-marker-alt clr-green margin-side-lg"></i>
                        <h4 class="head-margin">Mount Lavinia Beach</h4>
                    </div>
                </div>

                <div class="human-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon fas fa-user-friends clr-green margin-side-lg"></i>
                        <h4 class="head-margin">100 people volunteered</h4>
                    </div>
                </div>

                <div class="human-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon fas fa-hand-holding-usd clr-green margin-side-lg"></i>
                        <h4 class="head-margin">15 people donated</h4>
                    </div>
                </div>

                <div class="flag-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon far fa-flag clr-green margin-side-lg"></i>
                        <div class="flex-row">
                            <p class="head-margin">Event by <b>AIESEC in University of Colombo</b></p>
                        </div>
                    </div>
                </div>

                <div class="globe-container">
                    <div class="flex-row margin-lg">
                        <i class="btn-icon fas fa-globe clr-green margin-side-lg"></i>
                        <h4 class="head-margin">Physical Event</h4>
                    </div>
                </div>

                <p class="margin-lg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took
                    a galley of type and scrambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                    more recently with desktop publishing software like Aldus PageMaker including versions of Lorem
                    Ipsum</p>
            </div>

            <div class="flex-col flex-center content border-round container-size margin-md"
                style="background-color: #03142d">
                <p style="color:white">Interested in joining hands with us?</p>
                <div class="progress" data-width="100%">
                    <div class="volunteers-progress-bar"></div>
                </div>
                <button class="btn clr-green margin-md"><i class="fas fa-user-friends"></i>&nbsp;I want to
                    volunteer</button>
            </div>

            <div class="flex-col flex-center content border-round container-size margin-md"
                style="background-color: #03142d">
                <p style="color:white">Would you like to give value to your hard-earned money by contributing to this
                    community service project?</p>
                <div class="progress" data-width="10%">
                    <div class="donaters-progress-bar"></div>
                </div>
                <button class="btn clr-green margin-md"
                    onclick="togglePopup('form'); blur_background('background');stillBackground('id1')"><i
                        class="fas fa-hand-holding-usd"></i>&nbsp;Donate Now!</button>
            </div>

            <div class="flex-row flex-center content border-round container-size">
                <button class="btn margin-lg">Edit</button>
                <button class="btn margin-lg">Publish</button>
            </div>
        </div>
    </div>

    <div class="popup" id="form">
        <div class="content">
            <div>
                <h2>Donation form</h2>
            </div>
            <div>
                <button class="btn-icon btn-close"
                    onclick="togglePopup('form');blur_background('background');stillBackground('id1')"><i
                        class="fas fa-times"></i></button>
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
                    <input type="tel" pattern="^[+]?[0-9]{10,12}$" required class="form-ctrl"
                        placeholder="Enter Your Contact Number">
                </div>

                <div class="form-item">
                    <label>Amount</label>
                    <input type="number" min="1000" step="10" required class="form-ctrl"
                        placeholder="Enter The Amount(LKR)">
                </div>

                <div class="form-item">
                    <label>Credit card number</label>
                    <input type="tel" inputmode="numeric" class="form-ctrl" pattern="[0-9\s]{13,19}"
                        autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx">
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