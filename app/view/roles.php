<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>User Roles</title>
</head>

<style>
    .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
</style>

<?php include "nav.php" ?>

<body>
    
    <div class="flex-col flex-center">
    <h1>User Roles</h1>

    <div class="flex-row flex-center">
        <form action="/action_page.html" class="search-bar" style="height:fit-content">
            <input type="search" class="form-ctrl" placeholder="Search User">
            <button type="" class="btn-icon clr-green "><i class=" fa fa-search"></i></button>
        </form>
        <button class="btn margin-lg" onclick="add()">Add User &nbsp; <i class="fas fa-plus"></i></button>
    </div>
    

        <div class="event-card-details">
        <table class="styled-table">
            <tr>
                <th>User</th>
                <th>User Role</th>
                <th>Delete</th>
            </tr>
            <tr>
                <td>Venodi Widanagamage</td>
                <td>Admin</td>
                <td><i class="btn-icon far fa-trash-alt clr-red"></i></td>
            </tr>
        </table>
        </div>
    </div>
</body>

<script>
        function add() {
        document.querySelector(".form").classList.toggle("show-form");
    }
</script>

</html>