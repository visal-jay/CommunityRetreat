<?php 
    
class BudgetController
{
    public function view(){
        //Controller::accessCheck(["organization","treasurer"],$_GET["event_id"]);
        $budget = new Budget();
        $expense_details=$budget->getExpenseDetails($_GET["event_id"]);
        $income_details=$budget->getIncomeDetails($_GET["event_id"]);
        $data["incomes"]=$income_details;
        $data["expenses"]=$expense_details;
        View::render("eventPage",$data);
        
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
	
    public function update(){
        $budget = new Budget();
        var_dump($_POST);
        if (strpos($_POST["record_id"], 'INC') !== false) {
          $budget->updateIncome($_POST); 
        }else if(strpos($_POST["record_id"], 'EXP') !== false){
            $budget->updateExpense($_POST); 
        }
               
    }

    public function delete(){
        $budget = new Budget();
        var_dump($_POST);
        if (strpos($_POST["record_id"], 'INC') !== false) {
          $budget->deleteIncome($_POST);               
    }
    else if(strpos($_POST["record_id"], 'EXP') !== false){
        $budget->deleteExpense($_POST); 
    }
}

    /*public function updateExpense(){
        $budget = new Budget();
        var_dump($_POST);
        if (strpos($_POST["record_id"], 'EXP') !== false) {
          $budget->updateExpense($_POST); 
        }
               
    }*/

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