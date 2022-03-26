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
    <meta property="og:url" content="https://www.communityretreat.me/Event/view?page=about&event_id=<?= $_GET['event_id'] ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $event_name ?>" />
    <meta property="og:description" content="Volunteer, Donate events" />
    <meta property="og:image" content="https://www.communityretreat.me<?= $cover_photo ?>" />
</head>
<style>
    a {
        text-decoration: none;
    }

    nav {
        width: 100%;
        height: 20px;
    }

    nav ul {
        list-style: none;
        margin: 0;
        padding-left: 0;
    }

    nav li {
        z-index: 100;
        display: block;
        float: left;
        padding: 1rem;
        position: relative;
        text-decoration: none;
        transition-duration: 0.5s;
    }

    nav li a {
        color: black;
    }


    nav li:focus-within a {
        outline: none;
    }

    nav ul li ul li {
        padding: 0.7rem;
    }

    nav ul li ul {
        z-index: 100;
        background: white;
        visibility: hidden;
        opacity: 0;
        min-width: 5rem;
        position: absolute;
        transition: all 0.5s ease;
        margin-top: 1rem;
        left: 0;
        display: none;
        border-radius: 0px 0px 5px 5px;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }

    nav ul li:hover>ul,
    nav ul li:focus-within>ul,
    nav ul li ul:hover,
    nav ul li ul:focus {
        visibility: visible;
        opacity: 1;
        display: block;
    }

    nav ul li ul li {
        clear: both;
        width: 100%;
    }

    .photo-container {
        height: 55%;
        text-align: center;
        position: relative;
        padding: 2rem 2rem 0rem 2rem;
    }

    .bg-event {
        background-position: center;
        background-size: cover;
        animation: none !important;
        height: 100%;
    }

    .profile-pic {
        max-width: 10%;
        min-width: 60px;
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
        max-height: 300px;
        min-height: 100px;
        background-color: gray;
        overflow: hidden;
        aspect-ratio: 4/1.2;
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

    .nav-active {
        text-decoration: underline;
        text-decoration-color: #16c79a !important;
    }

    .image-upload {
        position: absolute;
        bottom: 11px;
        right: 11px;
    }

    .image-upload>input {
        display: none;

    }

    .event-card-details {
        display: flex;
        flex-direction: row;
    }

    h1,
    h2 {
        margin: 0px;
    }

    .photo-upload-button {
        padding: 0.3rem;
        border-radius: 6px;
        background-color: white;
        opacity: 0.7;
    }

    @media screen and (max-width:767px) {
        h1 {
            font-size: 1.5rem;
        }

        .event-card-details {
            flex-direction: column;
        }
    }
</style>

<?php include "nav.php" ?>

<body>
    <nav role="navigation">
        <ul>
            <li><a href="/Event/view?page=home&&event_id=<?= $_GET["event_id"] ?>"><?= $event_name ?></a></li>
            <li><i class="fas fa-chevron-right"></i></li>
            <li id="chosen-nav">
                <ul class="dropdown" aria-label="submenu">
                    <?php $page = $_GET["page"] ?>
                    <li><a class="<?php if ($page == "home") echo "nav-active"; ?>" href="/Event/view?page=home&&event_id=<?= $_GET["event_id"] ?>">Home</a></li>
                    <li><a class="<?php if ($page == "about") echo "nav-active"; ?>" href="/Event/view?page=about&&event_id=<?= $_GET["event_id"] ?>">About</a></li>
                    <li><a class="<?php if ($page == "gallery") echo "nav-active"; ?>" href="/Event/view?page=gallery&&event_id=<?= $_GET["event_id"] ?>">Gallery</a></li>
                    <li><a class="<?php if ($page == "forum") echo "nav-active"; ?>" href="/Event/view?page=forum&&event_id=<?= $_GET["event_id"] ?>">Announcements</a></li>
                    <li><a class="<?php if ($page == "feedback") echo "nav-active"; ?>" href="/Event/view?page=feedback&&event_id=<?= $_GET["event_id"] ?>">Feedback</a></li>
                    <?php if ($organization || $moderator) { ?>
                        <li><a class="<?php if ($page == "volunteers") echo "nav-active"; ?>" href="/Event/view?page=volunteers&&event_id=<?= $_GET["event_id"] ?>">Volunteers</a></li>
                        <li><a class="<?php if ($page == "timeline") echo "nav-active"; ?>" href="/Event/view?page=timeline&&event_id=<?= $_GET["event_id"] ?>">WorkTimeline</a></li>
                        <li><a class="<?php if ($page == "chat") echo "nav-active"; ?>" href="/Event/view?page=chat&&event_id=<?= $_GET["event_id"] ?>">Chat</a></li>
                    <?php } ?>
                    <?php if ($organization || $treasurer) { ?>
                        <li><a class="<?php if ($page == "budget") echo "nav-active"; ?>" href="/Event/view?page=budget&&event_id=<?= $_GET["event_id"] ?>">Budget</a></li>
                        <li><a class="<?php if ($page == "donations") echo "nav-active"; ?>" href="/Event/view?event_id=<?= $_GET["event_id"] ?>&&page=donations">Donations</a></li>
                    <?php } ?>
                    <?php if ($organization) { ?>
                        <li><a class="<?php if ($page == "userroles") echo "nav-active"; ?>" href="/Event/view?page=userroles&&event_id=<?= $_GET["event_id"] ?>">User Roles</a></li>
                    <?php } ?>
                </ul>
            </li>
        </ul>
    </nav>

    <?php if ($page != "home") { ?>

        <div class="photo-container">
            <div class="cover-place-holder cover border-round">
                <div class="bg-event" style=" background-image: linear-gradient(0deg, rgb(32 32 32 / 72%), rgb(255 255 255 / 0%)), url(<?= $cover_photo ?>);">
                    <div style="display: flex;height: 100%;align-items: flex-end;">
                        <h1 class="margin-lg clr-white"><?= $event_name ?></h1>
                    </div>
                </div>

                <?php if (($organization || $moderator) && ($_GET["page"] == "about")) { ?>
                    <div class="image-upload hidden form">
                        <label for="file-input" class="photo-upload-button">
                            <i class="fas fa-edit"></i>
                        </label>
                        <input id="file-input" name="cover-photo[]" type="file" form="update-form" />
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="flex-col flex-center margin-md">
            <?php if (($organization || $moderator) && ($_GET["page"] == "about")) { ?>
                <label class="form hidden" id="event_name" for="">Event name</label>
                <input value="<?= $event_name ?>" type="text" name="event_name" form="update-form" class="form form-ctrl hidden" placeholder="Enter event name" required></input>
            <?php } ?>
        </div>
        <div style="height:20px"></div>
    <?php } ?>



    <?php
    if (isset($_GET["page"]) && $_GET["page"] == "home") require __DIR__ . "/eventHome.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "about") require __DIR__ . "/aboutEvent.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "gallery") require __DIR__ .  "/eventGallery.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "forum") require __DIR__ . "/forum.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "feedback") require __DIR__ . "/feedback.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "budget") require __DIR__ . "/budgeting.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "userroles") require __DIR__ . "/roles.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "timeline") require __DIR__ . "/workTimeline.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "donations") require __DIR__ . "/donateDetails.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "volunteers") require __DIR__ . "/volunteercopy.php";
    elseif (isset($_GET["page"]) && $_GET["page"] == "chat") require __DIR__ . "/chat/chatApp.php";
    ?>

</body>


<?php include "footer.php" ?>
<!-- Link Script for display input validation errors-->
<script src="/Public/assets/js/input_validation.js"></script>


<script>
    let selected_nav = document.querySelector(".nav-active");
    selected_nav.setAttribute("aria-haspopup", "true");
    selected_nav.setAttribute("style", "padding-right:10px");
    let selected_nav_outerHTML = selected_nav.outerHTML;
    selected_nav.parentElement.remove();
    document.getElementById("chosen-nav").insertAdjacentHTML('afterBegin', selected_nav_outerHTML + '&nbsp;<i class="fas fa-chevron-down"></i>');

    function resizeProfile() {
        var cover_height = (document.querySelector(".cover").offsetHeight);
        //var cover_width =(document.querySelector(".cover").offsetwidth);
        //document.document.querySelector(".cover").style.height= parseInt(cover_width)*2/7 + "px";
        document.querySelector(".photo-container").style.height = parseInt(cover_height) + "px";
    }


    function resize() {
        resizeProfile();
    }
    window.onload = resize();
    window.addEventListener("resize", resize);
</script>

</html>