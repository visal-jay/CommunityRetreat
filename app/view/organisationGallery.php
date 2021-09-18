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
    .form {
        min-width: 50%;
        overflow: hidden;
        height: 0px;
        transition: height, 0.3s linear;
    }

    .show-form {
        height: 130px;
        transition: height, 0.3s linear;
    }

    .gallery-container {
        display: flex;
        border-radius: 8px;
        box-shadow: 0px 0px 0px 1px rgb(192, 192, 192);
        padding: 0;
    }

    .grid {
        width: 80%;
        display: grid;
        grid-gap: 10px;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        grid-auto-rows: 20px;
    }


    figure {
        position: relative;
        background: #eeeeee;
        margin: 0;
        display: grid;
        grid-template-rows: 1fr auto;
        border-radius: 8px;
        width: fit-content;
        height: fit-content;
    }

    p {
        margin: 0.5rem;
    }

    figure>img {
        grid-row: 1 / -1;
        grid-column: 1;
    }

    .grid div {
        align-items: baseline;
        height: fit-content;
        border-radius: 8px;
        transition: all .4s ease-in-out;
    }

    .grid div img {
        border-radius: 8px;
        width: 100%;
    }

    .delete-button {
        background: white;
        opacity: 0.5;
        padding: 0.2rem;
        position: absolute;
        right: 11px;
        top: 11px;
        border-radius: 1px !important;
        transition: opacity 0.2s ease-in-out;
    }

    .delete-button:hover {
        opacity: 1;
    }

    .delete-button:active {
        opacity: 1;
    }

    @media screen and (max-width:767px) {
        .grid {
            grid-gap: 10px;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        }

        .grid div {
            margin: 0px;
        }

        .event-card-details {
            flex-direction: column;
        }
    }
</style>

<?php if ($organization) include "nav.php" ?>


<body>
    <div class="flex-col flex-center margin-side-lg">
        <h1>Gallery</h1>
        <?php if ($organization) { ?>
            <button class="btn btn-solid margin-lg" onclick="addPhoto()">Add photo &nbsp; <i class="fas fa-plus"></i></button>
            <form class="form flex-col flex-center" action="/organisation/addPhoto" method="post" enctype="multipart/form-data">
                <label for="myfile">Select a file:</label>
                <input type="file" class="form-ctrl margin-md" id="myfile" name="photo">
                <button type="submit" class="btn ">Save</button>
            </form>
        <?php } ?>


        <div class="grid margin-lg">
            <?php foreach ($photos as $photo) { ?>
                <figure class="item bg-green">
                    <div class="content">
                        <?php if (!$guest_user && $photo["uid"] == $_SESSION["user"]["uid"]) { ?>
                            <form class="delete-button" method="post" action="/organisation/deletePhoto">
                                <button type="submit" class="btn-icon" name="photo" value="<?= $photo["image"] ?>"> <i class="far fa-trash-alt"></i></button>
                            </form>
                        <?php  } ?>
                        <div class="gallery-container flex flex-center"><img src="<?= $photo["image"] ?>" style="object-fit: cover;" alt=""></div>
                    </div>
                </figure>
            <?php } ?>
            <figure class="item">
                <div class="delete-button">
                    <i class="far fa-trash-alt"></i>
                </div>
                <div class="photo-container flex flex-center content"><img src="/Public/assets/login-image.jpg" style="object-fit: cover;" alt=""></div>
            </figure>
            <figure class="item">
                <div class="delete-button">
                    <i class="far fa-trash-alt"></i>
                </div>
                <div class="photo-container flex flex-center content"><img src="/Public/assets/newphoto.jpeg" style="object-fit: cover;" alt=""></div>
            </figure>
            <figure class="item">
                <div class="delete-button">
                    <i class="far fa-trash-alt"></i>
                </div>
                <div class="photo-container flex flex-center content"><img src="/Public/assets/photo.jpeg" style="object-fit: cover;" alt=""></div>
            </figure>
            <figure class="item">
                <div class="delete-button">
                    <i class="far fa-trash-alt"></i>
                </div>
                <div class="photo-container flex flex-center content"><img src="/Public/assets/login-image.jpg" style="object-fit: cover;" alt=""></div>
            </figure>
            <figure class="item">
                <div class="delete-button">
                    <i class="far fa-trash-alt"></i>
                </div>
                <div class="photo-container flex flex-center content"><img src="/Public/assets/photo.jpeg" style="object-fit: cover;" alt=""></div>
            </figure>
            <figure class="item">
                <div class="delete-button">
                    <i class="far fa-trash-alt"></i>
                </div>
                <div class="photo-container flex flex-center content"><img src="/Public/assets/login-image.jpg" style="object-fit: cover;" alt=""></div>
            </figure>
            <figure class="item">
                <div class="delete-button">
                    <i class="far fa-trash-alt"></i>
                </div>
                <div class="photo-container flex flex-center content"><img src="/Public/assets/login-image.jpg" style="object-fit: cover;" alt=""></div>
            </figure>



        </div>
    </div>
</body>
<script>
    function addPhoto() {
        document.querySelector(".form").classList.toggle("show-form");
    }

    function resizeGridItem(item) {
        grid = document.getElementsByClassName("grid")[0];
        rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
        rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
        rowSpan = Math.ceil((item.querySelector('.content').getBoundingClientRect().height + rowGap) / (rowHeight + rowGap));
        item.style.gridRowEnd = "span " + rowSpan;
        //location.reload();
    }

    function resizeAllGridItems() {
        allItems = document.getElementsByClassName("item");
        for (x = 0; x < allItems.length; x++) {
            resizeGridItem(allItems[x]);
        }
    }

    window.onload = resizeAllGridItems();
    window.addEventListener("resize", resizeAllGridItems);


    /* allItems = document.getElementsByClassName("item");
    for (x = 0; x < allItems.length; x++) {
        imagesLoaded(allItems[x], resizeInstance);
    } */
</script>

</html>