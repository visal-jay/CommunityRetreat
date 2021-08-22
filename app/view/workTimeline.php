<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Work Timeline</title>
</head>

<style>
    @import url("https://fonts.googleapis.com/css2?family=PT+Sans&display=swap");

    body {
        background: #ffffff;
    }

    .container {
        background: #232931;
        width: 540px;
        height: 500px;
        margin: 0 auto;
        position: relative;
        margin-top: 10%;
        box-shadow: 2px 5px 20px rgba(119, 119, 119, 0.5);
    }

    .leftbox {
        top: -5%;
        left: 5%;
        position: absolute;
        width: 15%;
        height: 110%;
        background-color: #50d890;
        box-shadow: 3px 3px 15px rgba(119, 119, 119, 0.5);
    }

    nav {
        margin: 2.6em auto;
    }

    nav a {
        list-style: none;
        padding: 35px;
        color: #232931;
        font-size: 1.1em;
        display: block;
        transition: all 0.5s ease-in-out;
    }

    .rightbox {
        padding: 0em 34rem 0em 0em;
        height: 100%;
    }

    .rb-container {
        font-family: "PT Sans", sans-serif;
        width: 50%;
        margin: auto;
        display: block;
        position: relative;
    }

    .rb-container ul.rb {
        margin: 2.5em 0;
        padding: 0;
        display: inline-block;
    }

    .rb-container ul.rb li {
        list-style: none;
        margin: auto;
        margin-left: 10em;
        min-height: 50px;
        border-left: 1px dashed #fff;
        padding: 0 0 50px 30px;
        position: relative;
    }

    .rb-container ul.rb li:last-child {
        border-left: 0;
    }

    .rb-container ul.rb li::before {
        position: absolute;
        left: -18px;
        top: -5px;
        content: " ";
        border: 8px solid rgba(255, 255, 255, 1);
        border-radius: 500%;
        background: #50d890;
        height: 20px;
        width: 20px;
        transition: all 500ms ease-in-out;
    }

    .rb-container ul.rb li:hover::before {
        border-color: #232931;
        transition: all 1000ms ease-in-out;
    }

    ul.rb li .timestamp {
        color: #50d890;
        position: relative;
        width: 100px;
        font-size: 12px;
    }

    .item-title {
        color: #fff;
    }

    .container-3 {
        width: 5em;
        vertical-align: right;
        white-space: nowrap;
        position: absolute;
    }

    .container-3 input#search {
        width: 150px;
        height: 30px;
        background: #fbfbfb;
        border: none;
        font-size: 10pt;
        color: #262626;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        margin: 0.9em 0 0 28.5em;
        box-shadow: 3px 3px 15px rgba(119, 119, 119, 0.5);
    }

    .container-3 .icon {
        margin: 1.3em 3em 0 31.5em;
        position: absolute;
        width: 150px;
        height: 30px;
        z-index: 1;
        color: #4f5b66;
    }

    input::placeholder {
        padding: 5em 5em 1em 1em;
        color: #50d890;
    }
</style>

<?php include "nav.php" ?>

<body>
    <div class="container">

        <div class="box">
            <div class="container-3">
                <span class="icon"><i class="fa fa-search"></i></span>
                <input type="search" id="search" placeholder="Search..." />
            </div>
        </div>

        <div class="leftbox">
            <nav>
                <a id="dashboard"><i class="fas fa-tachometer-alt"></i></a>
                <a id="profile"> <i class="fas fa-user"></i> </a>
                <a id="settings"> <i class="fas fa-cog"></i> </a>
                <a id="messages"> <i class="fas fa-comments"></i> </a>
                <a id="notification"> <i class="fas fa-bell"></i> </a>
            </nav>
        </div>
        <div class="rightbox">
            <div class="rb-container">
                <ul class="rb">

                    <li class="rb-item" ng-repeat="itembx">
                        <div class="timestamp">
                            3rd May 2020<br> 7:00 PM
                        </div>
                        <div class="item-title">Chris Serrano posted a photo on your wall.</div>

                    </li>

                    <li class="rb-item" ng-repeat="itembx">
                        <div class="timestamp">
                            19th May 2020<br> 3:00 PM
                        </div>
                        <div class="item-title">Mia Redwood commented on your last post.</div>

                    </li>

                    <li class="rb-item" ng-repeat="itembx">
                        <div class="timestamp">
                            17st June 2020<br> 7:00 PM
                        </div>
                        <div class="item-title">Lucas McAlister just send you a message.</div>

                    </li>

                </ul>
            </div>
        </div>
    </div>
</body>

<script></script>

</html>