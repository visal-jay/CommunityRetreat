<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Forum</title>
</head>

<style>
    h3{
        margin: 0;
    }
    update {
        display: flex;
        justify-content: flex-end;
    }

    .align-left{
        text-align: left;
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

    #map {
        height: 350px;
        width: 350px;
        border-radius: 8px;
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

    .date {
        display: flex;
        flex-direction: row;
    }

    @media screen and (max-width:800px) {
        .card-container{
            height: fit-content;
    }
        .form {
            width: 80%;

        }

        .show-form {
            height: 800px;
            transition: height, 0.3s linear;
        }

        ::-webkit-scrollbar {
            display: none;
        }
        #map{
            width: 300px;
            height: 300px;
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
    <div class="flex-col flex-center margin-side-lg">
        <button class="btn margin-lg" onclick="add()">Add Announcement &nbsp; <i class="fas fa-plus"></i></button>
        <div class="card-container margin-side-lg">

            <div class="flex-col event-card-details">
                <h3 class="margin-md">Announcement</h3>
                <date class="margin-md">28.10.2021</date>
                <description class="margin-md">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione nemo nostrum perspiciatis. Impedit, praesentium. Fuga ab numquam distinctio reprehenderit laudantium quae possimus, odio quisquam quia officia illo laborum eligendi ea?</description>
                    <update class="margin-md">
                        <i class="btn-icon far fa-edit clr-green margin-side-md"></i>
                        <i class="btn-icon far fa-trash-alt clr-red margin-side-md"></i>
                    </update>
            </div>
        </div>
    </div>
</body>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN2HxM42eIrEG1e5b9ar2H_2_V6bMRjWk&callback=initMap&libraries=&v=weekly" async></script>
<script>
    function add() {
        document.querySelector(".form").classList.toggle("show-form");
    }
</script>

</html>