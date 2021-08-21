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
    table-layout: fixed;
}

table,
th,
td {
    text-align: center;
    padding: 7px 10px 20px;
}

td,
h1 {
    text-align: center;
}

.donation-details-btn {
    text-align: center;
    margin: 25px;
}

.headers {
    text-align: center;
}

.initial-donation-enable-btn {
    height: 80vh;
    text-align: center;
    top: 50%;
    position: fixed;
    width: 100%;
}

.blur {
    filter: blur(2px);
}

.hide {
    display: hide;
}

.secondary-donation-enable-disable-btn {
    text-align: right;
    margin-right: 200px;
    margin-bottom: 20px;
}

@media screen and (max-width:768px) {

    h1 {
        text-align: center;
    }

    #mytable .scroll {
        overflow: scroll;
    }
}
</style>

<body>
    <div class="initial-donation-enable-btn">
        <button class="btn btn-md btn-solid" id="initial-donation-enable-btn"
            onclick="myFunction(); hide('initial-donation-enable-btn')">Enable
            Donations</button>
    </div>
    <div class="background blur" id="background1">
        <h1>Donation Details</h1>
        <div class="secondary-donation-enable-disable-btn">
            <button class="btn btn-md btn-solid" id="enable-disable-btn"
                onclick="change_enable_disable_button('enable-disable-btn')">Disable Donations</button>
        </div>
        <div class=" event-table">
            <table id="mytable">
                <thead>
                    <tr class="headers">
                        <th class="scroll">Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="scroll">J.K.Wijayathilake</td>
                        <td>2020.10.21</td>
                        <td>rs.100000</td>
                    </tr>
                    <tr>
                        <td class="scroll">M.D.Karunarathne</td>
                        <td>2020.10.25</td>
                        <td>rs.150000</td>
                    </tr>
                    <tr>
                        <td class="scroll">P.V.Kumarasinghe</td>
                        <td>2020.11.02</td>
                        <td>rs.120000</td>
                    </tr>
                    <tr>
                        <td class="scroll">H.N.Hewawithrane</td>
                        <td>2020.11.05</td>
                        <td>rs.200000</td>
                    </tr>
                    <tr>
                        <td class="scroll">R.S.Thilakawardhane</td>
                        <td>2020.11.10</td>
                        <td>rs.100000</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="donation-details-btn">
            <button class="btn btn-md btn-solid">Full donation details</button>
        </div>
    </div>
</body>

<script>
function myFunction() {
    var element = document.getElementById("background1");
    element.classList.remove("blur");
}

function hide(id) {
    document.getElementById(id).classList.toggle("hide");
}

function change_enable_disable_button(id) {
    var x = document.getElementById(id)

    if (x.innnerHTML == "Disable Donations") {
        x.innerHTML = "Enable Donations";
    } else {
        x.innnerHTML = "Disable Donations";
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