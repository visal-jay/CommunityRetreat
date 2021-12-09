<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>CommunityRetreat</title>
</head>
<style>
    p{
        margin:3px;
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
 
    .event-card-details {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
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

    @media screen and (max-width:800px) {
        .event-card-details {
            display: flex;
            flex-direction: column;
        }
    }
    
</style>
<?php if($admin) include "nav.php" ?>

<body>
    <div class="flex-center margin-side-lg " style="min-height: 100vh;">
        <div><h1 style="text-align: center;">Complaints</h1></div>
    
        <?php
            foreach($complaints as $complaint){?>
    
                    <div class='' style='box-shadow: none; border: none;'>
                        <div class='event-card-details'>
                            <div class='margin-side-md' style="width: 100px;"> 
                                <h4 onclick="<?= $complaint['path'] ?>"><?=$complaint['complaint_name']?></h4>
                            </div>
                            <div class='margin-side-md' style="display: flex; align-items: center;width: 195px;">
                                <p><b>By: </b><?=$complaint['username']?></p>
                            </div>
                            <div class='margin-side-md' style="display: flex; align-items: center;width: 210px;">
                                <p><b>Date: </b><?=$complaint['date']?><p>
                            </div>
                            <div class='margin-side-md' style="display: flex; align-items: center;width: 150px;">
                                <p><?=$complaint['complaint']?></p>
                            </div>
                            <div class="flex-row flex-center" style="width: 250px;">
                                <div class="flex-row flex-center">
                                    <button class='btn btn-small bg-green clr-white' onclick="remove_complaint();" style="border: none;">Resolve</button>
                                    <div class="flex-row flex-space " style="display: none;">
                                    <p class="margin-side-md" style="white-space: nowrap;">Are you sure</p>
                                    <?php if($complaint['event_id'] != NULL){?>
                                        <form method="post" action="/Admin/removeEvent" class="flex-row flex-center">
                                        <input name="event_id" type="hidden" value="<?= $complaint["event_id"] ?>">
                                    <?php } else{ ?>
                                        <form method="post" action="/Admin/removeUser" class="flex-row flex-center">
                                        <input name="uid" type="hidden" value="<?= $complaint["uid"] ?>">
                                    <?php } ?>
                                        <input type="hidden" name="complaint_id" value="<?= $complaint['complaint_id']?>"></input>
                                        <button class="btn-icon flex-row flex-center"><i type="submit" class="fas fa-check clr-green margin-side-md"></i>&nbsp;</button>
                                    </form>
                                    <i class="fas fa-times clr-red  margin-side-md" onclick="cancel_complaint()"></i>
                                    </div>
                                </div>
                                <form class='margin-md' action="/Complaint/dismissComplaint" method="post">
                                    <input type="hidden" name="complaint_id" value="<?= $complaint['complaint_id']?>"></input>
                                    <button class='btn btn-small bg-red clr-white'  style="border: none;">Dismiss</button>
                                </form>
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

    function remove_complaint() {
        event.target.style.display = "none";
        event.target.nextElementSibling.style.display = "flex";
        }

    function cancel_complaint() {
        var cancel = event.target.parentNode;
        cancel.style.display = "none";
        cancel.previousElementSibling.style.display = "block";

    }
</script>

</html>