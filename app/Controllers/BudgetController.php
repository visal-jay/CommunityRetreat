<?php

class BudgetController
{
    public function view()
    {/*view the incomes and expenses in the UI by sending the data from backend*/
         /*checking whether all the required data comes from the form */
        Controller::validateForm([], ["url", "page", "event_id"]);
        /* allow only organization, moderator and treasurer*/ 
        $user_roles = Controller::accessCheck(["organization", "moderator", "treasurer"], $_GET["event_id"]);
        $budget = new Budget();
        /* get budget details to data array */ 
        $data["report"] = $budget->getBudget($_GET["event_id"]);

        $expense_details = $budget->getExpenseDetails($_GET["event_id"]);
        $income_details = $budget->getIncomeDetails($_GET["event_id"]);
        /* get income sum */
        $income_sum = $budget->getIncomeSum($_GET["event_id"]);
        /* get expense sum */
        $expense_sum = $budget->getExpenseSum($_GET["event_id"]);
        /* get donation sum */
        $donate_sum = $budget->getDonationSum($_GET["event_id"]);

        $data["incomes"] = $income_details;
        $data["expenses"] = $expense_details;
        /* get income sum to the data array*/
        $data["income_sum"] = $income_sum;
        /* get expense sum to the data array*/
        $data["expense_sum"] = $expense_sum;
        /* get donation sum to the data array*/
        $data["donation_sum"] = $donate_sum;

    /*sending amounts dates and  income and expense graph in an associative array*/
        $income_graph = $budget->getDailyIncomeSum($_GET["event_id"]);
        $expense_graph = $budget->getDailyExpenseSum($_GET["event_id"]);
    /*merge the array with dates from incomes and expenses*/
        $dates = array_merge(array_column($income_graph, "day"), array_column($expense_graph, "day"));
        $chart = [];
    /*return an array with all the dates and all the amount as 0 */
        foreach ($dates as $date) {
            $chart[] = ["day" => $date, "amount" => 0];
        }
    /*merge the two arryas*/    
        $temp_income_graph = array_merge($income_graph, $chart);
    /*remove the duplicates from the temp_income_graph */
        $data["income_graph"] = (array_intersect_key($temp_income_graph, array_unique(array_column($temp_income_graph, 'day'))));
    /*merge the two arryas*/
        $temp_expense_graph = array_merge($expense_graph, $chart);
    /*remove the duplicates from the temp_income_graph */
        $data["expense_graph"] = (array_intersect_key($temp_expense_graph, array_unique(array_column($temp_expense_graph, 'day'))));
    
    /*sort the  array according to date*/    
        usort($data["expense_graph"], function ($a, $b) {
            return strcmp($a['day'], $b['day']);
        });

        usort($data["income_graph"], function ($a, $b) {
            return strcmp($a['day'], $b['day']);
        });
    /* prepare the array to send to javascript language*/
        $data["expense_graph"] = json_encode($data["expense_graph"]);
        $data["income_graph"] = json_encode($data["income_graph"]);

        $event_details = array_intersect_key((new Events)->getDetails($_GET["event_id"]), ["event_name" => '', "cover_photo" => '']);
        $data = array_merge($event_details, $data);
        /*send data to the event page*/
        View::render("eventPage", $data, $user_roles);
    }

    public function addIncomeAndExpense()
    {/*add incomes and expenses to the budget*/

        Controller::accessCheck(["organization", "treasurer"], $_POST["event_id"]);/*check whether organization or treasurer accessed it.*/

        $data = array_merge($_GET, $_POST);
        $budget = new Budget();
        $validate = new Validation;
        /*find whether amount is valid*/
        if (!$validate->currency($_POST["amount"]))
            Controller::redirect("/Event/view?page=budget&&event_id=" . $_POST["event_id"], ["amountErr" => "Inavlid amount"]);
    	/*check whether the type has "INC" string*/
        if (strpos($_POST["type"], 'INC') !== false) {
            $budget->addIncome($_POST);
            /* Activity log will be updated after adding an income*/
            (new UserController)->addActivity("Add Income", $_GET["event_id"]);
            /*check whether the type has "EXP" string*/
        } else if (strpos($_POST["type"], 'EXP') !== false) {
            $budget->addExpense($_POST);
            /* Activity log will be updated after adding an expense*/
            (new UserController)->addActivity("Add Expense", $_GET["event_id"]);
        }
        /*redirect to budgeting of the event page after adding an income or an expense.*/
        Controller::redirect("/Event/view", ["page" => 'budget', "event_id" => $_POST["event_id"]]);
    }

