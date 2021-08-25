<?php 
    
class BudgetController
{
    public function view(){
        //Controller::accessCheck(["organization","treasurer"],$_GET["event_id"]);
        $budget = new Budget();
        var_dump($_GET);
        $_GET["event_id"]=2;
        $expense_details=$budget->getExpenseDetails($_GET["event_id"]);
        $income_details=$budget->getIncomeDetails($_GET["event_id"]);
        $data["incomes"]=$income_details;
        $data["expenses"]=$expense_details;
        View::render("budgeting",$data);
        
    } 
     
	public function addIncome(){
        $_GET["event_id"]=2;
        $data=array_merge($_GET, $_POST);
        /*Controller::accessCheck(["organization","treasurer"]);*/
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("/budget/view",["amountErr"=>"Inavlid amount"]);

        var_dump($_POST);
        (new Budget)->addIncome($data);
        Controller::redirect("/budget/view");
    }

    public function addExpense(){
        $_GET["event_id"]=2;
        $data=array_merge($_GET, $_POST);
        /*Controller::accessCheck(["organization","treasurer"]);*/
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("/budget/view",["amountErr"=>"Inavlid amount"]);

        var_dump($_POST);
        (new Budget)->addExpense($data);
        Controller::redirect("/budget/view");
    }
	
    public function updateIncome(){
        $budget = new Budget();
        var_dump($_GET);
        exit();
        $income_details=$budget->getIncomeDetails($_GET["record_id"]);
        $old_data["incomes"]=$income_details;
        View::render("budgeting",$old_data);

        $data=array_merge($_GET, $_POST);
        /*Controller::accessCheck(["organization","treasurer"]);*/
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("/budget/view",["amountErr"=>"Inavlid amount"]);

        $new_data=array_merge($old_data, $data);

        var_dump($_POST);
        (new Budget)->updateIncome($data);
        Controller::redirect("/budget/view");
        
    }

    /*public function updateExpense(){
        Controller::accessCheck(["organization","treasurer"]);
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("path",["amountErr"=>"Inavlid amount"]);

        var_dump($_POST);
        (new Budget)->updateExpense($_POST);
    } */
}
?>