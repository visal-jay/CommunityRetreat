<!DOCTYPE html>
<html lang="en" id="id1">

<head>
    <title>Budget</title>
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js" charset="utf-8"></script>
    
</head>

<style>
    #chart {
        max-width: 760px;
        margin: 35px auto;
        opacity: 0.9;
    }

    #timeline-chart .apexcharts-toolbar {
        opacity: 1;
        border: 0;
    }

    .income-info {
        overflow: hidden;
        transition: all .5s ease-in-out;
        filter: blur(0px);
        min-height: 500px;
        min-width: 800px;
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

    .btn-field {
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

    .full-budget-details-btn {
        margin: 25px;
    }

    .income-expense-add-container {
        text-align: center;
    }

    .amount-field {
        width: 20%;
        text-align: right;
        margin: 5px;
        padding: 5px;
    }


    .center {
        text-align: center;
    }

    .table {
        width: 100%;
        background: #ddd5d5;
        text-align: center;
        margin: 20px;
    }

    table,
    th,
    td {

        border-collapse: collapse;
    }

    th,
    td {
        border-bottom: 1px solid #fff;
        padding: 8px;
    }

    .container {
        width: 80%;
        max-width: none;
    }

    .color-container {
        border-radius: 8px;
        width: 15%;
        margin: 20px;
        padding: 10px;
    }

    .right {
        text-align: right;
    }

    .overflow {
        width: 40%;
    }

    .canvas {
        display: -webkit-inline-box;
        width: 100%;
    }

    @media screen and (max-width:800px) {
        .container {
            padding: 0;
        }

        .income-info {
            margin-left: 0;
            margin-right: 0;
            padding: 0;
            min-width: 0;
            min-height: 0;
        }

        .expense-info {
            margin-left: 0;
            margin-right: 0;
            padding: 0;
            min-width: 0;
        }

        .update-save-btn {
            border: none;
            font-size: 0.65rem;
        }

        .delete-cancel-btn {
            border: none;
            font-size: 0.65rem;
        }

        .submit-btn {
            font-size: 0.75rem;
        }

        .btn-field {
            width: 35%;
            margin: 2px;
            padding: 2px;
            justify-content: center;
            white-space: nowrap;

        }

        .amount-field {
            width: 32.5%;
            text-align: right;
            overflow: auto;
            white-space: nowrap;
            margin: 4px;
            padding: 3px;
        }

        .details-overflow {
            overflow: auto;
            width: 35%;
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

        .apexcharts-toolbar {
            display: none;
        }
    }
</style>


<body>
    <div class="container flex-col flex-center" id="container">

        <div class="income-expenxe-balance-container">

            <div class="bold sum flex-row">
                <!--display the sum of incomes-->
                <div>Sum of Incomes :</div>
                <div><?php echo 'Rs. ' . number_format($income_sum + $donation_sum, 2) ?></div>
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
            <button class="btn btn-md btn-solid" onclick="window.location.href=' /Budget/budgetReport?event_id=<?= $_GET['event_id'] ?>'">Full
                Budget details</button>
        </div>

        <div class="center canvas-graph">
            <canvas id="myChart"></canvas>
        </div>

        <div class="container">
            <div class="income-expense-add-container">

                <?php if ($organization || $treasurer) { ?>
                    <!--Add incomes to the database-->
                    <form action="/Budget/addIncomeAndExpense?" method="post" class="form income-form">

                        <div>
                            <button class="btn btn-sm btn-solid margin-md" type="button" id="button" value="Add" onclick="show_hide('income-form')">Add &nbsp;<i class="fas fa-plus"></i></button>
                        </div>

                        <div id="income-form" class="hidden income-expense-form-inside">

                            <div class="input form-item">
                                <label class="form hidden" for="mode">Type</label>
                                <select class="form-ctrl margin-side-md" name="type" id="type">
                                    <option value="INCOME">Income</option>
                                    <option value="EXPENSE">Expense</option>
                                </select>
                            </div>

                            <div class="input form-item">
                                <label>Details</label>
                                <input class="form-ctrl" name="details" id=" details" type="text" placeholder="Enter the details" required />
                            </div>

                            <div class="input form-item">
                                <label>Amount</label>
                                <input class="form-ctrl" name="amount" id="amount" type="number" placeholder="Enter the amount" required />
                            </div>

                            <div class="form-action-buttons">
                                <input type="text" class="hidden" name="event_id" value="<?= $_GET["event_id"] ?>">
                                <button class="btn submit-btn" type="submit">Submit</button>
                            </div>

                        </div>
                    </form>
                <?php } ?>

            </div>
        </div>


        <div style="text-align: -webkit-center; margin-top:20px">
            <div class="income-info" id="income-info">
                <div class="budget-card-container">
                    <h3 class="details-overflow"></h3>
                    <h3 class="amount-field">Incomes</h3>
                    <h3 class="amount-field">Expenses</h3>
                    <div class="flex-row btn-field" style="visibility: hidden;">
                        <div>
                            <!--Update the income and save it in database-->
                            <button class="btn btn-solid update-save-btn " onclick="togglePopup('update-form','<?= $income['details'] ?>', '<?= $income['amount'] ?>', '<?= $income['record_id'] ?>','<?= $_GET['event_id'] ?>'); blur_background('container');stillBackground('id1')">update</button>
                        </div>

                        <form action="/Budget/delete?" method="post">
                            <!--Delete the income and save it in database-->
                            <input type="text" class="hidden" name="record_id" value="<?= $income['record_id'] ?>">
                            <input type="hidden" name="event_id" value=<?= $_GET['event_id'] ?>>
                            <button class="btn bg-red clr-white delete-cancel-btn" style="border: none;" type="submit">
                                Delete</button>
                        </form>
                    </div>
                </div>
                <div class="budget-card-container">
                    <!--Display the donation sum from the database-->
                    <p class="details-overflow">Donations</p>
                    <p class="amount-field"><?php echo 'Rs. ' . number_format($donation_sum, 2) ?></p>
                    <p class="amount-field"></p>
                    <div class="flex-row btn-field" style="visibility: hidden;">
                        <div>
                            <!--Update the income and save it in database-->
                            <button class="btn btn-solid update-save-btn " onclick="togglePopup('update-form','<?= $income['details'] ?>', '<?= $income['amount'] ?>', '<?= $income['record_id'] ?>','<?= $_GET['event_id'] ?>'); blur_background('container');stillBackground('id1')">update</button>
                        </div>

                        <form action="/Budget/delete?" method="post">
                            <!--Delete the income and save it in database-->
                            <input type="text" class="hidden" name="record_id" value="<?= $income['record_id'] ?>">
                            <input type="hidden" name="event_id" value=<?= $_GET['event_id'] ?>>
                            <button class="btn bg-red clr-white delete-cancel-btn" style="border: none;" type="submit">
                                Delete</button>
                        </form>
                    </div>
                </div>


                <?php foreach ($report as $income) { ?>

                    <div class="budget-card-container">
                        <!--Display all the incomes from the database-->
                        <p class="details-overflow"><?= $income["details"] ?></p>
                        <?php if (substr($income["record_id"], 0, 3) === "INC") { ?>
                            <p class="amount-field"><?php echo 'Rs. ' . number_format($income["amount"], 2) ?></p>
                            <p class="amount-field"></p>
                        <?php } else { ?>
                            <p class="amount-field"></p>
                            <p class="amount-field"><?php echo 'Rs. ' . number_format($income["amount"], 2) ?></p>
                        <?php } ?>
                        <div class="flex-row btn-field">
                            <div>
                                <!--Update the income and save it in database-->
                                <button class="btn btn-solid update-save-btn " onclick="togglePopup('update-form','<?= $income['details'] ?>', '<?= $income['amount'] ?>', '<?= $income['record_id'] ?>','<?= $_GET['event_id'] ?>'); blur_background('container');stillBackground('id1')">update</button>
                            </div>

                            <form action="/Budget/delete?" method="post">
                                <!--Delete the income and save it in database-->
                                <input type="text" class="hidden" name="record_id" value="<?= $income['record_id'] ?>">
                                <input type="hidden" name="event_id" value=<?= $_GET['event_id'] ?>>
                                <button class="btn bg-red clr-white delete-cancel-btn" style="border: none;" type="submit">
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php if(sizeof($report)>9) { ?>
        <div id="income-show-hide-btn" class="income-expense-show-hide-btn">
            <!--Show all the hidden incomes-->
            <button class=" btn btn-solid read-more-btn" onclick="show('income-info');change_button('income-down-btn');"><i id="income-down-btn" class="fas fa-chevron-down"></i></button>
        </div>
        <?php } ?>

    </div>

    <div class="update-container">

        <div class="popup unblurred box" id="update-form">
            <form action="/Budget/update?event_id=<?= $_GET['event_id'] ?>" method="post" class="update-form">

                <div class="input form-item">
                    <label>Details</label>
                    <input class="form-ctrl" name="details" id="details" type="text" required />
                </div>

                <div class="input form-item">
                    <label>Amount</label>
                    <input class="form-ctrl" name="amount" id="amount" type="number" required />
                </div>

                <input type="text" class="hidden" name="record_id" id="record_id">

                <div class="flex-row-to-col flex-center">
                    <input type="hidden" name="event_id" value=<?= $_GET['event_id'] ?>>
                    <button type="submit" id="save" name="event_id" class="btn btn-solid update-save-btn">Save</button>
                    <button type="button" class="btn bg-red clr-white delete-cancel-btn" onclick="togglePopup('update-form');blur_background('container');stillBackground('id1')">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</body>
<script src="/Public/assets/js/input_validation.js"></script>
<script>
    /*Calculate the balance of incomes and expenses*/
    document.getElementById("balance").innerHTML = "<div>Balance :</div><div> Rs. " +
        (parseInt('<?= $income_sum  ?>') + parseInt('<?= $donation_sum ?>') - parseInt('<?= $expense_sum ?>')).toString().replace(
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

<script>
    /*send data to the graph*/
    const income_graph = <?= $income_graph ?>;
    const expense_graph = <?= $expense_graph ?>;

    console.log(expense_graph);
    let keys = [];
    let amounts_income = [];
    let amounts_expense = [];
    for (const event in income_graph) {
        keys.push(income_graph[event]["day"]);
        amounts_income.push(income_graph[event]["amount"]);
    }
    for (const event in expense_graph) {
        amounts_expense.push(expense_graph[event]["amount"]);
    }
  

    var myLineChart = new Chart('myChart', {
        type: 'line',
        data: {
            labels: keys,
            datasets: [{
                label: 'Incomes',
                data: amounts_income,
                borderColor: '#F08080',
                backgroundColor: 'transparent'
            },
            {
                label: 'Expense',
                data: amounts_expense,
                borderColor: '#00FFFF',
                backgroundColor: 'transparent'
            }]

        },
        options: {
            responsive: true,
            scales: {
                y: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Amount',
                    },
                }],
                x: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Date',
                    },
                    ticks: {
                        beginAtZero: true,
                    }

                }]
            }
        }
    });
</script>


</html>