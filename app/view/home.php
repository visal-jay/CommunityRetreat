<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <title>Document</title>
</head>
<style>
    h1 {
        text-align: center;
        margin-top: 0;
    }

    h3 {
        margin: 0;
    }

    .flex-row-to-col {
        display: flex;
        flex-direction: row;
    }


    register {
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

    search input[type=search] {
        width: 90%;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    search input[type=search]:focus {
        width: 100%;
    }

    .homepage {
        margin: 0 auto;
        width: 80%;
    }

    register {
        width: 50%;
        min-height: 340px;
        position: relative;
    }

    register div div {
        position: absolute;
        bottom: 20px;
    }

    register div div a {
        color: black
    }

    #recent-events,
    #near-events,
    #donation-events,
    #volunteer-events {
        overflow-x: scroll;
        width: 100%;
        padding-bottom: 1rem;
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

    figure {
        min-height: 100px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        border-radius: 8px;
        margin: 0 1rem;
        width: 200px;
        min-width: 200px;
    }

    figure .content {
        position: relative;
    }

    figure .stats {
        position: absolute;
        width: 100%;
        height: 100% !important;
        background-color: #000000aa;
        color: white;
        display: none;
        text-align: center;
        align-items: center !important;
        justify-content: center;
    }

    .photo-container {
        position: relative;
    }

    figure:hover .stats {
        display: flex;

    }

    figure>img {

        grid-row: 1 / -1;
        grid-column: 1;
    }



    .photo-container img {
        aspect-ratio: 4/2;
        width: 100%;
        border-radius: 8px;
    }

    ::-webkit-scrollbar {
        width: 2px;
        height: 8px;
        margin: 2rem;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: white;
        border-radius: 5px;
        padding: 10px;
        margin: 1rem;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #16c79a;
        border-radius: 5px;
        border: 1 px solid #16c79a;
        margin: 1rem;
        height: 1px;
        width: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #16c79a;
    }

    #progress-bar {
        width: 100%;
        background-color: #ddd;
        border-radius: 8px;
        overflow: hidden;
        height: 1rem;
    }

    #myBar {
        width: 1%;
        height: 30px;
        background-color: #16c79a;
    }

    .loader {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50%;
        transform: translate(-50%, -50%);
    }

    .loader img {
        width: 200px;
        margin: 2rem;
    }


    @media screen and (max-width:767px) {
        figure {
            width: 170px;
        }

        register {
            margin: 1rem 0;
            width: auto;
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

        .loader img {
            width: 100px;
            margin: 2rem;
        }
    }
</style>
<?php include "nav.php" ?>

<body>
    <div class="loader" onload="move();">
        <img src="/Public/assets/visal logo.png ">
        <div id="progress-bar">
            <div id="myBar"></div>
        </div>
    </div>
    <div class="homepage flex-col flex-center hidden" style="display:none">
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
                <button class="btn btn-solid" id="near-me" onclick="nearme()"><i class="fas fa-map-marker-alt"></i>&nbsp;Near me</button>
            </div>
        </search>


        <div class="item flex-row-to-col flex-space">
            <register class="flex-col flex-center">
                <img src="/Public/assets/volunteer.png" alt="">
                <div class="flex-col flex-center">
                    <h3>Register as an User</h3>
                    <p style="text-align: center">By registering as an user you will be eligible to VOLUNTEER for events proudly. <br> You will be able to push yourself more and DONATE generously. </p>
                    <div><a href="/login/view?signup=true&&signupUser=true">Sign up as a volunteer <i class="fas fa-long-arrow-alt-right"></i></a></div>
                </div>
            </register>
            <register class="flex-col flex-center">
                <img src="/Public/assets/organisation.png" alt="">
                <div class="flex-col flex-center">
                    <h3>Register as an Organisation</h3>
                    <p style="text-align: center">You are an not an individual but and organisation? <br> Even better! <br> Now you can sign up as Organisation and ORGANIZE events and find passionate communities for relavant events.</p>
                    <div><a href="/login/view?signup=true&&signupOrg=true">Sign up as a organisation <i class="fas fa-long-arrow-alt-right"></i></a></div>
                </div>
            </register>
        </div>

        <div>
            <h2>Recently added</h2>
            <div class="flex-row margin-lg" id='recent-events'></div>
        </div>
        <div>
            <h2>Near me</h2>
            <div class="flex-row margin-lg" id='near-events'></div>
        </div>
        <div>
            <h2>Need your donations</h2>
            <div class="flex-row margin-lg" id='donation-events'></div>
        </div>
        <div>
            <h2>Need your engagement</h2>
            <div class="flex-row margin-lg" id='volunteer-events'></div>
        </div>

    </div>


</body>
<script>
    function showPage() {
        document.getElementsByClassName("loader")[0].style.display = "none";
        document.getElementsByClassName("homepage")[0].style.display = "block";
        document.getElementById("myVideo").play();
    }

    function move() {
        var elem = document.getElementById("myBar");
        var width = 0;
        var id = setInterval(frame, 20);

        function frame() {
            if (width < 100) {
                width++;
                elem.style.width = width + "%";
            } else {
                showPage();
                clearInterval(id);
            }
        }

    }

    move();



    function createElementFromHTML(htmlString) {
        var div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }

    function getCoordinates() {
        return new Promise(
            function(resolve, reject) {
                navigator.geolocation.getCurrentPosition(resolve, reject);
            }
        );
    }

    async function nearmeEvents() {
        search({
            range: 20,
            container: 'near-events'
        });
    }

    async function recentlyAdded() {

        search({
            sort: 'event_id',
            way: 'DESC',
            container: 'recent-events'
        });
    }

    async function donationEvents() {
        search({
            sort: 'dotaion_percent',
            way: 'ASC',
            container: 'donation-events'
        });
    }

    async function volunteerEvents() {
        search({
            sort: 'volunteer_percent',
            way: 'ASC',
            container: 'volunteer-events'
        });
    }



    async function search({
        range = '',
        sort = '',
        way = '',
        limit = 10,
        container = ''
    } = {}) {

        const position = await getCoordinates();
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;

        $.ajax({
            url: "/search/searchAll", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                status: 'added',
                latitude: latitude,
                longitude: longitude,
                distance: range,
                order_type: sort,
                way: way,
                limit: limit
            },
            success: function(result) {
                console.log(result);
                let parent_container = document.getElementById(container);
                //parent_container.innerHTML = "";
                if (result.length == 0)
                    parent_container.parentElement.remove();
                else
                    result.forEach(evn => {
                        let template = `
                    <figure class=" bg-green" onclick="location.href = '/event/view?page=about&&event_id=${evn.event_id}' ">
                        <div class="content">
                            <div class="photo-container "><img src="/Public/assets/mountains.jfif" style="object-fit: cover;" alt="">
                                <div class="stats">
                                <div>
                                    <span>Volunteered ${evn.volunteered==null ? 0 : Math.round(evn.volunteer_percent)}%</span>
                                    <br>
                                    <span>Donations ${evn.dotaion_percent==null ? 0 : Math.round(evn.dotaion_percent)}%</span>
                                    <br>
                                    <span>Distance ${evn.distance==null ? "- " : Math.round(evn.distance)} KM</span>
                                    </div>
                                </div>
                            </div>
                            <p class="margin-md" style="color:white;">${evn.event_name}</p>
                        </div>
                    </figure>
                    `;
                        parent_container.appendChild(createElementFromHTML(template));
                    });
                let more = '<figure class="border-round flex-row flex-center" ><a href="/search/view" style="text-decoration:none;color:black" ><h2 style="text-align: center;">Search more <br><i class="fas fa-search"></i></h2></a></figure>'
                parent_container.appendChild(createElementFromHTML(more));
            }
        });
    }

    recentlyAdded();
    nearmeEvents();
    volunteerEvents();
    donationEvents();
</script>

</html>