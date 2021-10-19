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
        <div class="margin-side-lg card-container" style="margin-top: 2rem; margin-left:150px; margin-right:150px; border:white">
            <div class="event-card-details flex-col" style="display: flex; flex-direction: row;">
                <div class="margin-side-md complaint">
                    <p style="margin: 10px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptatem numquam laboriosam quaerat nisi repellat, nam temporibus molestias maxime eum iste velit officia deserunt recusandae voluptatum molestiae nihil ipsam et.</p>
                </div>

                <div class="margin-side-md complainant" style="display: flex; align-items: center;">
                    <a href="" style="text-decoration: none; color:black">Venodi widanagamage</a>
                </div>

                <div class="margin-side-md" style="display: flex; align-items: center;">
                    <a href="" style="text-decoration: none; color:black">Embark</a>
                </div>
                
                <div class="margin-side-md" style="display: flex; align-items: center;">
                    <p>2021.08.20</p>
                </div>
                
                <div style="display: flex; align-items: center;"><button class="btn flex-col flex-center margin-md btn-solid">Dismiss</button></div>
                <div style="display: flex; align-items: center;"><button class="btn flex-col flex-center margin-md remove-btn" style="background-color: red; color: white; border: none;">Remove</button></div>
            </div>
        </div>
        <div class="margin-side-lg card-container" style="margin-top: 2rem; margin-left:150px; margin-right:150px">
            <div class="event-card-details flex-col" style="display: flex; flex-direction: row;">
                <div class="margin-side-md complaint">
                    <p style="margin: 10px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptatem numquam laboriosam quaerat nisi repellat, nam temporibus molestias maxime eum iste velit officia deserunt recusandae voluptatum molestiae nihil ipsam et.</p>
                </div>

                <div class="margin-side-md complainant" style="display: flex; align-items: center;">
                    <a href="" style="text-decoration: none; color:black">Venodi widanagamage</a>
                </div>

                <div class="margin-side-md" style="display: flex; align-items: center;">
                    <a href="" style="text-decoration: none; color:black">Embark</a>
                </div>
                
                <div class="margin-side-md" style="display: flex; align-items: center;">
                    <p>2021.08.20</p>
                </div>
                
                <div style="display: flex; align-items: center;"><button class="btn flex-col flex-center margin-md btn-solid">Dismiss</button></div>
                <div style="display: flex; align-items: center;"><button class="btn flex-col flex-center margin-md remove-btn" style="background-color: red; color: white; border: none;">Remove</button></div>
            </div>
        </div>
        <div class="margin-side-lg card-container" style="margin-top: 2rem; margin-left:150px; margin-right:150px">
            <div class="event-card-details flex-col" style="display: flex; flex-direction: row;">
                <div class="margin-side-md complaint">
                    <p style="margin: 10px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptatem numquam laboriosam quaerat nisi repellat, nam temporibus molestias maxime eum iste velit officia deserunt recusandae voluptatum molestiae nihil ipsam et.</p>
                </div>

                <div class="margin-side-md complainant" style="display: flex; align-items: center;">
                    <a href="" style="text-decoration: none; color:black">Venodi widanagamage</a>
                </div>

                <div class="margin-side-md" style="display: flex; align-items: center;">
                    <a href="" style="text-decoration: none; color:black">Embark</a>
                </div>
                
                <div class="margin-side-md" style="display: flex; align-items: center;">
                    <p>2021.08.20</p>
                </div>
                
                <div style="display: flex; align-items: center;"><button class="btn flex-col flex-center margin-md btn-solid">Dismiss</button></div>
                <div style="display: flex; align-items: center;"><button class="btn flex-col flex-center margin-md remove-btn" style="background-color: red; color: white; border: none;">Remove</button></div>
            </div>
        </div>
        <div class="margin-side-lg card-container" style="margin-top: 2rem; margin-left:150px; margin-right:150px">
            <div class="event-card-details flex-col" style="display: flex; flex-direction: row;">
                <div class="margin-side-md complaint">
                    <p style="margin: 10px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptatem numquam laboriosam quaerat nisi repellat, nam temporibus molestias maxime eum iste velit officia deserunt recusandae voluptatum molestiae nihil ipsam et.</p>
                </div>

                <div class="margin-side-md complainant" style="display: flex; align-items: center;">
                    <a href="" style="text-decoration: none; color:black">Venodi widanagamage</a>
                </div>

                <div class="margin-side-md" style="display: flex; align-items: center;">
                    <a href="" style="text-decoration: none; color:black">Embark</a>
                </div>
                
                <div class="margin-side-md" style="display: flex; align-items: center;">
                    <p>2021.08.20</p>
                </div>
                
                <div style="display: flex; align-items: center;"><button class="btn flex-col flex-center margin-md btn-solid">Dismiss</button></div>
                <div style="display: flex; align-items: center;"><button class="btn flex-col flex-center margin-md remove-btn" style="background-color: red; color: white; border: none;">Remove</button></div>
            </div>
        </div>
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