<!DOCTYPE html>
<html lang="en" id="id1">

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

    .timelineconta {
        background: transparent;
        width: 80%;
        height: 500px;
        position: relative;
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
        min-height: 50px;
        border-left: 1px dashed #03142d;
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
        border: 8px solid rgba(3, 20, 45, 1);
        border-radius: 500%;
        background: white;
        height: 20px;
        width: 20px;
        transition: all 500ms ease-in-out;
    }

    .rb-container ul.rb li:hover::before {
        background: #50d890;
        border-color: #232931;
        transition: all 500ms ease-in-out;
    }

    ul.rb li .timestamp {
        color: #50d890;
        position: relative;
        width: 100px;
        font-size: 12px;
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
        color: black;
    }

    input::placeholder {
        padding: 5em 5em 1em 1em;
        color: black;
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

    ::placeholder {
        color: black;
        opacity: 1;
    }

    @media screen and (max-width:800px) {
        
        .timeline {
            background: transparent;
            width: 80%;
            height: 500px;
            margin: 0 0 0 2rem;
            position: relative;
        }
    }
</style>

<?php include "nav.php" ?>

<body>
    <div id="background">
        <div class="flex-col flex-center margin-side-lg">
            <button class="btn btn-solid btn-close margin-lg" onclick="togglePopup('form'); blur_background('background'); stillBackground('id1')">Add Task &nbsp; <i class="fas fa-plus"></i></button>
            <!-- <div class="container-3">
                <span class="icon"><i class="fa fa-search"></i></span>
                <input type="search" id="search" placeholder="Search..." />
            </div> -->
        </div>

        <div class="timeline">
            <div class="box">

            </div>

            <div class="rightbox">
                <div class="rb-container">
                    <ul class="rb">

                        <li class="rb-item">
                            <div class="timestamp">
                                <h3>3rd May 2020<br> 7:00 PM</h3>
                            </div>
                            <div>Chris Serrano posted a photo on your wall.</div>

                        </li>

                        <li class="rb-item">
                            <div class="timestamp">
                                <h3>19th May 2020<br> 3:00 PM</h3>
                            </div>
                            <div>Mia Redwood commented on your last post.</div>

                        </li>

                        <li class="rb-item">
                            <div class="timestamp">
                                <h3>17st June 2020<br> 7:00 PM</h3>
                            </div>
                            <div>Lucas McAlister just send you a message.</div>

                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="popup" id="form">
        <div class="content">
            <div>
                <h2>New Task</h2>
            </div>
            <div>
                <button class="btn-icon btn-close" onclick="togglePopup('form'); blur_background('background'); stillBackground('id1')"><i class="fas fa-times"></i></button>
            </div>
            <form action="/action_page.php" class="form-container">

                <div class="form-item">
                    <label>Date</label>
                    <input type="date" name="Event date" class="form form-ctrl" data-placeholder="Task starts on?" required></input>
                </div>

                <div class="form-item">
                    <label>Time</label>
                    <input type="time" name="Event time" class="form form-ctrl" data-placeholder="Task starts at?" required></input>
                </div>

                <div class="form-item">
                    <label>Task</label>
                    <textarea name="task" class="form form-ctrl" placeholder="Enter the task" required>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vitae magni eveniet porro, ipsa mollitia dolores ipsam optio aliquam, debitis voluptatum accusamus cum perferendis, amet facere expedita nostrum laboriosam quas iste!</textarea>
                </div>

                <button class="btn btn-solid margin-md" type="submit" disabled>Add Task</button>
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

    function stillBackground(id) {
        document.getElementById(id).classList.toggle("still");
    }
</script>

</html>