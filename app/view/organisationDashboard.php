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
    .photo-container {
        height: 60%;
        text-align: center;
        position: relative;
        padding: 2rem 2rem 0rem 2rem;
    }

    .profile-pic {
        max-width: 9%;
        min-width: 80px;
        aspect-ratio: 1/1;
        background-color: gray;
        border: 1px solid white;
        position: absolute;
        overflow: hidden;
        top: 20px;
        left: 0;
        right: 0;
        margin: auto
    }


    .cover-place-holder {
        vertical-align: center;
        position: absolute;
        left: 0;
        right: 0;
        margin: auto;
        max-height: 340px;
        min-height: 100px;
        background-color: gray;
        overflow: hidden;
        aspect-ratio: 5/2;
        max-width: 80%;
    }

    .photo-element {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }

    .nav-secondary {
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .nav-secondary-bar {

        display: flex;
        align-items: center;
        overflow: auto;

    }

    .active {
        background-color: #16c79a !important;
        color: white !important;
    }

    /* Designing for scroll-bar */
    ::-webkit-scrollbar {
        width: 2px;
        height: 8px;
        margin: 2rem;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: gainsboro;
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


    p {
        text-align: justify;
        text-justify: inter-word;
    }

    h1,
    h2 {
        margin: 5px 0;
    }

    .info {
        padding: 0 2rem;
        margin-bottom: 100px;
    }

    #map {
        width: 100%;
        aspect-ratio: 2/1;
    }

    .image-upload {
        position: absolute;
        bottom: 11px;
        right: 11px;
    }

    .image-upload>input {
        display: none;
    }

    .latlang>input {
        height: 0px;
    }


    .map-not {
        opacity: 0.5;
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

    iframe {
        width: 100%;
        height: 100%;
    }

    @media screen and (max-width:800px) {
        .cover-place-holder {
            min-width: 80%;
        }
        h1 {
            font-size: 1.5rem;
        }

        h2 {
            font-size: 1rem;
        }



        .event-card-details {
            flex-direction: column;
        }

        #map {
            width: 300px;
            height: 300px;
        }
    }
</style>
<?php include "nav.php"; ?>

<body>

    <?php if ($organization) { ?>
        <form action="/Organisation/update" method="post" enctype="multipart/form-data">
        <?php } ?>
        <div class="photo-container">
            <div class="cover-place-holder cover border-round">
                <img src="<?= $cover_pic ?>" alt="" class="photo-element">
                <?php if ($organization) { ?>
                    <div class="image-upload hidden form">
                        <label for="file-input">
                            <i class="fas fa-edit clr-white"></i>
                        </label>
                        <input id="file-input" name="cover-photo[]" type="file" />
                    </div>
                <?php } ?>
            </div>
            <div class="profile-pic border-round">
                <img src="<?= $profile_pic ?>" alt="" class="photo-element">
                <?php if ($organization) { ?>
                    <div class="image-upload hidden form">
                        <label for="file-input-1">
                            <i class="fas fa-edit clr-white"></i>
                        </label>
                        <input id="file-input-1" name="profile-photo[]" type="file" />
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php if ($registered_user || $guest_user || $admin) { ?>
            <div class="nav-secondary">
                <div class="nav-secondary-bar margin-lg">
                    <a class="btn margin-side-md active" style=" margin-bottom:10px;" onclick="page('about');event.target.classList.add('active');">About</a>
                    <a class="btn margin-side-md" style=" margin-bottom:10px;" onclick="page('gallery');event.target.classList.add('active');">Gallery</a>
                    <a class="btn margin-side-md" style=" margin-bottom:10px;" onclick="page('events');event.target.classList.add('active');">Events</a>
                </div>
            </div>
            <iframe src="/organisation/gallery?org_id=<?= $_GET["org_id"] ?>" frameborder="0" id="gallery" class="hidden"></iframe>
            <iframe src="/organisation/events?org_id=<?= $_GET["org_id"] ?>" frameborder="0" id="events" class="hidden"></iframe>

        <?php } ?>

        <div class="flex-col flex-center">
            <div class="info" id="about">
                <div class="flex-row flex-center">
                    <div class="data">
                        <h1><?= $username ?></h1>
                    </div>
                </div>
                <div class="flex-col">
                    <h2>About us</h2>
                    <div class="data">
                        <p><?= $about_us ?></p>
                    </div>
                    <?php if ($organization) { ?>
                        <textarea name="about_us" class="form form-ctrl hidden" placeholder="Enter about us"><?= $about_us ?></textarea>
                    <?php } ?>
                </div>
                <div class="flex-col">
                    <h2>Contact us</h2>
                    <div>
                        <a href="mailto:<?= $email ?>"><?= $email ?> </a>
                        <p><?= $contact_number ?></p>
                    </div>
                </div>
                <?php if ($organization || (isset($map) && $map == true)) { ?>
                    <div class="flex-col flex-center margin-md">
                        <h2>Locate us</h2>
                        <div id="map" class="border-round <?php if (!$map) echo "map-not"; ?> "></div>
                        <div class="latlang" class="form hidden">
                            <input class="hidden" name="longitude" id="longitude" value="<?= $longitude ?>">
                            <input class="hidden" name="latitude" id="latitude" value="<?= $latitude ?>">
                        </div>
                    </div>
                <?php } ?>

                <?php if ($organization) { ?>
                    <div class="flex-row flex-center">
                        <button type="button" class="btn btn-solid data" onclick="edit()">Edit &nbsp;&nbsp; <i class="fas fa-edit "></i></button>
                        <button type="button" class="btn btn-solid bg-red border-red margin-side-md form hidden" onclick="edit()">Close &nbsp;&nbsp; <i class="fas fa-times "></i></button>
                        <button type="submit" class="btn btn-solid form hidden">Save &nbsp; <i class="fas fa-check "></i></button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php if ($organization) { ?>
        </form>
    <?php } ?>



</body>

<?php include "footer.php" ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN2HxM42eIrEG1e5b9ar2H_2_V6bMRjWk&callback=initMap&libraries=&v=weekly" async></script>

<script>
    <?php if ($organization) { ?>

        function edit() {
            if (marker.draggable == false)
                marker.setOptions({
                    draggable: true
                });
            else
                marker.setOptions({
                    draggable: false
                });
            if (!<?php if ($map) echo 'true';
                    else echo 'false'; ?>)
                document.getElementById('map').classList.toggle("map-not");
            var data = document.getElementsByClassName("data");
            var form = document.getElementsByClassName("form");
            for (var i = 0; i < data.length; i++) {
                data[i].classList.toggle("hidden");
            }
            for (var i = 0; i < form.length; i++) {
                form[i].classList.toggle("hidden");
            }
        }
    <?php } ?>

    function resizeProfile() {
        if (CSS.supports("( aspect-ratio: 1/1 )") == false) {
            document.querySelector(".cover-place-holder").style.width = (document.querySelector(".photo-container").offsetWidth)*0.6 + "px";
            var cover_width = (document.querySelector(".cover").offsetWidth);
            document.querySelector(".cover-place-holder").style.height = parseInt(cover_width) * 2 / 5 + "px";
            console.log(document.querySelector(".profile-pic").style.height);
            document.querySelector(".profile-pic").style.height = document.querySelector(".profile-pic").offsetWidth + "px";
        }

        var coverHeight = (document.querySelector(".cover").offsetHeight);
        document.querySelector(".profile-pic").style.top = coverHeight + "px";
        var profileHeight = (document.querySelector(".profile-pic").offsetHeight);
        document.querySelector(".photo-container").style.height = (parseInt(coverHeight) + parseInt(profileHeight) * 0.75) + "px";
    }

    function resizeInfo() {
        var coverWidth = (document.querySelector(".cover").offsetWidth);
        document.querySelector(".info").style.width = coverWidth + "px";
    }

    function resize() {
        resizeProfile();
        resizeInfo();
    }
    window.onload = resize();
    window.addEventListener("resize", resize);


    let map;
    var marker;
    var lat = "<?= $latitude ?>";
    var long = "<?= $longitude ?>";

    console.log(latitude, longitude);

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -34.397,
                lng: 10.644
            },
            zoom: 6,
        });
        if (lat != "" || long != "")
            showPosition();
    }


    if (lat === "" && long === "") {
        navigator.geolocation.getCurrentPosition((position) => {
            lat = position.coords.latitude;
            long = position.coords.longitude;
            showPosition();
        });
    }



    function showPosition(position) {
        var myLatlng = new google.maps.LatLng(lat, long);

        marker = new google.maps.Marker({
            position: myLatlng,
            draggable: false,
            title: "Your location!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);
        map.setCenter(myLatlng);
        map.setZoom(10);

        google.maps.event.addListener(marker, 'dragend', function(evt) {
            document.getElementById('longitude').value = evt.latLng.lng().toFixed(3);
            document.getElementById('latitude').value = evt.latLng.lat().toFixed(3);
            //document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
        });
    }

    function page(page) {
        var children = document.querySelector(".nav-secondary-bar").children;
        console.log(children);
        for (i = 0; i < children.length; i++) {
            children[i].classList.remove("active");
        }
        document.getElementById("about").classList.add("hidden");
        document.getElementById("gallery").classList.add("hidden");
        document.getElementById("events").classList.add("hidden");


        //document.getElementById(page).classList.add("active");
        document.getElementById(page).classList.toggle("hidden");

    }
</script>

</html>