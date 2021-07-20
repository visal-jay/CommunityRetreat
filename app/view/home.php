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
    h1 {
        text-align: center;
        margin-top: 0;
    }

    h3{
        margin: 0;
    }

    .flex-row-to-col {
        display: flex;
        flex-direction: row;
    }

 
    register{
        margin: 1rem 1rem;
        background-color: #EEEEEE;
        border-radius: 8px;
        padding: 1rem 3rem;
    }

    search {
        width: 100%;
        max-width: 100%;
        background-color: #0A1931;
        padding: 2rem;
        box-sizing: border-box;
    }

    input[type=search] {
        width: 100px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    input[type=search]:focus {
        width: 200px;
    }

    .homepage {
        margin: 0 auto;
        width: 80%;
    }

    #myVideo {
        object-fit: fill;
        border-radius: 8px;
        width: 100%;
    }

    .photo-container {
        display: flex;
        border-radius: 8px;
        box-shadow: 0px 0px 0px 1px rgb(192, 192, 192);
        padding: 0;
    }

    .item img {
        width: 150px;
    }

    @media screen and (max-width:767px) {
        register{
            margin: 1rem 0;
        }
        .item img {
            width: 100px;
        }

        h1 {
            font-size: 1.5rem;
        }

        .flex-row-to-col {

            flex-direction: column;
        }

        #near-me {
            margin: 10px;
        }
    }
</style>
<?php include "nav.php" ?>

<body>
    <div class="homepage flex-col flex-center">
        <div class="flex-col flex-center ">
            <video autoplay muted loop id="myVideo">
                <source src="/Public/assets/volunteer.mp4#t=61,65" type=video/mp4>
            </video>
        </div>
        <div>
            <h1>Let's join CommunityRetreat</h1>
        </div>
        <search class="flex-col flex-center border-round">
            <h1 class="clr-white">Let's find what you like</h1>
            <div class="flex-row-to-col flex-center">
                <form action="/action_page.html" class="search-bar" style="height:fit-content">
                    <input type="search" class="form-ctrl" placeholder="Search">
                    <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                </form>
                <button class="btn btn-solid" id="near-me"><i class="fas fa-map-marker-alt"></i>&nbsp;Near me</button>
            </div>
        </search>


        <div class="item flex-row-to-col flex-space">
            <register class="flex-col flex-center">
                <img src="/Public/assets/org.png" alt="">
                <div class="flex-col flex-center">
                    <h3>Register as a Organisation</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt sapiente fuga error obcaecati culpa suscipit recusandae, </p>
                </div>
            </register>
            <register class="flex-col flex-center">
                <img src="/Public/assets/org.png" alt="">
                <div class="flex-col flex-center">
                    <h3>Register as a Organisation</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt sapiente fuga error obcaecati culpa suscipit recusandae, </p>
                </div>
            </register>

        </div>
    </div>
</body>
<script>
    var video = document.getElementById("myVideo");
    video.play();
</script>

</html>