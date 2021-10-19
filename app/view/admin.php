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
        height: 700px;
        transition: height, 0.3s linear;
    }
 
    .event-card-details {
        display: flex;
        flex-direction: row;
    }
    ::-webkit-scrollbar {
        width: 2px;
        height: 8px;
        margin: 2rem;
    }

    /* Track */


    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #16c79a;
        border-radius: 5px;
        border: 1 px solid #16c79a;
        margin: 1rem;
        height: 2px;
        width: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #16c79a;
    }

    .remove-btn{
        background-color: red;
        color: white;
        border: none;

    }
    
</style>
<?php if($admin) include "nav.php" ?>

<body>
    <div class="flex-col flex-center margin-side-lg " >
        <h1>Complaints</h1>
        <?php
            foreach($complaints as $complaint){?>
    
                    <div class='margin-side-lg card-container' style='margin-top: 2rem; width:90%'>
                        <div class='event-card-details flex-col'>
                            <div class='margin-side-md'>
                                <h3 onclick="<?= $complaint['path'] ?>"><?=$complaint['complaint_name']?></h3>
                            </div>
                            <div class='margin-side-md'>
                                <h4>By: <?=$complaint['username']?></h4>
                            </div>
                            <div class='margin-side-md'>
                                <h4>Date: <?=$complaint['date']?></h4>
                            </div>
                            <div class='margin-side-md'>
                                <p><?=$complaint['complaint']?></p>
                            </div>
                            <div class="flex-row flex-center">
                                <div class='margin-md'><button class='btn bg-green clr-white'>Resolve</button></div>
                                <div class='margin-md'><button class='btn bg-red clr-white'>Dismiss</button></div>
                            </div>
                           
                        </div>
                    </div>
         <?php } ?>
      
    </div>
    
</body>
<?php include "footer.php"?>
<script>
    function addEvent() {
        document.querySelector(".form").classList.toggle("show-form");
    }

    function remove() {
        event.target.style.display = "none";
        event.target.nextElementSibling.style.display = "flex";
    }

    function cancel() {
        var cancel = event.target.parentNode;
        cancel.style.display = "none";
        cancel.previousElementSibling.style.display = "block";

    }
</script>

</html>