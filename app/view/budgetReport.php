<!DOCTYPE html>
<html lang="en" id="id1">

<head>
    <title>Budget Report</title>
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
</head>

<style>
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

    .date-time-container {
        display: flex;
        font-size: 12px;
        width: 20%;
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

    @media screen and (max-width:800px) {
        .overflow {
            overflow: scroll;
        }

        .table {
            width: 80%;
            text-align: center;
        }

        .container {
            width: 100%;
        }
    }
</style>

<body>
    <header class="header">

        <div style="width: 20%;">
            <a class=" logo ">
                <img src="/Public/assets/visal logo.png ">
            </a>
        </div>

        <div style="width: 60%; text-align:center">
            <p style="color: #16C79A;">Report generated by <a style=" color: #16c79a;" href="/User/home"><b>CommunityRetreat</b> </a>
            </p>
        </div>

        <div class="date-time-container">
            <p>Date and Time: <span id='date-time'></span>.</p>
            <br><br>
        </div>

    </header>

    <h1 class="center"><?= $event_name ?></h1>

    <h3 class="center">Budget Report</h3>

    <div class="container">

        <div class="container">

            <table class="table">
                <!--Display all the incomes and expenses from database-->

                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th class="right">Income</th>
                    <th class="right">Expense</th>
                </tr>
                <tr>
                    <td></td>
                    <td>Donations</td>
                    <td class="right"><?php echo 'Rs. ' . number_format($donation_sum, 2) ?></td>
                    <td class="right"></td>
                </tr>
                <?php foreach ($report as $report) { ?>
                    <tr>
                        <td><?= $report["date"] ?></td>
                        <td class="overflow"><?= $report["details"] ?></td>
                        <td class="right">
                            <?php if (substr($report["record_id"], 0, 3) === "INC") {
                                echo 'Rs. ' . number_format($report["amount"], 2);
                            } ?>
                        </td>
                        <td class="right">
                            <?php if (substr($report["record_id"], 0, 3) === "EXP") {
                                echo 'Rs. ' . number_format($report["amount"], 2);
                            } ?>
                        </td>
                    </tr>

                <?php } ?>
                <tr>
                    <!--Display the total of incomes and total of expenses-->
                    <td><b>Total</b></td>
                    <td></td>
                    <td class="right"><b><?php echo 'Rs. ' . number_format($income_sum + $donation_sum, 2) ?></b></td>
                    <td class="right"><b><?php echo 'Rs. ' . number_format($expense_sum, 2) ?></b></td>
                </tr>

                <tr>
                    <!--Display the differance of incomes and total of expenses-->
                    <td><b>Balance</b></td>
                    <td></td>
                    <td></td>
                    <td class="right" id="balance"></td>
                </tr>
            </table>
        </div>

        <div class="container">

            <div style="display: flex; text-align:center; justify-content: center;">
                <div class="color-container" style="background-color: #01937C;"><b>Current</b></div>
                <div class="color-container" style="background-color: #FF0000;"><b>Deleted</b></div>
                <div class="color-container" style="background-color: #FAFF00;"><b>Updated</b></div>
            </div>
        </div>

        <div class=" container">

            <h2 class="center">Income</h2>

            <table class="table">
                <!--Display all the incomes and status of the income and who edited the incomes-->
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th class="right">Income</th>
                    <th class="right">Edited by</th>
                </tr>

                <?php foreach ($income_report as $income_report) { ?>
                    <tr style="background-color: <?php if ($income_report["status"] == "current") echo '#01937C';
                                                    elseif ($income_report["status"] == "deleted") echo '#FF0000';
                                                    elseif ($income_report["status"] == "updated") echo '#FAFF00'; ?>">
                        <td><?= $income_report["date"] ?></td>
                        <td class="overflow"><?= $income_report["details"] ?></td>
                        <td class="right"><?php if ($income_report["status"] == "deleted") echo " ";
                                            else echo 'Rs. ' . number_format($income_report["amount"], 2); ?></td>
                        <td class="right"><?= $income_report["username"] ?></td>
                    </tr>
                    <?php if ($income_report["status"] == "deleted" || $income_report["status"] == "current") echo '<tr style="background-color: white; height:20px;"></tr>'; ?>
                <?php } ?>
            </table>
        </div>

        <div class=" container">

            <h2 class="center">Expense</h2>

            <table class="table">
                <!--Display all the expenses and status of the expens and who edited the expenses-->

                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th class="right">Expense</th>
                    <th class="right">Edited by</th>
                </tr>

                <?php foreach ($expense_report as $expense_report) { ?>
                    <tr style="background-color: <?php if ($expense_report["status"] == "current") echo '#01937C';
                                                    elseif ($expense_report["status"] == "deleted") echo '#FF0000';
                                                    elseif ($expense_report["status"] == "updated") echo '#FAFF00'; ?>">
                        <td><?= $expense_report["date"] ?></td>
                        <td class="overflow"><?= $expense_report["details"] ?></td>
                        <td class="right"><?php if ($expense_report["status"] == "deleted") echo " ";
                                            else echo 'Rs. ' . number_format($expense_report["amount"], 2); ?></td>
                        <td class="right"><?= $expense_report["username"] ?></td>
                    </tr>
                    <?php if ($expense_report["status"] == "deleted" || $expense_report["status"] == "current") echo '<tr style="background-color: white; height:20px;"></tr>'; ?>
                <?php } ?>
            </table>
        </div>
    </div>

</body>

<script>
    /*get date and time*/
    var dt = new Date();
    document.getElementById('date-time').innerHTML = dt;
</script>

<script>
    /*Calculate the balance of incomes and expenses*/
    document.getElementById("balance").innerHTML = "<div><b>Rs. " +
        (parseInt('<?= $income_sum  ?>') - parseInt('<?= $expense_sum ?>')).toString().replace(
            /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","); +
    "</b></div>";
</script>