<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

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

    html {
        scroll-snap-type: y mandatory;
    }



    .home-events {
        scroll-snap-align: center;
        width: 100%;
        border-radius: 8px;
        min-height: max-content;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 3rem;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
        padding: 2rem 1rem;
        margin: 1rem 0 2rem 0;
        -webkit-backdrop-filter: blur(5px);
        backdrop-filter: blur(5px);
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
        scroll-snap-align: center;
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

    video {

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
        height: 125px;
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
        background-color: white;
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
        font-family: Roboto, Arial, sans-serif, FontAwesome;
    }

    #map {
        width: 450px;
        height: 400px;
    }

    #myVideo {
        scroll-snap-align: center;
    }

    @media screen and (max-width:767px) {
        .grid-row-1 {
            grid-row: 1;
        }

        .grid-row-2 {
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
            min-width: 200px;
        }

        .photo-container img {
            height: 100px;
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


    .animated {
        -webkit-animation-duration: 1.5s;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fadeInRight {
        from {
            opacity: 0;
            -webkit-transform: translate3d(100px, 0, 0);
            transform: translate3d(100px, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: none;
            transform: none;
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            -webkit-transform: translate3d(100px, 0, 0);
            transform: translate3d(100px, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: none;
            transform: none;
        }
    }

    .fadeInRight.start {
        -webkit-animation-name: fadeInRight;
        animation-name: fadeInRight;
    }



    .more-pens {
        position: fixed;
        left: 20px;
        bottom: 20px;
        z-index: 10;
        font-family: "Montserrat";
        font-size: 12px;
    }

    a.white-mode,
    a.white-mode:link,
    a.white-mode:visited,
    a.white-mode:active {
        font-family: "Montserrat";
        font-size: 12px;
        text-decoration: none;
        background: #212121;
        padding: 4px 8px;
        color: #f7f7f7;
    }

    a.white-mode:hover,
    a.white-mode:link:hover,
    a.white-mode:visited:hover,
    a.white-mode:active:hover {
        background: #edf3f8;
        color: #212121;
    }



    .background {
        z-index: -100;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 500%;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#edf3f8", endColorstr="#dee3e8", GradientType=1);
    }

    .title h1 {
        position: relative;
        color: #000000;
        font-weight: 300;
        font-size: 46px;
        padding: 0;
        margin: 0;
        line-height: 1;
    }

    .title h2 {
        font-weight: 600;
        font-size: 60px;
        padding: 0;
        margin: 0;
        line-height: 1;
    }

    .title h3 {
        font-weight: 200;
        font-size: 20px;
        padding: 0;
        margin: 0;
        line-height: 2;
        color: #5e7283;
        letter-spacing: 2px;
    }

    .title p {
        font-weight: 200;
        font-size: 16px;
        color: #5e7283;
    }

    .pentahedron {
        position: absolute;
        width: 100%;
        height: 100%;
        fill: #3E82F7;
    }

    .point {
        fill: #8491A3;
    }

    .rhombus {
        fill: #2DA94F;
        stroke: #2DA94F;
    }

    .x {
        fill: #FDBD00;
    }

    .circle {
        fill: #ED412D;
    }

    svg {
        display: block;
        width: 30px;
        height: 30px;
        position: absolute;
        transform: translateZ(0px);
        z-index: -1000;
    }

    /*# sourceMappingURL=sample.css.map */
</style>
<?php include "nav.php" ?>

<body>
    <div class="loader" onload="move();">
        <img src="/Public/assets/visal logo.png ">
        <div id="progress-bar">
            <div id="myBar"></div>
        </div>
    </div>
    <back class="background"></back>

    <div class="home-div " style="display: none;">
        <div class="homepage flex-col flex-center">
            <div class="flex-col flex-center" style="position:relative;height: 80vh;">
                <video autoplay muted loop id="myVideo">
                    <source src="/Public/assets/volunteer.mp4" type=video/mp4>
                </video>
                <div class="heading">
                    <h1>Let's join CommunityRetreat</h1>
                </div>
            </div>
            <div class="flex-col flex-center" style="height: 100vh;width:100%;">
                <search class="flex-col flex-center border-round" style="height: 50%;width: 100%;position: relative;">
                    <h1 class="clr-white animated fadeInRight">Let's find what you like</h1>
                    <div class="flex-row-to-col flex-center">
                        <form action="/Search/view" method="get" class="search-bar" style="height:fit-content">
                            <input style="color:white" type="search" name="search" class="form-ctrl" placeholder="Search">
                            <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                        </form>
                        <button class="btn btn-solid" id="near-me" onclick="nearme()"><i class="fas fa-map-marker-alt"></i>&nbsp;Near me</button>
                        <img src="/Public/assets/search.svg" alt="" style="max-width: 45%;max-height:95%;position:absolute;top:0;right:0;">
                    </div>
                </search>
            </div>

            <div class="flex-col flex-center" style="height: 100vh;">
                <div class="home-events">
                    <div class="flex-row flex-center">
                        <video class="border-round" autoplay muted loop>
                            <source src="/Public/assets/covid.mp4" type="video/mp4">
                        </video>
                    </div>

                    <div class="flex-col flex-center grid-row-1">
                        <h1 class="animated fadeInRight">Be safe and spread <span class="clr-red">&#xf004;</span><br>Not COVID</h1>
                        <div>
                            <img src="/Public/assets/covid-1.svg" style="width:100px" alt="">
                            <img src="/Public/assets/covid-2.svg" style="width:50px" alt="">
                        </div>
                        <p class="margin-md felx-row flex-center">Follow health and saftey protocols<br>and engage in your community</p>
                    </div>
                </div>
            </div>

            <?php if ($guest_user) { ?>
                <div class="flex-col flex-center" style="height: 100vh;">
                    <div class="home-events item flex-row-to-col flex-space">
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
                </div>
            <?php } ?>

            <div class="flex-col flex-center" style="height: 100vh;">
                <div class="home-events">
                    <div class="flex-col flex-center">
                        <img src="/Public/assets/sample-1.svg" alt="">
                        <h1 class="animated fadeInRight">Recently added</h2>
                            <p style="text-align: center">Interested in newly published events?<br> Here is your place!<br> Keep scrolling left to find out more and more events.</p>
                    </div>
                    <div class="flex-row margin-lg" id='recent-events'></div>
                </div>
            </div>

            <div class="flex-col flex-center" style="height: 100vh;">
                <div class="home-events">
                    <div id="map" class="margin-side-md grid-row-2"></div>
                    <div class="flex-col flex-center grid-row-1">
                        <img src="/Public/assets/sample-2.svg" alt="">
                        <h2>Near me</h2>
                        <p style="text-align: center">Look what we've found!<br>We got the events within your reach for you!</p>
                    </div>
                </div>
            </div>

            <div class="flex-col flex-center" style="height: 100vh;">
                <div class="home-events">
                    <div class="flex-col flex-center">
                        <img src="/Public/assets/sample-3.svg" alt="">
                        <h2 class="animated fadeInRight">Need your donations</h2>
                        <p style="text-align: center">The events that are waiting just for your kindness and generosity.<br>Join the donors' community <br>&<br> support the good-willed projects.</p>
                    </div>
                    <div class="flex-row margin-lg" id='donation-events'></div>
                </div>
            </div>

            <div class="flex-col flex-center" style="height: 90vh;">
                <div class="home-events" style="scroll-snap-align: start;">
                    <div class="flex-row margin-lg grid-row-2" id='volunteer-events'></div>

                    <div class="flex-col flex-center grid-row-1">
                        <img src="/Public/assets/sample-4.svg" alt="">
                        <h2>Need your engagement</h2>
                        <p style="text-align: center">The events that are waiting just for you.<br> Hurry up and be a proud VOLUNTEER!<br> Become a responsible citizen and be a part of making a better society.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php"; ?>
    </div>

</body>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSB7zeeAI3QC42UmxHEFqS715ulfPFASc&callback=initMap&libraries=&v=weekly" async></script>


<script>
    class Particle {

        constructor(svg, coordinates, friction) {
            this.svg = svg
            this.steps = ($(window).height()) / 2
            this.item = null
            this.friction = friction
            this.coordinates = coordinates
            this.position = this.coordinates.y
            this.dimensions = this.render()
            this.rotation = Math.random() > 0.5 ? "-" : "+"
            this.scale = 0.5 + Math.random()
            this.siner = 200 * Math.random()
        }

        destroy() {
            this.item.remove()
        }

        move() {
            this.position = this.position - this.friction
            let top = this.position;
            let left = this.coordinates.x + Math.sin(this.position * Math.PI / this.steps) * this.siner;
            this.item.css({
                transform: "translateX(" + left + "px) translateY(" + top + "px) scale(" + this.scale + ") rotate(" + (this.rotation) + (this.position + this.dimensions.height) + "deg)"
            })

            if (this.position < -(100)) {
                this.destroy()
                return false
            } else {
                return true
            }
        }

        render() {
            this.item = $(this.svg, {
                css: {
                    transform: "translateX(" + this.coordinates.x + "px) translateY(" + this.coordinates.y + "px)"
                }
            })
            $("back").append(this.item)
            return {
                width: this.item.width(),
                height: this.item.height()
            }
        }
    }

    const rhombus = '<svg viewBox="0 0 13 14"><path class="rhombus" d="M5.9,1.2L0.7,6.5C0.5,6.7,0.5,7,0.7,7.2l5.2,5.4c0.2,0.2,0.5,0.2,0.7,0l5.2-5.4 C12,7,12,6.7,11.8,6.5L6.6,1.2C6.4,0.9,6.1,0.9,5.9,1.2L5.9,1.2z M3.4,6.5L6,3.9c0.2-0.2,0.5-0.2,0.7,0l2.6,2.6 c0.2,0.2,0.2,0.5,0,0.7L6.6,9.9c-0.2,0.2-0.5,0.2-0.7,0L3.4,7.3C3.2,7.1,3.2,6.8,3.4,6.5L3.4,6.5z" /></svg>'

    const pentahedron = '<svg viewBox="0 0 561.8 559.4"><path class="pentahedron" d="M383.4,559.4h-204l-2.6-0.2c-51.3-4.4-94-37-108.8-83l-0.2-0.6L6,276.7l-0.2-0.5c-14.5-50,3.1-102.7,43.7-131.4 L212.1,23C252.4-7.9,310.7-7.9,351,23l163.5,122.5l0.4,0.3c39,30.3,56,82.6,42.2,130.3l-0.3,1.1l-61.5,198 C480.4,525.6,435.5,559.4,383.4,559.4z M185.5,439.4h195.2l61.1-196.8c0-0.5-0.3-1.6-0.7-2.1L281.5,120.9L120.9,241.2 c0,0.3,0.1,0.7,0.2,1.2l60.8,195.8C182.5,438.5,183.7,439.1,185.5,439.4z M441,240.3L441,240.3L441,240.3z"/></svg>'
    const x = '<svg viewBox="0 0 12 12"> <path class="x" d="M10.3,4.3H7.7V1.7C7.7,0.8,7,0,6,0S4.3,0.8,4.3,1.7v2.5H1.7C0.8,4.3,0,5,0,6s0.8,1.7,1.7,1.7h2.5v2.5 C4.3,11.2,5,12,6,12s1.7-0.8,1.7-1.7V7.7h2.5C11.2,7.7,12,7,12,6S11.2,4.3,10.3,4.3z"/></svg>'

    const circle = '<svg x="0px" y="0px" viewBox="0 0 13 12"> <path class="circle" d="M6.5,0.1C3.4,0.1,0.8,2.8,0.8,6s2.6,5.9,5.7,5.9s5.7-2.7,5.7-5.9S9.7,0.1,6.5,0.1L6.5,0.1z M6.5,8.8 C5,8.8,3.8,7.6,3.8,6S5,3.2,6.5,3.2S9.2,4.4,9.2,6S8,8.8,6.5,8.8L6.5,8.8z"/> </svg>'

    const point = '<svg viewBox="0 0 12 12"> <path class="point" d="M6,7.5L6,7.5C5.1,7.5,4.5,6.9,4.5,6v0c0-0.9,0.7-1.5,1.5-1.5h0c0.9,0,1.5,0.7,1.5,1.5v0C7.5,6.9,6.9,7.5,6,7.5z "/> </svg>'

    function randomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }


    const data = [point, rhombus, pentahedron, circle, x]

    let isPaused = false;
    window.onblur = function() {
        isPaused = true;
    }.bind(this)
    window.onfocus = function() {
        isPaused = false;
    }.bind(this)

    let particles = []

    setInterval(function() {
        if (!isPaused) {
            particles.push(
                new Particle(data[randomInt(0, data.length - 1)], {
                    "x": (Math.random() * $(window).width()),
                    "y": $(window).height()
                }, (1 + Math.random() * 3))
            )
        }
    }, 200)

    function update() {
        particles = particles.filter(function(p) {
            return p.move()
        })
        requestAnimationFrame(update.bind(this))
    }
    update()


    function showPage() {
        document.getElementsByClassName("loader")[0].style.display = "none";
        document.getElementsByClassName("home-div")[0].style.display = "block";
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
            donation_status: 1,
            container: 'donation-events'
        });
    }

    async function volunteerEvents() {
        search({
            sort: 'volunteer_percent',
            way: 'ASC',
            volunteer_status: 1,
            container: 'volunteer-events'
        });
    }



    async function search({
        range = '',
        sort = '',
        way = '',
        volunteer_status = '',
        donation_status = '',
        limit = 10,
        container = '',
    } = {}) {

        const position = await getCoordinates();
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;

        $.ajax({
            url: "/Search/searchAll", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                status: ['published'],
                latitude: latitude,
                longitude: longitude,
                distance: range,
                volunteer_status: volunteer_status,
                donation_status: donation_status,
                order_type: sort,
                way: way,
                limit: limit,
                offset: 0
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
                    <figure onclick="location.href = '/Event/view?page=about&&event_id=${evn.event_id}' ">
                        <div class="content">
                            <div class="photo-container"><img src="${evn.cover_photo}" style="object-fit: cover;" alt="">
                                <div class="stats">
                                <div>
                                    <span>Volunteered ${evn.volunteered==null ? 0 : Math.round(evn.volunteer_percent)}%</span>
                                    <br>
                                    <span>Donations ${evn.donation_percent==null ? 0 : Math.round(evn.donation_percent)}%</span>
                                    <br>
                                    <span>Distance ${evn.distance==null ? "- " : Math.round(evn.distance)} KM</span>
                                    </div>
                                </div>
                            </div>
                            <p class="margin-md" style="margin-bottom:0;"><b>${evn.event_name}</b></p>
                            <p class="margin-md about" style="margin-top:0">${evn.start_date==evn.end_date ? evn.end_date : 'From:'+evn.start_date+'<br>To:'+evn.end_date}</p>
                            <div class="flex-col margin-side-md" >
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <p>Donations</p>
                                <p>${evn.donation_status==0 ? '<i class="fas fa-times fa-xs clr-red margin-side-md"></i>' : '<i class="fas fa-check fa-xs clr-green margin-side-md"></i>'}</p>
                                </div>
                                <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                <div style="display:flex;align-items:center;position:relative;width:100%;"><div style="border-radius:6px;position:absolute;width:${(evn.donation_percent==null || evn.donation_percent<5) ? 5 :(evn.donation_percent>100? 100 : Math.round(evn.donation_percent)) }%;background-color:#FFB319;height:6px;"></div></div>
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

        Nearsearch(latitude, longitude);
    }

    async function Nearsearch(latitude, longitude) {

        $.ajax({
            url: "/Search/searchAll", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                status: ['published'],
                latitude: latitude,
                longitude: longitude,
                distance: 20,
                offset: 0,
                limit: 10,
                is_virtual: 0
            },
            success: function(result) {

                if (result.length == 0)
                    return;
                else
                    result.forEach(evn => {
                        let template = `
                    <figure onclick="location.href = '/Event/view?page=about&&event_id=${evn.event_id}' ">
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
                            <p class="margin-md about" style="margin-top:0">${evn.start_date==evn.end_date ? evn.end_date : 'From:'+evn.start_date+'<br>To:'+evn.end_date}</p>
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



    function isElementInViewport(elem) {
        var $elem = $(elem);

        // Get the scroll position of the page.
        var scrollElem = 'html';
        var viewportTop = $(scrollElem).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        // Get the position of the element on the page.
        var elemTop = Math.round($elem.offset().top);
        var elemBottom = elemTop + $elem.height();
        console.log(viewportTop, viewportBottom, elemTop, elemBottom);

        return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
    }

    function checkScroll() {
        var videos = document.getElementsByTagName("video");
        var animations = document.querySelectorAll(".animated");

        for (var i = 0; i < videos.length; i++) {
            if (isElementInViewport(videos[i])) {
                videos[i].play();
            } else {
                videos[i].pause();
            }
        }

        for (var i = 0; i < animations.length; i++) {
            if (isElementInViewport(animations[i])) {
                if (!animations[i].classList.contains("start"))
                    animations[i].classList.add("start");
            }
        }

    }

    window.addEventListener('scroll', checkScroll, false);
    window.addEventListener('resize', checkScroll, false);
</script>

</html>