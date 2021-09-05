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
        $event_details=array_intersect_key((new Events)->getDetails($_GET["event_id"]),["event_name"=>'',"cover_photo"=>'']);
        $data=array_merge($event_details,$data);
        View::render("eventPage",$data);
        
    } 
     
	public function addIncome(){
        
        $data=array_merge($_GET, $_POST);
        /*Controller::accessCheck(["organization","treasurer"]);*/
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("/event/view?page=budget&&event_id=" .$_POST["event_id"],["amountErr"=>"Inavlid amount"]);

        (new Budget)->addIncome($data);
        Controller::redirect("/event/view",["page"=>'budget',"event_id"=> $_POST["event_id"]]);
    }

    public function addExpense(){
        $data=array_merge($_GET, $_POST);    
        /*Controller::accessCheck(["organization","treasurer"]);*/
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("/event/view?page=budget&&event_id=" .$_POST["event_id"],["amountErr"=>"Inavlid amount"]);
     
        (new Budget)->addExpense($data);
        Controller::redirect("/event/view?page=budget&&event_id=" .$_POST["event_id"]);
    }
	
    public function update(){
        $budget = new Budget();   
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("/event/view?page=budget&&event_id=" .$_POST["event_id"],["amountErr"=>"Inavlid amount"]);
        if (strpos($_POST["record_id"], 'INC') !== false) {
          $budget->updateIncome($_POST); 
        }else if(strpos($_POST["record_id"], 'EXP') !== false){
            $budget->updateExpense($_POST); 
        }
        Controller::redirect("/event/view?page=budget&&event_id=" .$_POST["event_id"]);      
    }

    public function delete(){
        $budget = new Budget();
        if (strpos($_POST["record_id"], 'INC') !== false) {
          $budget->deleteIncome($_POST);               
        }
        else if(strpos($_POST["record_id"], 'EXP') !== false){
            $budget->deleteExpense($_POST); 
        }
        Controller::redirect("/event/view?page=budget&&event_id=" .$_POST["event_id"]);
    }
}
?>