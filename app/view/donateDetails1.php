<!DOCTYPE html>
<html lang="en" id="id1">

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
    top: 50%;
    position: fixed;
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
}

.amount {
    text-align: right;
}


* {
    box-sizing: border-box;
}


/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

.container {
    /* max-width: -webkit-max-content; */
    /* max-width: max-content; */
    /* margin: 0 auto; */
    max-width: 100%;
    display: flex;


    width: 50%;
}

.section {
    flex: 1;
}

a {
    display: block;
    margin-block-start: 1.33em;
    margin-block-end: 1.33em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    text-align: center;
}

input {
    margin-block-start: 1.33em;
    margin-block-end: 1.33em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
}

.edit-btn,
.close-btn,
.save-btn {
    margin-block-start: 1rem;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
}

.form {
    width: 60px;
    height: 28px;
    text-align: center;
}

.secondary-donation-enable-disable-btn {
    margin: 10px;
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

.still {
    overflow: hidden;
}

@media screen and (max-width:768px) {

    table,
    th,
    td {
        padding: 5px 8px 12px;
    }

    body {
        font-size: 13px;
    }

    #mytable .scroll {
        overflow: scroll;
    }

    .close-btn {
        padding: 8px;
    }

    .save-btn {
        padding: 8px;
    }

    .container-size {
        width: 95%;
    }

    .initial-donation-enable-btn {
        top: 37%;
    }

    .container {
        width: 65%;
        margin: auto;
    }

    .card-container {
        align-items: flex-start;
        justify-content: left;
        flex-direction: column;
        height: fit-content;
    }

}
</style>

<body>
    <div id="background1">
        <div class="blur flex-center flex-col" id="background">
            <div class="container-size">
                <h1>Donation Details</h1>

                <div class="row container">
                    <div class="column section">
                        <h4>Donation capacity</h4>
                    </div>
                    <div class="column section">
                        <div class="data">
                            <a>56</a>
                        </div>
                        <div>
                            <input name="donation-capacity" type="number" value="56" min="50" max="1000"
                                class=" form form-ctrl hidden" />
                        </div>
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
                        <button class=" btn btn-solid btn-md form hidden save-btn">Save &nbsp; <i
                                class="fas fa-check "></i></button>
                    </div>
                </div>


                <div class="secondary-donation-enable-disable-btn">
                    <button class="btn btn-md btn-solid" id="enable-disable-btn"
                        onclick="change_enable_disable_button('enable-disable-btn')">Disable
                        Donations</button>
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
                            <tr>
                                <td class="scroll">J.K.Sunil Wijayathilake</td>
                                <td>2020.10.21</td>
                                <td class="amount">rs.100000</td>
                            </tr>
                            <tr>
                                <td class="scroll">M.D.Nimal Karunarathne</td>
                                <td>2020.10.25</td>
                                <td class="amount">rs.150000</td>
                            </tr>
                            <tr>
                                <td class="scroll">P.V.Shanthi Kumarasinghe</td>
                                <td>2020.11.02</td>
                                <td class="amount">rs.120000</td>
                            </tr>
                            <tr>
                                <td class="scroll">H.N.Nihal Amarasiri</td>
                                <td>2020.11.05</td>
                                <td class="amount">rs.200000</td>
                            </tr>
                            <tr>
                                <td class="scroll">R.S.Niluka Pathirana</td>
                                <td>2020.11.10</td>
                                <td class="amount">rs.100000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="donation-details-btn popup">
                    <button class="btn btn-md btn-solid"
                        onclick="togglePopup('publish'); blur_background('background'); stillBackground('id1')">Full
                        donation details</button>
                </div>
            </div>
        </div>
        <div class="popup" id="publish">
            <div class="content">
                <div>
                    <button class="btn-icon btn-close"
                        onclick="togglePopup('publish'); blur_background('background'); stillBackground('id1')"><i
                            class="fas fa-times"></i></button>
                    <p>
                        jvvbvdh nv n vnvnnvn h kcbd
                    </p>
                </div>
            </div>
        </div>

        <div class="initial-donation-enable-btn">
            <button class="btn btn-lg btn-solid" id="initial-donation-enable-btn" onclick="myFunction()">Enable
                Donations</button>
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

/*function on() {
document.getElementById("blur").style.display = "none";
}*/

/*function off() {
    document.getElementById("blur").style.display = "block";
}*/
</script>

</html>