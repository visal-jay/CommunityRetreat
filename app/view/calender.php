<!DOCTYPE html>
<html>

<head>
    <title>
        calender
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../Public/assets/style/fontawesome.min.css">
    <link rel="stylesheet" href="../Public/assets/style/calenderstyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="../Public/assets/js/calender.js"></script>
    
</head>

<?php include "nav.php" ?>

<body class="body">
    <h1 id="topic">
        Calender
    </h1>
    <div class="calender-container">
        <div class="calender">
            <div class="month">
                <i class="fas fa-angle-left prev "></i>
                <div class="date">
                    <h1></h1>
                    <p></p>
                </div>
                <i class="fas fa-angle-right next"></i>
            </div>
            <div class="weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div class="days">

            </div>
        </div>
    </div>
    <div class="event-popup-container">
        <div class="event-popup card-container">
            <div class="event-popup-header">
                <div class="close-btn"><button class="btn btn-icon  popup-form-cancelbtn" onclick="popupHide()"><i class="fas fa-times clr-red"></i></button></div>
                <h2>Events on</h2>

            </div>
            <div class="date-event-popup">
                <p></p>
            </div>
            <div class="event-items">

            </div>
        </div>

    </div>






</body>


</html>