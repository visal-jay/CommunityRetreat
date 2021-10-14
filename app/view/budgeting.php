<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en" id="id1">

<head>
    <title>Budget</title>
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
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
        filter: blur(0px);
        min-height: 150px;
        min-width: 800px;
        width: 90%;
        padding: 10px;
        background-color: white;
        border-radius: 10px;
    }

    .expense-info {
        max-height: 200px;
        overflow: hidden;
        transition: all .5s ease-in-out;
        filter: blur(0px);
        min-height: 150px;
        min-width: 800px;
        width: 90%;
        padding: 10px;
        background-color: white;
        border-radius: 10px;
    }

    .height100 {
        max-height: fit-content;
        height: fit-content;
    }

    .container {
        padding: 0 20px;
        display: block;
    }

    .budget-card-container {
        display: flex;
        flex-direction: row;
        border: none;
        box-shadow: none;
        padding: 0px;
    }

    .btn {
        margin: 5px;
    }

    .submit-btn {
        font-size: 0.8rem;
    }

    .update-save-btn {
        font-size: 0.8rem;
        border: none;
    }

    .delete-cancel-btn {
        border: none;
        font-size: 0.8rem;
    }

    .header {
        justify-content: center;
    }

    .read-more-btn {
        cursor: pointer;
        font-size: 0.8rem;
        margin-top: 10px;
    }

    .income-expense-form-inside {
        margin-top: 20px;
        margin-bottom: 20px;
        box-shadow: 5px 5px 15px 5px #cccccc;
        padding: 20px;
        border-radius: 10px;
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

    .bold {
        font-weight: 600;
    }

    .sum {
        margin: 15px;
        text-align: center;
    }

    .details-overflow {
        overflow: auto;
        width: 40%;
        margin: 5px;
        padding: 5px;
        display: flex;
        align-content: stretch;
        align-items: center;
        text-align: left;
    }

    .amount-field {
        width: 20%;
        text-align: right;
        margin-right: 45px;
    }

    .btn-field {
        width: 40%;
        margin: 5px;
        padding: 5px;
        justify-content: end;
    }

    .income-expenxe-balance-container {
        border-color: #16c79a;
        border-radius: 8px;
        background-color: #eeeeee;
        box-shadow: 2px 4px #ccbcbc;
        padding: 5px;
        text-align: center;
        display: flex;
        justify-content: space-evenly;
    }

    .income-expense-show-hide-btn {
        text-align: center;
    }

    .full-budget-details-btn{
        margin: 25px;
    }

    .income-expense-add-container {
        text-align: center;
    }

    @media screen and (max-width:800px) {
        .container{
            padding: 0;
        }

        .income-info {
            margin-left: 0;
            margin-right: 0;
            padding: 0;
        }

        .expense-info {
            margin-left: 0;
            margin-right: 0;
            padding: 0;
        }

        .update-save-btn {
            border: none;
            font-size: 0.65rem;
        }

        .delete-cancel-btn {
            border: none;
            font-size: 0.65rem;
        }

        .submit-btn{
            font-size: 0.75rem;
        }

        .btn-field {
            width: 40%;
            margin: 2px;
            padding: 2px;
            justify-content: center;
            white-space: nowrap;

        }

        .amount-field {
            width: 30%;
            text-align: right;
            overflow: auto;
            white-space: nowrap;
            margin: 4px;
            padding: 3px;
        }

        .details-overflow {
            overflow: auto;
            width: 30%;
            margin: 4px;
            padding: 2px;
            white-space: nowrap;
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

        .income-info {
            min-width: 0;
        }

        .expense-info {
            min-width: 0;
        }

        .income-expenxe-balance-container {
            display: flex;
            flex-direction: column;
            margin: 4px;
        }

        .sum {
            margin: 5px;
            justify-content: space-between;
        }

        .income-expense-form-inside {
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            box-shadow: 5px 5px 15px 5px #cccccc;
            padding: 15px;
    }
    }
</style>


<body>
    <div class="container flex-col flex-center" id="container">

        <div class="income-expenxe-balance-container">

            <div class="bold sum flex-row">
                <!--display the sum of incomes-->
                <div>Sum of Incomes :</div>
                <div><?php echo 'Rs. ' . number_format($income_sum, 2) ?></div>
            </div>

            <div class="bold sum flex-row">
                <!--display the sum of expenses-->
                <div>Sum of Expenses :</div>
                <div><?php echo 'Rs. ' . number_format($expense_sum, 2) ?></div>
            </div>

            <div id="balance" class="bold sum flex-row">
                <!--display the balance-->
            </div>
        </div>

        <div class="full-budget-details-btn" style="text-align:center;">
                <!--Display the full budget details-->
                <button class="btn btn-md btn-solid"
                    onclick="window.location.href=' /Budget/budgetReport?event_id=<?= $_GET['event_id'] ?>'">Full
                    Budget details</button>
            </div>

        <h2 class="header margin-md">Income</h2>

        <div class="income-expense-add-container">

            <?php if ($organization || $treasurer) { ?>
                <!--Add incomes to the database-->
                <form action="/Budget/addIncome?" method="post" class="form income-form">

                    <div>
                        <button class="btn btn-sm btn-solid margin-md" type="button" id="button" value="Add" onclick="show_hide('income-form')">Add &nbsp;<i class="fas fa-plus"></i></button>
                    </div>

                    <div id="income-form" class="hidden income-expense-form-inside">

                        <div class="input form-item">
                            <label>Details</label>
                            <input class="form-ctrl" name="details" id=" details" type="text" placeholder="Enter the details" required/>
                        </div>

                        <div class="input form-item">
                            <label>Amount</label>
                            <input class="form-ctrl" name="amount" id="amount" type="number" placeholder="Enter the amount" required/>
                        </div>

                        <div class="form-action-buttons">
                            <button class="btn submit-btn" name="event_id" type="submit" value="<?= $_GET["event_id"] ?>">Submit</button>
                        </div>

                    </div>
                </form>
            <?php } ?>

        </div>

        <div style="text-align: -webkit-center;">
            <div class="income-info" id="income-info">
                <div class="budget-card-container">
                    <!--Display the donation sum from the database-->
                    <p class="details-overflow">Donations</p>
                    <div class="amount-field"><p style="margin: 0; align-items:center"><?php echo 'Rs. ' . number_format($donation_sum, 2) ?></p></div>
                    <div class="flex-row btn-field"></div>
                </div>

            <?php foreach ($incomes as $income) { ?>

                <div class="budget-card-container">
                    <!--Display all the incomes from the database-->
                    <p class="details-overflow"><?= $income["details"] ?></p>
                    <p class="amount-field"><?php echo 'Rs. ' . number_format($income["amount"], 2) ?></p>
                    <div class="flex-row btn-field">
                        <div>
                            <!--Update the income and save it in database-->
                            <button class="btn btn-solid update-save-btn " onclick="togglePopup('update-form','<?= $income['details'] ?>', '<?= $income['amount'] ?>', '<?= $income['record_id'] ?>','<?= $_GET['event_id'] ?>'); blur_background('container');stillBackground('id1')">update</button>
                        </div>

                        <form action="/Budget/delete?" method="post">
                            <!--Delete the income and save it in database-->
                            <input type="text" class="hidden" name="record_id" value="<?= $income['record_id'] ?>">
                            <button class="btn bg-red clr-white delete-cancel-btn" style="border: none;" name="event_id" type="submit" value=<?= $_GET['event_id'] ?>>
                                Delete</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>

        <div id="income-show-hide-btn" class="income-expense-show-hide-btn">
            <!--Show all the hidden incomes-->
            <button class=" btn btn-solid read-more-btn" onclick="show('income-info');change_button('income-down-btn');"><i id="income-down-btn" class="fas fa-chevron-down"></i></button>
        </div>

        <h2 class="header margin-md">Expense</h2>

        <div class="income-expense-add-container">
            <!--Add expenses to the database-->
            <?php if ($organization || $treasurer) { ?>
                <form action="/Budget/addExpense?" method="post" class="form expense-form">

                    <button class="btn btn-sm btn-solid margin-md" type="button" name="button" id="btn" value="Add" onclick="show_hide('expense-form') ">Add &nbsp;<i class="fas fa-plus"></i></button>

                    <div id="expense-form" class="hidden income-expense-form-inside">

                        <div class="input form-item">
                        <label>Details</label>
                            <input class="form-ctrl" name="details" id="details" type="text" placeholder="Enter the details" required/>
                        </div>

                        <div class="input form-item">
                            <label>Amount</label>
                            <input class="form-ctrl" name="amount" id="amount" type="number" placeholder="Enter the amount" required/>
                        </div>

                        <div class="form-action-buttons">
                            <button class="btn submit-btn" name="event_id" type="submit" value="<?= $_GET["event_id"] ?>">Submit</button>
                        </div>

                    </div>
                </form>
            <?php } ?>
        </div>

        <div style="text-align: -webkit-center;">
            <div class="expense-info" id="expense-info">
                <?php foreach ($expenses as $expense) { ?>

                    <div class="budget-card-container">
                        <!--Display the expenses from the database-->
                        <p class="details-overflow"><?= $expense["details"] ?></p>
                        <p class="amount-field"><?php echo 'Rs. ' . number_format($expense["amount"], 2) ?></p>

                        <div class="flex-row btn-field">
                            <div>
                                <!--Update the expense and save it in database-->
                                <button class="btn btn-solid update-save-btn " onclick="togglePopup('update-form','<?= $expense['details'] ?>', '<?= $expense['amount'] ?>', '<?= $expense['record_id'] ?>','<?= $_GET['event_id'] ?>'); blur_background('container');stillBackground('id1')">update</button>
                            </div>
                            <form action="/Budget/delete?" method="post">
                                <!--Delete the expense and save it in database-->
                                <input type="text" class="hidden" name="record_id" value="<?= $expense['record_id'] ?>">
                                <button class="btn bg-red clr-white delete-cancel-btn" style="border: none;" name="event_id" type="submit" value=<?= $_GET['event_id'] ?>>
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div id="expense-show-hide-btn" class="income-expense-show-hide-btn">
            <!--Show all the hidden expenses-->
            <button class="btn btn-solid read-more-btn" onclick="show('expense-info');change_button('expense-down-btn');"><i id="expense-down-btn" class="fas fa-chevron-down"></i></button>
        </div>

    </div>

    <div class="update-container">

        <div class="popup unblurred box" id="update-form">
            <form action="/Budget/update" method="post" class="update-form">

                <div class="input form-item">
                    <label>Details</label>
                <input class="form-ctrl" name="details" id="details" type="text" required/>
                </div>

                <div class="input form-item">
                    <label>Amount</label>
                <input class="form-ctrl" name="amount" id="amount" type="number" required/>
                </div>

                <input type="text" class="hidden" name="record_id" id="record_id">

                <div class="flex-row-to-col flex-center">
                    <button type="submit" id="save" name="event_id" class="btn btn-solid update-save-btn">Save</button>
                    <button type="button" class="btn bg-red clr-white delete-cancel-btn" onclick="togglePopup('update-form');blur_background('container');stillBackground('id1')">Cancel</button>
                </div>

            </form>
        </div>
    </div>

<script src="/Public/assets/js/input_validation.js"></script>
    <script>
        /*Calculate the balance of incomes and expenses*/
        document.getElementById("balance").innerHTML = "<div>Balance :</div><div> Rs. " +
            (parseInt('<?= $income_sum  ?>') - parseInt('<?= $expense_sum ?>')).toString().replace(
                /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","); + "uihui" + "</div>";


        function income_null(id) {
            let income_sum = parseInt('<?= $income_sum ?>');
            if (income_sum == 0) {
                document.getElementById(id).classList.toggle("hidden");
            }
        }

        function expense_null(id) {
            let expense_sum = parseInt('<?= $expense_sum ?>');
            if (expense_sum == 0) {
                document.getElementById(id).classList.toggle("hidden");
            }
        }

        expense_null("expense-show-hide-btn");
        income_null("income-show-hide-btn");

        function show(id) {
            document.getElementById(id).classList.toggle("height100");
            /*show the rest of the incomes and expenses byclicking the drop down button*/
        }

        function show_hide(id) {
            document.getElementById(id).classList.toggle("hidden");
            /*show and hide the form where incomes and expenses can be added*/
        }

        function togglePopup(id, description = 0, amount = 0, record_id, event_id) {
            var form = document.getElementById(id);
            console.log(record_id);
            form.classList.toggle("active");
            form.querySelector("#details").setAttribute("value", description);
            form.querySelector("#amount").setAttribute("value", amount);
            form.querySelector("#record_id").setAttribute("value", record_id);
            form.querySelector("#save").setAttribute("value", event_id);
            /*show the popup to update an income or an expense*/
        }

        function blur_background(id) {
            document.getElementById(id).classList.toggle("blurred")
            /*when popup is shown background is blurred*/
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
            /*when down button is clicked it changes to up button.*/
        }
    </script>
</body>

</html>