<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>About Event</title>
</head>

<style>
    .container-size{
        width: 70%;
    }

    .head-margin{
        margin: unset
    }

    @media screen and (max-width:800px){

        .container-size{
        width: 90%;
        }

    }

</style>

<?php include "nav.php" ?>

<body>
    <div class="flex-col flex-center">
    <h1>About</h1>
        <div class="content border-round container-size margin-md" style= "background-color: #eeeeee">

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

            <p class= "margin-lg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
            
        </div>

        <div class="flex-col flex-center content border-round container-size margin-md" style= "background-color: #03142d">
            <p style="color:white">Interested in joining hands with us?</p>
            <button class="btn clr-green margin-md"><i class="fas fa-user-friends"></i>&nbsp;I want to volunteer</button>
        </div>

        <div class="flex-col flex-center content border-round container-size margin-md" style= "background-color: #03142d">
            <p style="color:white">Would you like to give value to your hard-earned money by contributing to this community service project?</p>
            <button class="btn clr-green margin-md"><i class="fas fa-hand-holding-usd"></i>&nbsp;Donate Now!</button>
        </div>

        <div class="flex-row flex-center content border-round container-size">
            <button class="btn margin-lg">Edit</button>
            <button class="btn margin-lg">Publish</button>
        </div>
    </div>  
</body>

<script></script>

</html>