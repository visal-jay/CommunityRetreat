<!DOCTYPE html>
<html>
<head>
    <title>Complaint</title>
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
</head>
    <style>
        /* Button used to open the contact form - fixed at the bottom of the page */
        .complain-button {
            border: none;
            cursor: pointer;
        }

        /* Add styles to the form container */
        .complaint-form-container {
            max-width: 500px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .complaint-form-container input[type=text]{
            width: 80%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .complaint-form-container input[type=text]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Add a red background color to the cancel button */
        .complaint-form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .complaint-form-container .btn:hover, .complain-button:hover {
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

        .complaint-blurred {
            filter: blur(2px);
        }

        .complaint-still {
            overflow: hidden;
        }

        .flex-row-to-col{
            display: flex;
            flex-direction: row;
            justify-content: center;
            
        }

    </style>
</head>
<body>

<button class="btn btn-solid" style="background-color: red; border:none;" onclick="popupForm('complaint-form'); background_blur('container');background_still('id1')">Complain &nbsp;<i class="far fa-comments"></i></button>

<div class="complaint-container">
        <div class="complaint-popup-box" id="complaint-form">
            <form action="" class="complaint-form">

                <div class="input form-item flex-col flex-center">
                    <label>Name</label> 
                    <input class="form-ctrl" style="width:90%;" id="name" type="text" />
                </div>

                <div class="input form-item flex-col flex-center">
                    <label>Complaint </label>
                <input class="form-ctrl" style="width:90%;" id="details" type="text" />
            </div>

                <div class="flex-row-to-col">
                    <div style="margin: 5px;">
                        <button type="submit" class="btn btn-solid" style="border:none;">Submit</button>
                    </div>
                    <div style="margin: 5px;">
                        <button type="button" class="btn bg-red clr-white del" style="border:none;" onclick="popupForm('complaint-form');background_blur('container');background_still('id1')">Cancel</button>
                    </div>
                </div>
        </div>
        </form>
    </div>

<script>

function popupForm(id) {
        var form = document.getElementById(id);
        form.classList.toggle("active-popup");
    }

function background_blur(id) {
    document.getElementById(id).classList.toggle("complaint-blurred")
}

function background_still(id) {
    document.getElementById(id).classList.toggle("complaint-still");
}
</script>

</body>
</html>