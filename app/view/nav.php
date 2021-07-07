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
                <button class="btn btn-solid" id="near-me"><i class="fas fa-map-marker-alt" ></i>&nbsp;Near me</button>
                <form action="/action_page.html" class="search-bar" style="height:fit-content">
                    <input type="search" class="form-ctrl" placeholder="Search" >
                    <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                </form>
                <a class="nav-link margin-side-md" href="/view/adoption_listing.php ">Home</a>
                <a class="nav-link margin-side-md" href="# ">Calender</a>
                <a class="nav-link margin-side-md" href="# ">Administrator</a>
            </nav>
 
            <a class="btn btn-solid" href="index.php" style="font-size:1rem "><i class="fa fa-user "> </i> &nbsp; Sign In </a>

            <button class="btn more-btn " onclick="document.querySelector( '.main-nav').classList.toggle( 'shown') ">
                <i class="fa fa-bars "></i>
            </button>

        </header>
</body>

</html>