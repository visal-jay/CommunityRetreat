<?php 
    
class BudgetController
{
    public function view(){//view the incomes and expenses in the UI by sending the data from backend
        
        //Controller::accessCheck(["organization","treasurer"],$_GET["event_id"]);
        $user_roles=Controller::accessCheck(["organization","moderator,treasurer"],$_GET["event_id"]);
        $budget = new Budget();
        $expense_details=$budget->getExpenseDetails($_GET["event_id"]);
        $income_details=$budget->getIncomeDetails($_GET["event_id"]);
        $income_sum = $budget->getIncomeSum($_GET["event_id"]);
        $expense_sum = $budget->getExpenseSum($_GET["event_id"]);
        $donate_sum = $budget->getDonationSum($_GET["event_id"]);
        
        $data["incomes"]=$income_details;
        $data["expenses"]=$expense_details;
        $data["income_sum"]=$income_sum;
        $data["expense_sum"]=$expense_sum;
        $data["donation_sum"]=$donate_sum;
        
        $event_details=array_intersect_key((new Events)->getDetails($_GET["event_id"]),["event_name"=>'',"cover_photo"=>'']);
        $data=array_merge($event_details,$data);
        View::render("eventPage",$data,$user_roles);
        View::render("budgetReport",$data);
    } 
     
	public function addIncome(){//add incomes to the budget
        
        $data=array_merge($_GET, $_POST);
        Controller::accessCheck(["organization","treasurer"]);
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("/event/view?page=budget&&event_id=" .$_POST["event_id"],["amountErr"=>"Inavlid amount"]);

        (new Budget)->addIncome($data);
        Controller::redirect("/event/view",["page"=>'budget',"event_id"=> $_POST["event_id"]]);
    }

    public function addExpense(){//add expenses to the budget
        
        $data=array_merge($_GET, $_POST);    
        Controller::accessCheck(["organization","treasurer"]);
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("/event/view?page=budget&&event_id=" .$_POST["event_id"],["amountErr"=>"Inavlid amount"]);
     
        (new Budget)->addExpense($data);
        Controller::redirect("/event/view",["page"=>'budget',"event_id"=> $_POST["event_id"]]);
    }
	
    public function update(){//update incomes and expenses
        $budget = new Budget();   
        $validate=new Validation;
        if(!$validate->currency($_POST["amount"]))
             Controller::redirect("/event/view?page=budget&&event_id=" .$_POST["event_id"],["amountErr"=>"Inavlid amount"]);
        if (strpos($_POST["record_id"], 'INC') !== false) {
          $budget->updateIncome($_POST); 
        }else if(strpos($_POST["record_id"], 'EXP') !== false){
            $budget->updateExpense($_POST); 
        }
        Controller::redirect("/event/view",["page"=>'budget',"event_id"=> $_POST["event_id"]]);
     
    }

    public function delete(){//delete incomes and expenses
        $budget = new Budget();
        if (strpos($_POST["record_id"], 'INC') !== false) {
          $budget->deleteIncome($_POST);               
        }
        else if(strpos($_POST["record_id"], 'EXP') !== false){
            $budget->deleteExpense($_POST); 
        }
        Controller::redirect("/event/view",["page"=>'budget',"event_id"=> $_POST["event_id"]]);

    }
    
    /*public function BudgetReportGenerate(){
        $budget = new Budget();
        $income_details=$budget->BudgetReportGenerate($_GET["event_id"]);
        $expense_details=$budget->BudgetReportGenerate($_GET["event_id"]);
        $data["incomes"]=$income_details;
        $data["expenses"]=$expense_details;
        View::render('budgetReport',$data); 
    }
    */
}
?>