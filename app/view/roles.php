<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <title>User Roles</title>
</head>

<style>
    img {
        height: 30px;
        width: 30px;
    }

    .styled-table {
        border-collapse: collapse;
        margin: 25px 25px;
        font-size: 1em;
        min-width: 80%;
        max-width: 100%;
        width: 600px;
    }

    .styled-table th,
    td {
        text-align: center;
    }

    #role {
        margin-bottom: 0px;
    }

    .flex-row-to-col {
        display: flex;
        flex-direction: row;
    }

    .search-bar-role {
        position: relative;
    }

    .search-bar-dropdown {
        max-height: 100px;
        overflow-y: scroll;
        overflow-x: hidden;
        background: white;
        position: absolute;
        top: 36px;
        left: 4px;
        width: 175px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
    }

    .search-bar-dropdown div {
        padding: 0 3px;
    }

    .search-bar-dropdown div:hover {
        background: grey;
    }

    th,
    td {
        padding-right: 20px;
        padding-top: 7px;
        padding-bottom: 7px;
    }

    .drop-down-list {
        display: flex;
        align-items: center;
        overflow: hidden;
        white-space: nowrap;
    }

    #del {
        padding-left: 30px;
    }

    hr {
        margin: 5px;
        color: gray;
        background-color: gray;
    }


    @media screen and (max-width:767px) {

        .flex-row-to-col {
            flex-direction: column;
        }

        .flex-row{
            flex-wrap: wrap;
        }

        .search-bar-role {
            width: 50%;
        }

        .search-bar-dropdown {
            background: white;
            position: absolute;
            top: 36px;
            left: 4px;
            width: 150px;
        }

        .styled-table {
            width: 200px;
        }

        table{
            table-layout:auto;
        }
    }
</style>

<body>

    <div class="flex-col flex-center">
        <h1>User Roles</h1>

        <div>
            <form autocomplete="off" class="flex-center flex-row-to-col" action="/Organisation/addUserRole?event_id=<?= $_GET['event_id'] ?>" method="post" style="height:fit-content">
                <div class="flex-row flex-center">
                    <div class="search-bar search-bar-role">
                        <input autocomplete="off" type="search" id="user-search" class="form-ctrl" placeholder="Search User" onkeyup="getUsers()" required>
                        <input type="text" id="user-id" class="hidden" name="uid">
                        <div class="search-bar-dropdown"></div>
                    </div>
                    <select class="form-ctrl" id="role" required name="role">
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
                <?php foreach ($users as $userrole) {
                    if ($userrole["moderator_flag"] == 1) {
                ?>
                        <tr>
                            <td><?= $userrole["username"] ?></td>
                            <td><?= "Moderator" ?></td>
                            <td id="del">
                                <div onclick="del(event.target.parentNode)">
                                    <i class="btn-icon far fa-trash-alt clr-red"></i>
                                </div>
                                <div class="hidden form">
                                    <div class="flex-row flex-space">
                                        <p class="margin-side-md" style="white-space: nowrap;">Are you sure</p>
                                        <i class="fas fa-check clr-green margin-side-md" onclick="deleteUserRoles('<?= $userrole['uid'] ?>','<?= 'moderator' ?>', '<?= $_GET['event_id'] ?>')"></i>&nbsp;
                                        <i class="fas fa-times clr-red  margin-side-md" onclick="del(event.target.parentNode.parentNode.previousElementSibling)"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php }
                    if ($userrole["treasurer_flag"] == 1) {
                    ?>
                        <tr>
                            <td><?= $userrole["username"] ?></td>
                            <td><?= "Treasurer" ?></td>
                            <td id="del">
                                <div onclick="del(event.target.parentNode)">
                                    <i class="btn-icon far fa-trash-alt clr-red"></i>
                                </div>
                                <div class="hidden form">
                                    <div class="flex-row flex-space">
                                        <p class="margin-side-md" style="white-space: nowrap;">Are you sure</p>
                                        <i class="fas fa-check clr-green margin-side-md" onclick="deleteUserRoles('<?= $userrole['uid'] ?>','<?= 'treasurer' ?>', '<?= $_GET['event_id'] ?>')"></i>&nbsp;
                                        <i class="fas fa-times clr-red  margin-side-md" onclick="del(event.target.parentNode.parentNode.previousElementSibling)"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>

                <?php }
                } ?>

            </table>
            <form method="post" action="/Organisation/deleteUserRole?event_id=<?= $_GET["event_id"] ?>" id="delete-form">
                <input type="text" class="hidden" name="uid" id="user-role-uid" required>
                <input type="text" class="hidden" name="role" id="user-role" required>
                <input type="text" class="hidden" name="event_id" id="user-role-event-id" required>
            </form>
        </div>
    </div>
</body>



<script>
    function add() {
        document.querySelector(".form").classList.toggle("show-form");
    }

    function del(event) {
        event.nextElementSibling.classList.toggle("hidden");
        event.classList.toggle("hidden");
    }

    function deleteUserRoles(uid, role, event_id) {

        document.getElementById("user-role-uid").value = uid;
        document.getElementById("user-role").value = role;
        document.getElementById("user-role-event-id").value = event_id;
        document.getElementById("delete-form").submit();
    }

    function createElementFromHTML(htmlString) {
        var div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }

    function addUser(uid, username) {
        console.log(uid, username);
        document.querySelector(".search-bar-dropdown").innerHTML = "";
        document.getElementById("user-search").value = username;
        document.getElementById("user-id").value = uid;
    }

    function getUsers() {
        var name = document.getElementById("user-search").value;
        if (name.length != 0)
            $.ajax({
                url: "/Organisation/getAvailableUserRoles", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    name: name
                },
                success: function(result) {
                    console.log(result);
                    let parent_container = document.querySelector(".search-bar-dropdown");
                    parent_container.innerHTML = "";
                    if (result.length != 0)
                        result.forEach(evn => {
                            let template = `<div class="drop-down-list" onclick="addUser('${evn.uid}','${evn.username}')"><img src="/Uploads/placeholder-image.jpg" alt=""><div class="margin-side-md">${evn.username}</div></div>`;
                            parent_container.appendChild(createElementFromHTML(template));
                            parent_container.appendChild(createElementFromHTML('<hr>'));
                        });
                }
            });
        else
            document.querySelector(".search-bar-dropdown").innerHTML = "";
    }
</script>

</html>