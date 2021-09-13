
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>

    <style>
        .main-footer{
            background-color: #03142d;
            height:10rem;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        .footer-content{
            color: #16c79a;
        }
    </style>
</head>


<body>
    <?php 
    $organization=$admin=$registered_user=$guest_user=false;
    if(isset($_SESSION["user"]["user_type"])){
        if ($_SESSION["user"]["user_type"]=="organization") {$organization=true;}
        if ($_SESSION["user"]["user_type"]=="admin") {$$admin=true;}
        if ($_SESSION["user"]["user_type"]=="registered user") {$registered_user=true;}
    }
    else {
        $guest_user=true;
    }
    ?>
    <footer class="main-footer">
        <p class="footer-content"><i class="fa fa-times fa-2x"></i>Feedback Us</p>
        <p class="footer-content">Contact Us</p>
    </footer>
     
</body>

<script>
    var latitude = "";
    var longitude = "";

    navigator.geolocation.getCurrentPosition((position) => {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;
        console.log(latitude,"hello");
    });

    function nearme(){
        console.log("shfkjsd");
        let link = "/search/view?distance=20";
        location.href=link;
    }

    function navSearch(){
        let link = "/search/view?"+"search="+document.getElementById('nav-search').value;
        location.href=link;
    }

    document.addEventListener("click", (evt) => {
    let targetElement = evt.target;
    console.log(targetElement);
    let navDropdownButton = document.getElementById('nav-drop');
    console.log(navDropdownButton);
    let navDropdown=document.querySelector('.nav-drop-down-list');
    if (targetElement!=navDropdownButton)
        navDropdown.classList.add('hidden');
    });


</script>

</html>