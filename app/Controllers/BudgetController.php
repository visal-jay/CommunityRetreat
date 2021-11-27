<?php

class BudgetController
{
    public function view()
    {/*view the incomes and expenses in the UI by sending the data from backend*/

        Controller::validateForm([], ["url", "page", "event_id"]);
        $user_roles = Controller::accessCheck(["organization", "moderator", "treasurer"], $_GET["event_id"]);
        $budget = new Budget();
        $data["report"] = $budget->getBudget($_GET["event_id"]);

        $expense_details = $budget->getExpenseDetails($_GET["event_id"]);
        $income_details = $budget->getIncomeDetails($_GET["event_id"]);
        $income_sum = $budget->getIncomeSum($_GET["event_id"]);
        $expense_sum = $budget->getExpenseSum($_GET["event_id"]);
        $donate_sum = $budget->getDonationSum($_GET["event_id"]);
        $donate_sum = $budget->getDonationSum($_GET["event_id"]);
        $data["budget_graph"] = json_encode($budget->getBudgetReport(["event_id" => $_GET["event_id"]]));


        $data["incomes"] = $income_details;
        $data["expenses"] = $expense_details;
        $data["income_sum"] = $income_sum;
        $data["expense_sum"] = $expense_sum;
        $data["donation_sum"] = $donate_sum;


        /* var_dump($budget->getDailyBalance($_GET["event_id"]));
        exit(); */
        $data["income_graph"] = $this->converAssocitiveArraytoNumericArray($budget->getDailyIncomeSum($_GET["event_id"]));

        $data["expense_graph"] = $this->converAssocitiveArraytoNumericArray($budget->getDailyExpenseSum($_GET["event_id"]));
        $data["balance_graph"] = $this->converAssocitiveArraytoNumericArray($budget->getDailyBalance($_GET["event_id"]));
        //$balance_graph = $budget->getDailyBalance($_GET["event_id"]);
        $event_details = array_intersect_key((new Events)->getDetails($_GET["event_id"]), ["event_name" => '', "cover_photo" => '']);
        $data = array_merge($event_details, $data);
        View::render("eventPage", $data, $user_roles);/*send data to the event page*/
    }

    /*public function addIncome(){//add incomes to the budget
        Controller::validateForm(["details", "amount", "event_id"], ["url"]);
        Controller::accessCheck(["organization","treasurer"],$_POST["event_id"]);//check whether organization or treasurer accessed it.
        (new UserController)->addActivity("Add Income", $_GET["event_id"]);
        $data=array_merge($_GET, $_POST);
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))//find whether amount is valid
             Controller::redirect("/Event/view?page=budget&&event_id=" .$_POST["event_id"],["amountErr"=>"Inavlid amount"]);

        (new Budget)->addIncome($data);
        Controller::redirect("/Event/view",["page"=>'budget',"event_id"=> $_POST["event_id"]]);//redirect to event page after adding the income.
    }
    */

    /* public function addExpense(){//add expenses to the budget

        Controller::validateForm(["details", "amount", "event_id"], ["url"]);
        Controller::accessCheck(["organization","treasurer"],$_POST["event_id"]);//check whether organization or treasurer accessed it.
        (new UserController)->addActivity("Add Expense", $_GET["event_id"]);

        $data=array_merge($_GET, $_POST);    
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))//find whether amount is valid
             Controller::redirect("/Event/view?page=budget&&event_id=" .$_POST["event_id"],["amountErr"=>"Inavlid amount"]);
     
        (new Budget)->addExpense($data);
        Controller::redirect("/Event/view",["page"=>'budget',"event_id"=> $_POST["event_id"]]);//redirect to event page after adding the expense.
    }*/

