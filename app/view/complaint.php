<!DOCTYPE html>
<html>
<head>
    <title>Complaint</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
</head>
    <style>
        /* Full-width input fields */
        .input[type=text]{
            width: 80%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .input[type=text]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Add some hover effects to buttons */
        .btn:hover{
            opacity: 1;
        }

        .complaint-form {
            width: 100%;
        }
        .complaint-popup-box {
            position: fixed;
            transform: scale(0);
            z-index: 2;
            width: 300px;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0px 0px 11px 2px rgb(0 0 0 / 93%);
            display: none;
            top: 50%;
            left: 50%;
            width: 50%;

        }

        .complaint-popup-box.active-popup {
            transition: all 300ms ease-in-out;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: row;
        }

       .complaint-blurr {
            overflow: hidden;
        }

    </style>
</head>
<body>
<?php if($guest_user){ ?>
    <button class="btn btn-solid" style="background-color: red; border:none;" onclick="window.location.href='/Login/view';">Complain &nbsp;<i class="far fa-comments"></i></button>
<?php } else { ?>
    <button class="btn btn-solid" style="background-color: red; border:none;" onclick="popupForm('complaint-form');">Complain &nbsp;<i class="far fa-comments"></i></button>
<?php } ?>

<div class="complaint-container">
        <div class="complaint-popup-box" id="complaint-form">
            <form action="/Complaint/makeComplaint" method="post" class="complaint-form">

                <div class="input form-item flex-col flex-center">
                    <label>Name</label> 
                    <input class="form-ctrl" style="width:90%;" name="complaint_name" id="complaint_name" type="text" />
                </div>

                <div class="input form-item flex-col flex-center">
                    <label>Complaint </label>
                <textarea name="complaint" id="complaint" class="form-ctrl" style="width:90%;" cols="30" rows="10"></textarea>

                <input type="hidden"  name="event_id" id="complaint_event_id" >

                <input type="hidden"  name="uid" id="complaint_uid" >

                <input type="hidden"  name="complaint_status" id="complaint_status" >
            </div>

                <div class="flex-row-to-col">
                    <div style="margin: 5px;">
                        <button type="submit" class="btn btn-solid" style="border:none;">Submit</button>
                    </div>
                    <div style="margin: 5px;">
                        <button type="button" class="btn bg-red clr-white del" style="border:none;" onclick="popupForm('complaint-form');">Cancel</button>
                    </div>
                </div>
        </div>
        </form>
    </div>

<script>

function popupForm(id){
        var form = document.getElementById(id);
        form.classList.toggle("active-popup");
        var body = document.getElementById("body");
        body.classList.toggle("complaint-blurr");
}


</script>

</body>
</html>
