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
    max-height: 200px;
    overflow: hidden;
    transition: all .5s ease-in-out;
    box-shadow: inset 0px 0px 30px 0px white;
    filter: blur(0px);
    position: relative;
    min-height: 150px;
    min-width: 800px;
}

.expense-info {
    max-height: 200px;
    overflow: hidden;
    transition: all .5s ease-in-out;
    box-shadow: inset 0px 0px 30px 0px white;
    filter: blur(0px);
    position: relative;
    min-height: 150px;
    min-width: 800px;
}

.height100 {
    max-height: fit-content;
    height: fit-content;
}

.container {
    border-radius: 5px;
    background-color: white;
    padding: 0 20px;
    display: block;
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
        padding: 10px;
    }

    .card-container {
        align-items: flex-start;
        justify-content: left;
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
        top: 40%;
    }
}
</style>

<?php 
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
    <div class="container flex-col flex-center" id="container">
        <h2 class="header margin-md">Income</h2>

        <form action="/budget/addIncome?" method="post" class="form income-form">

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
                    <button class="btn btn-md" name="event_id" type="submit"
                        value="<?= $_GET["event_id"] ?>">Submit</button>
                </div>
            </div>
        </form>
        <div class="income-info" id="income-info">
            <?php foreach($incomes as $income){ ?>
            <div class=" card-container">
                <p><?= $income["details"] ?></p>
                <p><?= $income["amount"] ?></p>
                <div class="flex-row">
                    <div>
                        <button class="btn btn-solid update-delete-btn "
                            onclick="togglePopup('update-form','<?= $income['details'] ?>', '<?= $income['amount'] ?>', '<?= $income['record_id'] ?>','<?= $_GET['event_id'] ?>'); blur_background('container');stillBackground('id1')">update</button>
                    </div>
                    <form action="/budget/delete?" method="post">
                        <input type="text" class="hidden" name="record_id" value="<?= $income['record_id'] ?>">
                        <button class="btn bg-red update-delete-btn  clr-white del" name="event_id" type="submit"
                            value=<?= $_GET['event_id'] ?>>
                            Delete</button>
                    </form>
                </div>
            </div>
            <?php } ?>

        </div>

        <div>
            <button class="btn btn-solid btn-md read-more-btn"
                onclick="show('income-info');change_button('income-down-btn')"><i id="income-down-btn"
                    class="fas fa-chevron-down"></i></button>
        </div>

        <h2 class="header margin-md">Expense</h2>

        <form action="/budget/addExpense?" method="post" class="form expense-form">

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
                    <button class="btn btn-md" name="event_id" type="submit"
                        value="<?= $_GET["event_id"] ?>">Submit</button>
                </div>
            </div>
        </form>

        <div class="expense-info" id="expense-info">
            <?php foreach($expenses as $expense){ ?>
            <div class="card-container">
                <p><?= $expense["details"] ?></p>
                <p><?= $expense["amount"] ?></p>
                <div class="flex-row">
                    <div>
                        <button class="btn btn-solid update-delete-btn "
                            onclick="togglePopup('update-form','<?= $expense['details'] ?>', '<?= $expense['amount'] ?>', '<?= $expense['record_id'] ?>','<?= $_GET['event_id'] ?>'); blur_background('container');stillBackground('id1')">update</button>
                    </div>
                    <form action="/budget/delete?" method="post">
                        <input type="text" class="hidden" name="record_id" value="<?= $expense['record_id'] ?>">
                        <button class="btn bg-red update-delete-btn  clr-white del" name="event_id" type="submit"
                            value=<?= $_GET['event_id'] ?>>
                            Delete</button>
                    </form>
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
            <form action="/budget/update" method="post" class="update-form">
                <div class="input form-item">Details <input class="form-ctrl" name="details" id="details" type="text" />
                </div>
                <div class="input form-item">Amount <input class="form-ctrl" name="amount" id="amount" type="text" />
                </div>
                <input type="text" class="hidden" name="record_id" id="record_id">
                <div class="flex-row-to-col">
                    <button type="submit" id="save" name="event_id" class=" btn btn-solid save-btn">Save</button>
                    <button type="button" class="btn bg-red clr-white del"
                        onclick="togglePopup('update-form');blur_background('container');stillBackground('id1')">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <script>
    function show(id) {
        document.getElementById(id).classList.toggle("height100");
        //show the rest of the incomes and expenses byclicking the drop down button 
    }

    function show_hide(id) {
        document.getElementById(id).classList.toggle("hidden");
        //show and hide the form where incomes and expenses can be added
    }

    function togglePopup(id, description = 0, amount = 0, record_id, event_id) {
        var form = document.getElementById(id);
        console.log(record_id);
        form.classList.toggle("active");
        form.querySelector("#details").setAttribute("value", description);
        form.querySelector("#amount").setAttribute("value", amount);
        form.querySelector("#record_id").setAttribute("value", record_id);
        form.querySelector("#save").setAttribute("value", event_id);
        //show the popup to update an income or an expense
    }

    function blur_background(id) {
        document.getElementById(id).classList.toggle("blurred")
        //when popup is shown background is blurred
    }

    function stillBackground(id) {
        document.getElementById(id).classList.toggle("still");
        //when popup is shown background is still
    }

    function change_button(id) {
        var x = document.getElementById(id)

        if (x.className == "fas fa-chevron-down") {
            x.className = "fas fa-chevron-up";
        } else {
            x.className = "fas fa-chevron-down";
        }
        //when down button is clicked it changes to up button.
    }
    </script>
</body>

</html>