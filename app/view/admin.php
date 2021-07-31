<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
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

    p {
       text-align: justify;
       max-height:150px ;
       overflow-y: scroll;
       background: gainsboro;
       padding:.2rem;
       border-radius: 8px;

    }

    h3{
        margin: 0.8rem 0rem;
    }
    h4{
        margin: 0.2rem 0rem;
    }


    .form {
        min-width: 50%;
        overflow: hidden;
        height: 0px;
        transition: height, 0.3s linear;
    }

    .show-form {
        height: 700px;
        transition: height, 0.3s linear;
    }


    .event-card-details {
        display: flex;
        flex-direction: row;
    }
    ::-webkit-scrollbar {
        width: 2px;
        height: 8px;
        margin: 2rem;
    }

    /* Track */


    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #16c79a;
        border-radius: 5px;
        border: 1 px solid #16c79a;
        margin: 1rem;
        height: 2px;
        width: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #16c79a;
    }
    
</style>
<?php include "nav.php" ?>

<body>
    <div class="flex-col flex-center margin-side-lg">
        <h1>Complaints</h1>
        <div class="margin-side-lg card-container">
            <div class="event-card-details flex-col">
                <div class="margin-side-md">
                    <h3>Organisatione name</h3>
                </div>
                <div class="margin-side-md">
                    <h4>By: Username</h4>
                </div>
                <div class="margin-side-md">
                    <h4>Date: 2018.09.20</h4>
                </div>
                <div class="margin-side-md">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptatem numquam laboriosam quaerat nisi repellat, nam temporibus molestias maxime eum iste velit officia deserunt recusandae voluptatum molestiae nihil ipsam et.</p>
                </div>
                <div class="flex-col flex-center margin-md"><button class="btn ">Viewed</button></div>
            </div>
        </div>
    </div>
</body>

<script>
    function addEvent() {
        document.querySelector(".form").classList.toggle("show-form");
    }

    function remove() {
        event.target.style.display = "none";
        event.target.nextElementSibling.style.display = "flex";
    }

    function cancel() {
        var cancel = event.target.parentNode;
        cancel.style.display = "none";
        cancel.previousElementSibling.style.display = "block";

    }
</script>

</html>