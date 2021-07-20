<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Event Page</title>
</head>
<style>
    .photo-container {
        height: 55%;
        text-align: center;
        position: relative;
        padding: 2rem 2rem 0rem 2rem;
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

    table {
        width: 100%;
        table-layout: fixed;
    }

    td {
        text-align: center;
        padding: 1rem 0;
    }

    .event-card-details {
        display: flex;
        flex-direction: row;
    }

    h1 ,h2{
        margin: 0px;
    }

    .info{
        text-align: center;
    }
    @media screen and (max-width:767px) {
        h1{
            font-size: 1.5rem;
        }
        table tr>* {
            display: block;
        }

        table tr {
            display: table-cell;
        }

        table th {
            padding: .5rem 0;
            text-align: left;
        }

        td {
            padding: .5rem 0;
        }

        .event-card-details {
            flex-direction: column;
        }
    }
</style>
<?php include "nav.php" ?>

<body>

    <div class="photo-container ">
        <div class="cover-place-holder cover border-round">
            <img src="/Public/assets/mountains.jfif" alt="" class="photo-element">
        </div>
    </div>
    <div class="flex-row flex-center">
        <h1>Event Name</h1>
    </div>

    <div class="nav-secondary">
        <div class="nav-secondary-bar margin-lg">
            <a class="btn  margin-side-md" style=" margin-bottom:10px;" href="/view/adoption_listing.php ">About</a>
            <a class="btn margin-side-md" style=" margin-bottom:10px;" href="# ">Gallery</a>
            <a class="btn margin-side-md" style=" margin-bottom:10px;" href="/view/adoption_listing.php ">Forum</a>
            <a class="btn margin-side-md" style=" margin-bottom:10px;" href="/view/adoption_listing.php ">Feedback</a>
            <a class="btn margin-side-md" style=" margin-bottom:10px;" href="# ">Budget</a>
            <a class="btn margin-side-md" style=" margin-bottom:10px;" href="# ">User Roles</a>
        </div>
    </div>


</body>
<script>
    function resizeProfile() {
        var coverHeight = (document.querySelector(".cover").offsetHeight);
        document.querySelector(".profile-pic").style.top = coverHeight + "px";
        var profileHeight = (document.querySelector(".profile-pic").offsetHeight);
        document.querySelector(".photo-container").style.height = (parseInt(coverHeight)+parseInt(profileHeight)) + "px";
    }
    window.onload = resizeProfile();
    window.addEventListener("resize", resizeProfile);

    document.querySelector(".active").scrollIntoView({
        behavior: 'auto',
        block: 'center',
        inline: 'center'
    });
</script>

</html>