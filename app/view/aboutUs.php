<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <link rel="icon" href="/Public/assets/visal logo.png" type="image/icon type">
    <title>Communityretreat</title>
</head>

<style>
    .our-team {
        padding: 30px 0 40px;
        margin-bottom: 30px;
        background-color: #eeeeee;
        text-align: center;
        overflow: hidden;
        position: relative;
        width: 200px;
        height: 200px;
        justify-content: center;
    }

    .our-team .picture {
        display: inline-block;
        height: 130px;
        width: 130px;
        z-index: 1;
        position: relative;
    }

    .our-team .picture::before {
        content: "";
        width: 100%;
        height: 0;
        border-radius: 50%;
        background-color: #16c79a;
        position: absolute;
        bottom: 135%;
        right: 0;
        left: 0;
        opacity: 0.9;
        transform: scale(3);
        transition: all 0.3s linear 0s;
    }

    .our-team:hover .picture::before {
        height: 100%;
    }

    .our-team .picture::after {
        content: "";
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #16c79a;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
    }

    .our-team .picture img {
        width: 100%;
        height: auto;
        border-radius: 50%;
        transform: scale(1);
        transition: all 0.9s ease 0s;
    }

    .our-team:hover .picture img {
        box-shadow: 0 0 0 14px #eeeeee;
        transform: scale(0.7);
    }

    .our-team .title {
        display: block;
        font-size: 15px;
        color: #4e5052;
        text-transform: capitalize;
    }

    .our-team .social {
        width: 100%;
        padding: 0;
        margin: 0;
        background-color: #16c79a;
        position: absolute;
        bottom: -100px;
        left: 0;
        transition: all 0.5s ease 0s;
    }

    .our-team:hover .social {
        bottom: 0;
    }

    .our-team .social li {
        display: inline-block;
    }

    .our-team .social li a {
        display: block;
        padding: 10px;
        font-size: 17px;
        color: white;
        transition: all 0.3s ease 0s;
        text-decoration: none;
    }

    .our-team .social li a:hover {
        color: #16c79a;
        background-color: #eeeeee;
    }

    h2 {
        text-align: center;
    }


    @media screen and (max-width:800px) {

        .our-team {
            width: 250px;
            height: 220px;
        }

        .picture {
            height: 100px;
            width: 100px;
        }

        h3 {
            font-size: inherit;
        }

        p {
            text-align: center;
        }

        .scroll {
            padding: 2rem 2rem 0.8rem 2rem;
            overflow-x: scroll;
        }

    }
</style>

<?php include "nav.php" ?>

<body>
    <div class="container" style="min-height:80%">
        <h2>About Us</h2>
        <p class="margin-md">We are a group of four second year computer science undergraduates at University of Colombo School of Computing</p>

        <div class="flex-row scroll">

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 margin-side-md">
                <div class="our-team">
                    <div class="picture">
                        <img class="img-fluid" src="/Public/assets/Visal.jpg">
                    </div>
                    <div class="team-content">
                        <h3>Visal<br>Jayathilake</h3>
                    </div>
                    <ul class="social">
                        <li></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 margin-side-md">
                <div class="our-team">
                    <div class="picture">
                        <img class="img-fluid" src="/Public/assets/Manuka.jpg">
                    </div>
                    <div class="team-content">
                        <h3>Manuka<br>Dewanarayana</h3>
                    </div>
                    <ul class="social">
                        <li></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 margin-side-md">
                <div class="our-team">
                    <div class="picture">
                        <img class="img-fluid" src="/Public/assets/Venodi.jpg">
                    </div>
                    <div class="team-content">
                        <h3>Venodi<br>Widanagamage</h3>
                    </div>
                    <ul class="social">
                        <li></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 margin-side-md">
                <div class="our-team">
                    <div class="picture">
                        <img class="img-fluid" src="/Public/assets/Semini.jpg">
                    </div>
                    <div class="team-content">
                        <h3>Semini<br>Bodhinayake</h3>
                    </div>
                    <ul class="social">
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

<script></script>

</html>