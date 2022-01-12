<!DOCTYPE html>
<html>
<?php include "nav.php" ?>
<head>
    <title>
    CommunityRetreat
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../Public/assets/style/fontawesome.min.css">
    <script defer src="../Libararies/moment.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../Public/assets/style/calenderstyle.css">
    <link rel="stylesheet" href="../Public/assets/style/notificationstyle.css">
    <script defer src="../Public/assets/js/notification.js"></script>

    <!-- Script for render calendar  -->
    <script defer src="../Public/assets/js/calender.js"></script>
    <style>
        .grid-container{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            grid-template-areas: "notification notification calendar"
                                 "notification notification event-popup";
            grid-gap: 1rem;
            margin: 2rem auto;
            width: 90%;
            height: 120vh;
        }
        .popup{
            display: flex;
            flex-direction: column;
            grid-area: event-popup;
            height: 100%;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 2px 12px rgba(32,32,32,.3);
        }
        .date-event-popup{
            display: flex;
            justify-content: center;
            color:darkcyan;
            font-weight: 600;
        } 
        .calendar-view-btn{
            display: none;
        }
        @media screen and (max-width: 800px) {
            .grid-container{
                display: flex;
                flex-direction: column;
            }
            .popup, .calender{
                display: none;   
            }
            .calendar-view-btn{
                display: flex;
                margin: 2rem 1rem 1rem 1rem;
                float: right;
            }
            .view-calendar{
                display: flex;
            }
            .hide-notification-form{
                display: none;
            } 
            .popup{
                height: 400px;
            }

           
        }

    </style>
    
</head>



<body class="body" onload="renderNotifications()">
    <button class="btn calendar-view-btn" style=" color:white;background: #05a9b3;border:none" onclick="toggleCalendar()"><i class="fas fa-arrow-circle-left"></i>&nbsp&nbspCalendar&nbsp&nbsp<i class="fas fa-calendar-alt"></i></button>
    
    <div class="grid-container">
                
            <div class="notifications-form">
                <h2  id="empty-div-message" style=" text-align:center;padding-top:0.5rem;color: lightslategray;">No Notifications Yet</h2>

            </div>
 
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

        <div class="popup">
            <h1  style=" text-align:center;padding-top:0.5rem;">
                Events on
            </h1>
            <div class="date-event-popup">
                <p></p>
            </div>
            <div class="event-items">

            </div>
        </div>


    </div>
 
   

</body>
<?php include "footer.php"?>
<script>
    function toggleCalendar(){
        var calendar = document.querySelector(".calender");
        var notification_form = document.querySelector(".notifications-form");
        var event_popup = document.querySelector(".popup");
        var calendar_view_btn = document.querySelector(".calendar-view-btn");
        notification_form.classList.toggle("hide-notification-form");
        calendar.classList.toggle("view-calendar");
        event_popup.classList.toggle("view-calendar");
        if(calendar.className === "calender view-calendar"){
            calendar_view_btn.innerHTML = `<i class="fas fa-arrow-circle-left"></i>&nbsp&nbspNotifications&nbsp&nbsp<i class="fas fa-bell"></i>`;
        }
        else{
            calendar_view_btn.innerHTML = `<i class="fas fa-arrow-circle-left"></i>&nbsp&nbspCalendar&nbsp&nbsp<i class="fas fa-calendar-alt"></i>`;
        }
    }
</script>

</html>