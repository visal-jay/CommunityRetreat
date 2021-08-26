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
        if ($_SESSION["user"]["user_type"]=="admin") {$$admin=true;}
        if ($_SESSION["user"]["user_type"]=="registered_user") {$registered_user=true;}
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
                <form action="/search/" class="search-bar nav-search-bar" style="height:fit-content">
                    <input type="search" class="form-ctrl" placeholder="Search" >
                    <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                </form>
                <?php } ?>

                <?php if($registered_user) { ?>
                <a class="nav-link margin-side-md" href="/view/adoption_listing.php ">Home</a>
                <a class="nav-link margin-side-md" href="# ">Calender</a>
                <a class="nav-link margin-side-md" href="# ">Administratored</a>
                <a class="nav-link margin-side-md" href="# "></a>
                <?php } ?>

                <?php if($organization) { ?>
                <a class="nav-link margin-side-md" href="/view/adoption_listing.php ">Home</a>
                <a class="nav-link margin-side-md" href="# ">Events</a>
                <a class="nav-link margin-side-md" href="# ">Gallery</a>
                <a class="nav-link margin-side-md" href="# ">Statics</a>
                <?php } ?>

                <?php if($admin) { ?>
                <a class="nav-link margin-side-md" href="/view/adoption_listing.php ">complaints</a>
                <?php } ?>

                <?php if($guest_user) { ?>
                <a class="nav-link margin-side-md" href="/view/adoption_listing.php ">Home</a>
                <?php } ?>

            </nav>
                    
            <?php if(isset($username)) { ?>
            <a class="btn btn-solid"  style="font-size:1rem "><i class="fa fa-user "> </i> &nbsp; <?= $username ?> </a>
            <?php } else {?>
            <a class="btn btn-solid" href="/login/view" style="font-size:1rem "><i class="fa fa-user "> </i> &nbsp; Sign In </a>
            <?php } ?>
            
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
        console.log(latitude,"hello");
    });

    function nearme(){
        let link = "/search/view?"+"longitude="+longitude+"&latitude="+latitude+"&distance=20";
        location.href=link;
    }


</script>

</html>