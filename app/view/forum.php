<!DOCTYPE html>
<html lang="en" id="id1">

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
    h3 {
        margin: 0;
    }

    update {
        display: flex;
        justify-content: flex-end;
    }

    .align-left {
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

    .popup .btn-close {
        position: absolute;
        right: 10px;
        top: 10px;
        width: 30px;
        height: 30px;
        color: black;
        font-size: 1.5rem;
        padding: 2px 5px 7px 5px;
    }

    .popup.active .content {
        transition: all 300ms ease-in-out;
        transform: translate(-50%, -50%);
    }

    .blurred {
        filter: blur(2px);
        overflow: hidden;
    }

    .popup .content {
        position: fixed;
        transform: scale(0);
        width: 40%;
        z-index: 2;
        text-align: center;
        padding: 20px;
        border-radius: 8px;
        background: white;
        box-shadow: 0px 0px 11px 2px rgba(0, 0, 0, 0.93);
        z-index: 1;
        left: 50%;
        top: 50%;
        display: flex;
        flex-direction: column;
    }

    input[type="date"]::before {
        content: attr(data-placeholder);
        width: 100%;
    }

    input[type="date"]:focus::before,
    input[type="date"]:valid::before {
        display: none
    }

    .still {
        overflow: hidden;
    }

    ::placeholder {
        color: black;
        opacity: 1;
    }

    textarea {
        min-height: 200px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
    }

    @media screen and (max-width:800px) {
        .card-container {
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

        #map {
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


<body>
    <div id="background">
        <div class="flex-col flex-center margin-side-lg">
            <button class="btn btn-solid btn-close margin-lg" onclick="togglePopup('form'); blur_background('background'); stillBackground('id1')">Add Announcement &nbsp; <i class="fas fa-plus"></i></button>
        </div>

        <div class="card-container margin-side-lg">
            <div class="flex-col event-card-details">
                <h3 class="margin-md">Announcement</h3>
                <date class="margin-md">28.10.2021</date>
                <description class="margin-md">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione nemo nostrum perspiciatis. Impedit, praesentium. Fuga ab numquam distinctio reprehenderit laudantium quae possimus, odio quisquam quia officia illo laborum eligendi ea?</description>
                <update class="margin-md">
                    <button class="btn margin-side-md" onclick="edit()"><i class="btn-icon far fa-edit margin-side-md"></i>&nbsp;&nbsp;Edit</button>
                    <button class="btn clr-red border-red " onclick="remove()"><i class="far fa-trash-alt margin-side-md"></i>&nbsp;&nbsp;Remove</button>
                    <div class="flex-row flex-space" style="display: none;">
                        <p class="margin-side-md" style="white-space: nowrap;">Are you sure</p>
                        <i class="fas fa-check clr-green margin-side-md"></i>&nbsp;
                        <i class="fas fa-times clr-red  margin-side-md" onclick="cancel()"></i>
                    </div>
                </update>
            </div>
        </div>
    </div>

    <div class="popup" id="form">
        <div class="content">
            <form action="/action_page.php" class="form-container">
                <div>
                    <h3 class="margin-md">New Announcement</h3>
                </div>

                <div class="form-item">
                    <label>Title</label>
                    <input type="text" required class="form-ctrl" placeholder="Enter Title">
                </div>

                <div class="form-item">
                    <label>Date</label>
                    <input type="date" required class="form-ctrl" data-placeholder="Enter Date">
                </div>

                <div class="form-item">
                    <label>Announcement</label>
                    <textarea name="task" class="form form-ctrl" placeholder="Enter announcement" required>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vitae magni eveniet porro, ipsa mollitia dolores ipsam optio aliquam, debitis voluptatum accusamus cum perferendis, amet facere expedita nostrum laboriosam quas iste!</textarea>
                </div>

                <button class="btn btn-solid margin-md" type="submit" disabled>Post</button>

                <div>
                    <button class="btn-icon btn-close" onclick="togglePopup('form'); blur_background('background'); stillBackground('id1')"><i class="fas fa-times"></i></button>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    function togglePopup(id) {
        document.getElementById(id).classList.toggle("active");
    }

    function blur_background(id) {
        document.getElementById(id).classList.toggle("blurred")
    }

    function stillBackground(id) {
        document.getElementById(id).classList.toggle("still");
    }

    function add() {
        document.querySelector(".form").classList.toggle("show-form");
    }

    function edit() {
        var data = document.getElementsByClassName("data");
        var form = document.getElementsByClassName("form");
        for (var i = 0; i < data.length; i++) {
            data[i].classList.toggle("hidden");
        }
        for (var i = 0; i < form.length; i++) {
            form[i].classList.toggle("hidden");
        }
    }

    //check about the 'onclick' on text and the icon of the button
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