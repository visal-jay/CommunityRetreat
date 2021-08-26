<?php if(!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en" id="id1">

<head>
    <title>Budget</title>
    <link rel="stylesheet" href="/public/assets/newstyles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
</head>

<style>
.income-info {
    height: 200px;
    overflow: hidden;
    transition: all .5s ease-in-out;
    box-shadow: inset 0px 0px 30px 0px white;
    filter: blur(0px);
    position: relative;

}

.expense-info {
    height: 200px;
    overflow: hidden;
    transition: all .5s ease-in-out;
    box-shadow: inset 0px 0px 30px 0px white;
    filter: blur(0px);
    position: relative;

}

.height100 {
    height: fit-content;
}

.container {
    border-radius: 5px;
    background-color: white;
    padding: 20px;
    display: block;
    margin-top: 10px;
}

.card-container {
    display: flex;
    flex-direction: row;
    border: none;
    box-shadow: none;
    padding: 0px;
    margin-bottom: 15px;
    margin-top: 15px;
}

.btn {
    margin: 5px;
}

.update-delete-btn {
    font-size: 1.1 rem;
}

.header {
    margin-bottom: 20px;
    justify-content: center;
}

.read-more-btn {
    cursor: pointer;
}

.del {
    border-color: #DA0037;
}

.form-action-buttons {
    margin-left: auto;
    margin-bottom: 15px;
}

p {
    margin: 1rem;
    width: 350px;
}

.income-form {
    width: 50%;
}

.expense-form {
    width: 50%;
}

.update-form {
    width: 100%;
}

.popup {
    position: fixed;
    transform: scale(0);
    z-index: 2;
    width: 300px;
    text-align: center;
    padding: 20px;
    border-radius: 8px;
    background: white;
    box-shadow: 0px 0px 11px 2px rgb(0 0 0 / 93%);
    display: none;
    top: 50%;
    left: 50%;
    width: 50%;

}

.popup.active {
    transition: all 300ms ease-in-out;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: row;
}

.blurred {
    filter: blur(2px);
}

.still {
    overflow: hidden;
}

.center {
    text-align: center;
}

@media screen and (max-width:800px) {

    p {
        margin: 0;
        white-space: nowrap;
        overflow: scroll;
        /* width: 150px; */
        /* box-sizing: content-box; */
    }

    .card-container {
        align-items: flex-start;
        justify-content: left;
        flex-direction: column;
        height: fit-content;
    }

    .update-delete-btn {
        font-size: 0.8rem;
    }

    .form {
        width: 100%;
    }

    .popup {
        left: 50%;
        position: fixed;
        width: 80%;

    }
}
</style>

<?php 

var_dump($incomes);
if(!isset($moderator)) $moderator= false;
if(!isset($treasurer)) $treasurer= false;
$organization = $admin =$registered_user = $guest_user = false;

if(isset($_SESSION ["user"] ["user_type"])){
    if($_SESSION ["user"] ["user_type"] == "organization"){
        $organization = true;
    }
    
    if($_SESSION ["user"] ["user_type"] == "admin"){
        $admin = true;
    }

    if($_SESSION ["user"] ["user_type"] == "registered_user"){
        $registered_user = true;
    }
    
}else{
    $guest_user= true;
}
?>

<body>
    <div class="container" id="container">
        <div>
            <h1 class="header">
                Budgeting system
            </h1>
        </div>
        <h2 class="header">Income</h2>

        <form action="/budget/addIncome" method="post" class="form income-form">

            <div>
                <button class="btn btn-md btn-solid margin-md" type="button" id="button" value="Add"
                    onclick="show_hide('income-form')">Add &nbsp;<i class="fas fa-plus"></i></button>
            </div>
            <div id="income-form" class="hidden" style="margin-top: 20px;">
                <div class="input form-item">Details
                    <input class="form-ctrl" name="details" id=" details" type="text" placeholder="Enter the details" />
                </div>
                <div class="input form-item">Amount
                    <input class="form-ctrl" name="amount" id="amount" type="text" placeholder="Enter the amount" />
                </div>
                <div class="form-action-buttons">
                    <button class="btn btn-md" name="submit" type="submit" value="submit">Submit</button>
                </div>
            </div>
        </form>
        <div class="income-info" id="income-info">
            <?php foreach($incomes as $income){ ?>
            <div class="card-container">
                <p><?= $income["details"] ?></p>
                <p><?= $income["amount"] ?></p>
                <div class="flex-row-to-col">
                    <button class="btn btn-solid update-delete-btn "
                        onclick="togglePopup('update-form','<?= $income['details'] ?>', '<?= $income['amount'] ?>'); blur_background('container');stillBackground('id1')">update</button>
                    <button class="btn bg-red update-delete-btn  clr-white del" name="delete" value="delete"
                        id>Delete</button>
                </div>
            </div>
            <?php } ?>

        </div>

        <div>
            <button class="btn btn-solid btn-md read-more-btn"
                onclick="show('income-info');change_button('income-down-btn')"><i id="income-down-btn"
                    class="fas fa-chevron-down"></i></button>
        </div>

        <h2 class="header">Expense</h2>

        <form action="/budget/addExpense" method="post" class="form expense-form">

            <button class="btn btn-md btn-solid margin-md" type="button" name="button" id="btn" value="Add"
                onclick="show_hide('expense-form') ">Add &nbsp;<i class="fas fa-plus"></i></button>
            <div id="expense-form" style="margin-top: 20px;" class="hidden">
                <div class="input form-item">Details
                    <input class="form-ctrl" name="details" id="details" type="text" placeholder="Enter the details" />
                </div>
                <div class="input form-item">Amount
                    <input class="form-ctrl" name="amount" id="amount" type="text" placeholder="Enter the amount" />
                </div>
                <div class="form-action-buttons">
                    <button class="btn btn-md" name="submit" type=" submit" value="Submit">Submit</button>
                </div>
            </div>
        </form>

        <div class="expense-info" id="expense-info">
            <?php foreach($expenses as $expense){ ?>
            <div class="card-container">
                <p><?= $expense["details"] ?></p>
                <p><?= $expense["amount"] ?></p>
                <div class="flex-row-to-col">
                    <button class="btn btn-solid update-delete-btn "
                        onclick="togglePopup('update-form','<?= $expense['details'] ?>', '<?= $expense['details'] ?>', '<?= $expense['record_id'] ?>'); blur_background('container');stillBackground('id1')">update</button>
                    <button class="btn bg-red update-delete-btn  clr-white del" name="record_id"
                        value="<?= $expense['record_id'] ?>">Delete</button>
                </div>
            </div>
            <?php } ?>

        </div>
        <div>
            <button class="btn btn-solid btn-md read-more-btn"
                onclick="show('expense-info');change_button('expense-down-btn')"><i id="expense-down-btn"
                    class="fas fa-chevron-down"></i></button>
        </div>
    </div>
    <div class="update-container">
        <div class="popup unblurred box" id="update-form">
            <form action="/budget/updateIncome" class="update-form">
                <div class="input form-item">Details <input class="form-ctrl" id="details" type="text" /></div>
                <div class="input form-item">Amount <input class="form-ctrl" id="amount" type="text" />
                    <div class="flex-row-to-col">
                        <button type="submit" id="save" name="record_id" class=" btn btn-solid save-btn">Save</button>
                        <button type="button" class="btn bg-red clr-white del"
                            onclick="togglePopup('update-form');blur_background('container');stillBackground('id1')">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    function show(id) {
        document.getElementById(id).classList.toggle("height100");
    }

    function show_hide(id) {
        document.getElementById(id).classList.toggle("hidden");
    }

    function togglePopup(id, description = 0, amount = 0, record_id) {
        var form = document.getElementById(id);
        form.classList.toggle("active");
        form.querySelector("#details").setAttribute("value", description);
        form.querySelector("#amount").setAttribute("value", amount);
        form.querySelector("#save").setAttribute("value", record_id);

    }

    function blur_background(id) {
        document.getElementById(id).classList.toggle("blurred")
    }

    function stillBackground(id) {
        document.getElementById(id).classList.toggle("still");
    }

    function change_button(id) {
        var x = document.getElementById(id)

        if (x.className == "fas fa-chevron-down") {
            x.className = "fas fa-chevron-up";
        } else {
            x.className = "fas fa-chevron-down";
        }
    }
    </script>
</body>

</html>