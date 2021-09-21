<!DOCTYPE html>
<html>

<head>
    <title>
        index
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../Public/assets/style/fontawesome.min.css">
    <link rel="stylesheet" href="../Public/assets/style/admininstativestyles.css">
    <script defer src="../Public/assets/js/admininis.js"></script>


</head>
<?php include "nav.php" ?>

<body>

    <h1 id="topic">
        Adminstration
    </h1>
    <div class="eventsearchbar">
        <form action="/action_page.html" class="search-bar" style="height:fit-content">
            <input type="search" class="form-ctrl" placeholder="Search event">
            <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
        </form>
    </div>

    <div class="main-container" id="table-container">
    </div>
    
</body>
<?php include "footer.php" ?>
</html>