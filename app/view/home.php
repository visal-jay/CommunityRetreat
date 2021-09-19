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



    .home-events {
        border-radius: 8px;
        min-height: max-content;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 3rem;
        
        padding: 2rem 1rem;
        margin: 1rem 0 2rem 0;
    }

    .home-events img {
        width: 400px;
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
        margin: 2rem 0;
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
        margin: 0 auto 50px auto;
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
        padding-bottom: 1rem;
        min-height: 300px;
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

    .heading {
        position: absolute;
        top: 40px;
    }

    figure {
        min-height: 100px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        border-radius: 3px;
        margin: 0 1rem;
        min-width: 250px;
        width: 250px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
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

    figure .about {
        font-size: smaller;
        white-space: normal;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 6;
        -webkit-box-orient: vertical;
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
        border-radius: 3px;
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
        height: 10px;
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

    p {
        margin: 0;
    }

    figure p,
    h1,
    h2,
    h3 {
        font-family: Roboto, Arial, sans-serif;
    }

    #map {
        width: 450px;
        height: 400px;
    }

    @media screen and (max-width:767px) {
        .grid-row-1{
            grid-row: 1;
        }

        .grid-row-2{
            grid-row: 2;
        }

        .heading {
            position: absolute;
            top: 10px;
        }

        .home-events img {
            width: 200px;
        }

        .home-events {
            grid-template-columns: 1fr;
            grid-gap: 1rem;
        }

        figure {
            width: 170px;
        }

        register {
            margin: 1rem 0;
            width: auto;
            box-shadow: rgba(50, 50, 105, 0.15) 0px 2px 5px 0px, rgba(0, 0, 0, 0.05) 0px 1px 1px 0px;
        }

        .item img {
            width: 100px;
        }

        #map {
            width: 250px;
            height: 250px;
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
<?php
$organization = $admin = $registered_user = $guest_user = false;
if (isset($_SESSION["user"]["user_type"])) {
    if ($_SESSION["user"]["user_type"] == "organization") {
        $organization = true;
    }
    if ($_SESSION["user"]["user_type"] == "admin") {
        $$admin = true;
    }
    if ($_SESSION["user"]["user_type"] == "registered user") {
        $registered_user = true;
    }
} else {
    $guest_user = true;
}
?>

<body>
    <div class="loader" onload="move();">
        <img src="/Public/assets/visal logo.png ">
        <div id="progress-bar">
            <div id="myBar"></div>
        </div>
    </div>
    <div class="homepage flex-col flex-center hidden" style="display:none">
        <div class="flex-col flex-center" style="position:relative;">
            <video autoplay muted loop id="myVideo">
                <source src="/Public/assets/volunteer.mp4#t=61,65" type=video/mp4>
            </video>
            <div class="heading">
                <h1>Let's join CommunityRetreat</h1>
            </div>
        </div>

        <search class="flex-col flex-center border-round">
            <h1 class="clr-white">Let's find what you like</h1>
            <div class="flex-row-to-col flex-center">
                <form action="/Search/view" method="get" class="search-bar" style="height:fit-content">
                    <input style="color:white" type="search" name="search" class="form-ctrl" placeholder="Search">
                    <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                </form>
                <button class="btn btn-solid" id="near-me" onclick="nearme()"><i class="fas fa-map-marker-alt"></i>&nbsp;Near me</button>
            </div>
        </search>

        <?php if ($guest_user) { ?>
            <div class="item flex-row-to-col flex-space">
                <register class="flex-col flex-center">
                    <img src="/Public/assets/volunteer.png" alt="">
                    <div class="flex-col flex-center">
                        <h3>Register as an User</h3>
                        <p style="text-align: center">By registering as an user you will be eligible to VOLUNTEER for events proudly. <br> You will be able to push yourself more and DONATE generously. </p>
                        <div><a href="/Login/view?signup=true&&signupUser=true">Sign up as a volunteer <i class="fas fa-long-arrow-alt-right"></i></a></div>
                    </div>
                </register>
                <register class="flex-col flex-center">
                    <img src="/Public/assets/organisation.png" alt="">
                    <div class="flex-col flex-center">
                        <h3>Register as an Organisation</h3>
                        <p style="text-align: center">You are an not an individual but and organisation? <br> Even better! <br> Now you can sign up as Organisation and ORGANIZE events and find passionate communities for relavant events.</p>
                        <div><a href="/Login/view?signup=true&&signupOrg=true">Sign up as a organisation <i class="fas fa-long-arrow-alt-right"></i></a></div>
                    </div>
                </register>
            </div>
        <?php } ?>

        <div class="home-events">
            <div class="flex-col flex-center">
                <img src="/Public/assets/sample-1.svg" alt="">
                <h2>Recently added</h2>
                <p style="text-align: center">You are an not an individual but and organisation? <br> Even better! <br> Now you can sign up as Organisation and ORGANIZE events and find passionate communities for relavant events.</p>
            </div>
            <div class="flex-row margin-lg" id='recent-events'></div>
        </div>

        <div class="home-events">
            <div id="map" class="margin-side-md grid-row-2"></div>
            <div class="flex-col flex-center grid-row-1">
                <img src="/Public/assets/sample-2.svg" alt="">
                <h2>Near you</h2>
                <p style="text-align: center">You are an not an individual but and organisation? <br> Even better! <br> Now you can sign up as Organisation and ORGANIZE events and find passionate communities for relavant events.</p>
            </div>
        </div>

        <div class="home-events">
            <div class="flex-col flex-center">
                <img src="/Public/assets/sample-3.svg" alt="">
                <h2>Need your donations</h2>
                <p style="text-align: center">You are an not an individual but and organisation? <br> Even better! <br> Now you can sign up as Organisation and ORGANIZE events and find passionate communities for relavant events.</p>
            </div>
            <div class="flex-row margin-lg" id='donation-events'></div>
        </div>

        <div class="home-events">
            <div class="flex-row margin-lg grid-row-2" id='volunteer-events'></div>

            <div class="flex-col flex-center grid-row-1">
                <img src="/Public/assets/sample-4.svg" alt="">
                <h2>Need your engagement</h2>
                <p style="text-align: center">You are an not an individual but and organisation? <br> Even better! <br> Now you can sign up as Organisation and ORGANIZE events and find passionate communities for relavant events.</p>
            </div>
        </div>
    </div>


</body>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN2HxM42eIrEG1e5b9ar2H_2_V6bMRjWk&callback=initMap&libraries=&v=weekly" async></script>

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

    async function recentlyAdded() {

        search({
            sort: 'event_id',
            way: 'DESC',
            container: 'recent-events'
        });
    }

    async function donationEvents() {
        search({
            sort: 'donation_percent',
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
            url: "/Search/searchAll", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                status: 'published',
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
                if (result.length == 0) {
                    let empty = '<figure class="border-round flex-row flex-center" ><h2 style="text-align: center;white-space: break-spaces;">Looks like there are no such events</h2></figure>'
                    parent_container.appendChild(createElementFromHTML(empty));
                } else
                    result.forEach(evn => {
                        let template = `
                    <figure onclick="location.href = '/event/view?page=about&&event_id=${evn.event_id}' ">
                        <div class="content">
                            <div class="photo-container"><img src="${evn.cover_photo}" style="object-fit: cover;" alt="">
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
                            <p class="margin-md" style="margin-bottom:0;"><b>${evn.event_name}</b></p>
                            <p class="margin-md about" style="margin-top:0">${evn.start_date}</p>
                            <div class="flex-col margin-side-md" >
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <p>Donations</p>
                                <p>${evn.donation_status==0 ? '<i class="fas fa-times fa-xs clr-red margin-side-md"></i>' : '<i class="fas fa-check fa-xs clr-green margin-side-md"></i>'}</p>
                                </div>
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <div style="display:flex;align-items:center;position:relative;width:100%;"><div style="border-radius:6px;position:absolute;width:${(evn.donation_percent==null || evn.donation_percent<5) ? 5 : Math.round(evn.donation_percent)}%;background-color:#FFB319;height:6px;"></div></div>
                                <p>${evn.donation_percent==null ? 0 : Math.round(evn.donation_percent)}%</p>

                                </div>
                            </div>
                            <div class="flex-col margin-side-md">
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <p>Volunteered</p>
                                <p>${evn.volunteer_status==0 ? '<i class="fas fa-times fa-xs clr-red margin-side-md"></i>' : '<i class="fas fa-check fa-xs clr-green margin-side-md"></i>'}</p>
                                </div>
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <div style="display:flex;align-items:center;position:relative;width:100%;"><div style="border-radius:6px;position:absolute;width:${(evn.volunteer_percent==null || evn.volunteer_percent<5) ? 5 : Math.round(evn.volunteer_percent)}%;background-color:#8236CB;height:6px;"></div></div>
                                <p>${evn.volunteer_percent==null ? 0 : Math.round(evn.volunteer_percent)}%</p>
                                </div>
                            </div>
                            <div>
                                <p class="margin-md about">${evn.about}</p>
                            </div>
                        </div>
                    </figure>
                    `;
                        parent_container.appendChild(createElementFromHTML(template));
                    });
                let more = '<figure class="border-round flex-row flex-center" ><a href="/Search/view" style="text-decoration:none;color:black" ><h2 style="text-align: center;">Search more <br><i class="fas fa-search"></i></h2></a></figure>'
                parent_container.appendChild(createElementFromHTML(more));
            }
        });
    }

    recentlyAdded();
    volunteerEvents();
    donationEvents();

    var map;
    async function initMap() {
        const position = await getCoordinates();
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;
        const current_location = {
            lat: latitude,
            lng: longitude
        };
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: current_location,
        });

        var custom_marker = {
            url: '/Public/assets/street-view-solid.svg',
            size: new google.maps.Size(100, 100),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 0),
        }
        new google.maps.Marker({
            position: current_location,
            draggable: false,
            map,
            title: "Your location",
            icon: custom_marker
        });

        Nearsearch(latitude,longitude);
    }

    async function Nearsearch(latitude,longitude) {

        $.ajax({
            url: "/Search/searchAll", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                status: 'published',
                latitude: latitude,
                longitude: longitude,
                distance: 20,
                limit: 10
            },
            success: function(result) {

                if (result.length == 0)
                    return;
                else
                    result.forEach(evn => {
                        let template = `
                    <figure onclick="location.href = '/event/view?page=about&&event_id=${evn.event_id}' ">
                        <div class="content">
                            <div class="photo-container "><img src="${evn.cover_photo}" style="object-fit: cover;" alt="">
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
                            <p class="margin-md" style="margin-bottom:0;"><b>${evn.event_name}</b></p>
                            <p class="margin-md about" style="margin-top:0">${evn.start_date}</p>
                            <div class="flex-col margin-side-md" >
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <p>Donations</p>
                                <p>${evn.donation_status==0 ? '<i class="fas fa-times fa-xs clr-red margin-side-md"></i>' : '<i class="fas fa-check fa-xs clr-green margin-side-md"></i>'}</p>
                                </div>
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <div style="display:flex;align-items:center;position:relative;width:100%;"><div style="border-radius:6px;position:absolute;width:${(evn.donation_percent==null || evn.donation_percent<5) ? 5 : Math.round(evn.donation_percent)}%;background-color:#FFB319;height:6px;"></div></div>
                                <p>${evn.donation_percent==null ? 0 : Math.round(evn.donation_percent)}%</p>

                                </div>
                            </div>
                            <div class="flex-col margin-side-md">
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <p>Volunteered</p>
                                <p>${evn.volunteer_status==0 ? '<i class="fas fa-times fa-xs clr-red margin-side-md"></i>' : '<i class="fas fa-check fa-xs clr-green margin-side-md"></i>'}</p>
                                </div>
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <div style="display:flex;align-items:center;position:relative;width:100%;"><div style="border-radius:6px;position:absolute;width:${(evn.volunteer_percent==null || evn.volunteer_percent<5) ? 5 : Math.round(evn.volunteer_percent)}%;background-color:#8236CB;height:6px;"></div></div>
                                <p>${evn.volunteer_percent==null ? 0 : Math.round(evn.volunteer_percent)}%</p>
                                </div>
                            </div>
                            <div>
                                <p class="margin-md about">${evn.about}</p>
                            </div>
                        </div>
                    </figure>
                    `;
                        const infowindow = new google.maps.InfoWindow({
                            content: template,
                        });

                        let pos = {
                            lat: evn.latitude,
                            lng: evn.longitude
                        }
                        let marker = new google.maps.Marker({
                            position: pos,
                            map,
                            title: evn.event_name,
                        });
                        marker.addListener("click", () => {
                            infowindow.open({
                                anchor: marker,
                                map,
                                shouldFocus: false,
                            });
                        });
                    });
            }
        });
    }
</script>

</html>