    public function update()
    {/*update incomes and expenses*/
        /*checking whether all the required data comes from the form */
        Controller::validateForm(["details", "amount", "record_id", "event_id"], ["url"]);
        Controller::accessCheck(["organization", "treasurer"], $_POST["event_id"]);/*check whether organization or treasurer accessed it.*/
        (new UserController)->addActivity("Update Budget", $_GET["event_id"]);

        $budget = new Budget();
        $validate = new Validation;
        if (!$validate->currency($_POST["amount"]))/*find whether updated amount is valid*/
            Controller::redirect("/Event/view", ["page"=>"budget","event_id" => $_POST["event_id"],"amountErr" => "Inavlid amount"]);
        /*check whether the type has "INC" string*/
            if (strpos($_POST["record_id"], 'INC') !== false) {
            $budget->updateIncome($_POST);
            /*check whether the type has "EXP" string*/
        } else if (strpos($_POST["record_id"], 'EXP') !== false) {
            $budget->updateExpense($_POST);
        }
        /*redirect to budgeting of the event page after updating.*/
        Controller::redirect("/Event/view", ["page" => 'budget', "event_id" => $_POST["event_id"]]);
    }

    public function delete()
    {/*delete incomes and expenses*/
         /*checking whether all the required data comes from the form */
        Controller::validateForm(["record_id", "event_id"], ["url"]);
        /*check whether organization or treasurer accessed it.*/
        Controller::accessCheck(["organization", "treasurer"], $_POST["event_id"]);
        /*after deleting a record will be added to the activity log */
        (new UserController)->addActivity("Delete Budget", $_GET["event_id"]);

        $budget = new Budget();
        /*check whether the type has "INC" string*/
        if (strpos($_POST["record_id"], 'INC') !== false) {
            $budget->deleteIncome($_POST);
        /*check whether the type has "EXP" string*/
        } else if (strpos($_POST["record_id"], 'EXP') !== false) {
            $budget->deleteExpense($_POST);
        }
        /*redirect to budgeting of the event page after deleting.*/
        Controller::redirect("/Event/view", ["page" => 'budget', "event_id" => $_POST["event_id"]]);/*redirect to event page after deleting.*/
    }

    public function BudgetReport()/*generate the report of all the incomes and expenses*/
    {
        /*checking whether all the required data comes from the form */
        Controller::validateForm([], ["url", "event_id"]);
        /*check whether organization or treasurer accessed it.*/
        Controller::accessCheck(["organization", "treasurer"], $_GET["event_id"]);

        $budget = new Budget();
        /*send the income details and expense details to generate a report*/
        $income_report = $budget->IncomeReportGenerate($_GET["event_id"]);
        $expense_report = $budget->ExpenseReportGenerate($_GET["event_id"]);
        

        /*get expenses_report in to data array*/
        $data["report"] = $expense_report;
        /*push the income_report to the data array aswell*/
        array_push($data["report"], ...$income_report);
        usort($data["report"], function ($a, $b) {
            /*sort the data according to date*/
            return $a['date'] <=> $b['date'];
        });
        $data["income_report"] = $income_report;
        $data["expense_report"] = $expense_report;
        $current_report = array();
        foreach ($data["report"] as $report) {
            /*get all the current incomes and expenses into an array.*/
            if ($report["status"] == 'current') {
                array_push($current_report, $report);
            }
        }
        $data["report"] = $current_report;
        $data["income_sum"] = $budget->getIncomeSum($_GET["event_id"]);
        $data["expense_sum"]  = $budget->getExpenseSum($_GET["event_id"]);
        $data["donation_sum"] = $budget->getDonationSum($_GET["event_id"]);
        $data["event_name"]  = (new Events)->getDetails($_GET["event_id"])["event_name"];
        View::render('budgetReport', $data);/*send those data to budgetReport view file*/
    }

    public function converAssocitiveArraytoNumericArray($input_array)
    {/*convert the associative array to numeric array*/
        $numeric_array = array();
        foreach ($input_array as $array) {
            $temp_array = array();
            foreach ($array as $key => $value) {
                array_push($temp_array, $value);
            }
            array_push($numeric_array, $temp_array);
        }
        return $numeric_array;
    }
}
