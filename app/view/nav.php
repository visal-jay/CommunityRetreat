
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php 
    $organization=$admin=$registered_user=$guest_user=false;
    if(isset($_SESSION["user"]["user_type"])){
        if ($_SESSION["user"]["user_type"]=="organization") {$organization=true;}
        if ($_SESSION["user"]["user_type"]=="admin") {$admin=true;}
        if ($_SESSION["user"]["user_type"]=="registered user") {$registered_user=true;}
    }
    else {
        $guest_user=true;
    }
    ?>

        <header class="header">
            <a class=" logo ">
                <img src="/Public/assets/visal logo.png ">
            </a>
            <nav class="main-nav ">
                <div class="flex justify-between " style="width:100% ">
                    <button class="btn btn-link more-btn " onclick="document.querySelector( '.main-nav').classList.toggle( 'shown') ">
                        <i class="fa fa-times fa-2x"></i>
                    </button>
                </div>

                <?php if(!$admin && !$organization) { ?>
                <button type="button" class="btn btn-solid" id="near-me" onclick="nearme()" ><i class="fas fa-map-marker-alt"></i>&nbsp;Near me</button>
                <?php } ?>
                <?php if (!$organization) { ?>
                <form action="/search/view" method="get" class="search-bar nav-search-bar" style="height:fit-content">
                    <input name="search" type="search" id="nav-search" class="form-ctrl" placeholder="Search" >
                    <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                </form>
                <?php } ?>

                <?php if($registered_user) { ?>
                <a class="nav-link margin-side-md" href="/user/home">Home</a>
                <a class="nav-link margin-side-md" href="/user/calendar">Calender</a>
                <a class="nav-link margin-side-md" href="/user/administratored">Administrated</a>
                <a class="nav-link margin-side-md" href="# "></a>
                <?php } ?>

                <?php if($organization) { ?>
                <a class="nav-link margin-side-md" href="/organisation/dashboard ">Home</a>
                <a class="nav-link margin-side-md" href="/organisation/events">Events</a>
                <a class="nav-link margin-side-md" href="/organisation/gallery">Gallery</a>
                <a class="nav-link margin-side-md" href="/organisation/report">Statics</a>
                <?php } ?>

                <?php if($admin) { ?>
                <a class="nav-link margin-side-md" href="/view/adoption_listing.php ">complaints</a>
                <?php } ?>

                <?php if($guest_user) { ?>
                <a class="nav-link margin-side-md" href="/user/home">Home</a>
                <?php } ?>

            </nav>
                    
            <div class="nav-drop-down">
                <?php if(isset($_SESSION["user"]["username"])) { ?>
                <a class="btn btn-solid"  id="nav-drop" style="font-size:1rem" onclick="document.querySelector('.nav-drop-down-list').classList.toggle('hidden')" ><i class="fa fa-user "> </i> &nbsp; <?= $_SESSION["user"]["username"]?> &nbsp; <i class="fas fa-chevron-down"></i></a>
                <?php } else {?>
                <a class="btn btn-solid" href="/login/view" style="font-size:1rem "><i class="fa fa-user "> </i> &nbsp; Sign In </a>
                <?php } ?>
                <div class="nav-drop-down-list hidden">
                    <div class="flex-col">
                    <?php if($organization) { ?>
                        <a href="/organisation/organizationalAdminProfileView" class="nav-link margin-md" ><i class="far fa-user"></i>&nbsp; Profile</a>
                    <?php } elseif($registered_user) { ?>
                        <a href="/RegisteredUser/view" class="nav-link margin-md" ><i class="far fa-user"></i>&nbsp; Profile</a>
                    <?php } ?>
                    <a href="/login/logout" class="nav-link margin-side-md" href=""><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                    </div>
                </div>
            </div>
            <button class="btn more-btn " onclick="document.querySelector( '.main-nav').classList.toggle( 'shown') ">
                <i class="fa fa-bars "></i>
            </button>

        </header>
</body>

<script>
    var latitude = "";
    var longitude = "";

    navigator.geolocation.getCurrentPosition((position) => {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;
    });

    function nearme(){
        let link = "/search/view?distance=20";
        location.href=link;
    }

    function navSearch(){
        let link = "/search/view?"+"search="+document.getElementById('nav-search').value;
        location.href=link;
    }

    document.addEventListener("click", (evt) => {
    let targetElement = evt.target;
    let navDropdownButton = document.getElementById('nav-drop');
    let navDropdown=document.querySelector('.nav-drop-down-list');
    if (targetElement!=navDropdownButton)
        navDropdown.classList.add('hidden');
    });


</script>

</html>