    public function addIncomeAndExpense()
    {/*add expenses to the budget*/

        Controller::accessCheck(["organization", "treasurer"], $_POST["event_id"]);/*check whether organization or treasurer accessed it.*/

        $data = array_merge($_GET, $_POST);
        $budget = new Budget();
        $validate = new Validation;
        if (!$validate->currency($_POST["amount"]))/*find whether amount is valid*/
            Controller::redirect("/Event/view?page=budget&&event_id=" . $_POST["event_id"], ["amountErr" => "Inavlid amount"]);

        if (strpos($_POST["type"], 'INC') !== false) {
            $budget->addIncome($_POST);
            (new UserController)->addActivity("Add Income", $_GET["event_id"]);
        } else if (strpos($_POST["type"], 'EXP') !== false) {
            $budget->addExpense($_POST);
            (new UserController)->addActivity("Add Expense", $_GET["event_id"]);
        }

        Controller::redirect("/Event/view", ["page" => 'budget', "event_id" => $_POST["event_id"]]);
    }

    public function update()
    {/*update incomes and expenses*/

        Controller::validateForm(["details", "amount", "record_id", "event_id"], ["url"]);
        Controller::accessCheck(["organization", "treasurer"], $_POST["event_id"]);/*check whether organization or treasurer accessed it.*/
        (new UserController)->addActivity("Update Budget", $_GET["event_id"]);

        $budget = new Budget();
        $validate = new Validation;
        if (!$validate->currency($_POST["amount"]))/*find whether updated amount is valid*/
            Controller::redirect("/Event/view?page=budget&&event_id=" . $_POST["event_id"], ["amountErr" => "Inavlid amount"]);
        if (strpos($_POST["record_id"], 'INC') !== false) {
            $budget->updateIncome($_POST);
        } else if (strpos($_POST["record_id"], 'EXP') !== false) {
            $budget->updateExpense($_POST);
        }
        Controller::redirect("/Event/view", ["page" => 'budget', "event_id" => $_POST["event_id"]]);/*redirect to event page after updating.*/
    }

    public function delete()
    {/*delete incomes and expenses*/

        Controller::validateForm(["record_id", "event_id"], ["url"]);
        Controller::accessCheck(["organization", "treasurer"], $_POST["event_id"]);/*check whether organization or treasurer accessed it.*/
        (new UserController)->addActivity("Delete Budget", $_GET["event_id"]);

        $budget = new Budget();
        if (strpos($_POST["record_id"], 'INC') !== false) {
            $budget->deleteIncome($_POST);
        } else if (strpos($_POST["record_id"], 'EXP') !== false) {
            $budget->deleteExpense($_POST);
        }
        Controller::redirect("/Event/view", ["page" => 'budget', "event_id" => $_POST["event_id"]]);/*redirect to event page after deleting.*/
    }

    public function BudgetReport()/*generate the report of all the incomes and expenses*/
    {
        Controller::validateForm([], ["url", "event_id"]);
        Controller::accessCheck(["organization", "treasurer"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/

        $budget = new Budget();
        $income_report = $budget->IncomeReportGenerate($_GET["event_id"]);
        $expense_report = $budget->ExpenseReportGenerate($_GET["event_id"]);

        /*get incomes and expenses and all the details of them in to an array*/
        $data["report"] = $expense_report;
        array_push($data["report"], ...$income_report);
        usort($data["report"], function ($a, $b) {/*sort the data according to date*/
            return $a['date'] <=> $b['date'];
        });
        $data["income_report"] = $income_report;
        $data["expense_report"] = $expense_report;
        $current_report = array();
        foreach ($data["report"] as $report) {
            if ($report["status"] == 'current') {/*get all the current incomes and expenses into an array.*/
                array_push($current_report, $report);
            }
        }
        $data["report"] = $current_report;
        $data["income_sum"] = $budget->getIncomeSum($_GET["event_id"]);
        $data["expense_sum"]  = $budget->getExpenseSum($_GET["event_id"]);
        $data["event_name"]  = (new Events)->getDetails($_GET["event_id"])["event_name"];
        View::render('budgetReport', $data);/*send those data to budgetReport view file*/
    }

    public function converAssocitiveArraytoNumericArray($input_array){/*convert the associative array to numeric array*/
        /*var_dump($input_array);
        exit();*/
        $numeric_array = array();
        foreach($input_array as $array){
            $temp_array = array();
            foreach($array as $key => $value){
                array_push($temp_array, $value);
            }
            array_push($numeric_array, $temp_array);
        }
        return $numeric_array;
    }


}
