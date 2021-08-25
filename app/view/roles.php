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
        margin: 25px 25px;
        font-size: 0.9em;
        min-width: 80%;
        max-width: 100%;
        width: 600px;
    }

    .styled-table th,
    td {
        text-align: left;
    }

    #role {
        margin-bottom: 0px;
    }

    .flex-row-to-col {
        display: flex;
        flex-direction: row;
    }

    th,
    td {
        padding-right: 20px;
        padding-top: 4px;
        padding-bottom: 4px;
    }

    #del {
        padding-left: 30px;
    }

    @media screen and (max-width:767px) {

        .flex-row-to-col {
            flex-direction: column;
        }

        .search-bar-role {
            width: 50%;
        }


        .styled-table {
            width: 200px;
        }
    }
</style>

<?php include "nav.php" ?>

<body>

    <div class="flex-col flex-center">
        <h1>User Roles</h1>

        <div>
            <form class="flex-center flex-row-to-col" action="/action_page.html" style="height:fit-content">
                <div class="flex-row flex-center">
                    <div class="search-bar search-bar-role">
                        <input type="search" class="form-ctrl" placeholder="Search User">
                        <button type="" class="btn-icon clr-green "><i class=" fa fa-search"></i></button>
                    </div>
                    <select class="form-ctrl" id="role" required>
                        <option value="" disabled selected>Select role</option>
                        <option value="Moderator">Moderator</option>
                        <option value="Treasurer">Treasurer</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn margin-lg" onclick="add()">Add User &nbsp; <i class="fas fa-plus"></i></button>
                </div>
            </form>
        </div>


        <div class="event-card-details">
            <table class="styled-table">
                <tr>
                    <th>User</th>
                    <th>User Role</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Visal Jayathilake</td>
                    <td>Admin</td>
                    <td id="del"><i class="btn-icon far fa-trash-alt clr-red" onclick="del()"></i></td>
                </tr>
                <tr>
                    <td>Pudara Semini</td>
                    <td>Treasurer</td>
                    <td id="del"><i class="btn-icon far fa-trash-alt clr-red" onclick="del()"></i></td>
                </tr>
                <tr>
                    <td>Venodi Widanagamage</td>
                    <td>Moderator</td>
                    <td id="del"><i class="btn-icon far fa-trash-alt clr-red" onclick="del()"></i>
                        <div class="flex-row flex-space" style="display: none; padding-top:1rem;">
                            <p class="margin-side-md" style="white-space: nowrap;">Are you sure</p>
                            <i class="fas fa-check clr-green margin-side-md"></i>&nbsp;
                            <i class="fas fa-times clr-red  margin-side-md" onclick="cancel()"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Manuka Dewanarayana</td>
                    <td>Registered User</td>
                    <td id="del"><i class="btn-icon far fa-trash-alt clr-red" onclick="del()"></i></td>
                </tr>
            </table>
        </div>
    </div>
</body>

<script>
    function add() {
        document.querySelector(".form").classList.toggle("show-form");
    }

    function del() {
        var data = document.getElementsByClassName("data");
        var form = document.getElementsByClassName("form");
        for (var i = 0; i < data.length; i++) {
            data[i].classList.toggle("hidden");
        }
        for (var i = 0; i < form.length; i++) {
            form[i].classList.toggle("hidden");
        }
    }
</script>

</html>