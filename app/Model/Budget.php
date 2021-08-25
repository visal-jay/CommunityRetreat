<?php
class Budget extends Model 
{
	public function addIncome($data){
       if(!isset($_SESSION)) session_start();
       $data["uid"] = $_SESSION["user"]["uid"] = "REG0000016";
        /*var_dump($data);*/
        
        $query = 'INSERT INTO `income` (`details`, `amount`, `uid`, `event_id`) VALUES (:details,  :amount, :uid, :event_id)';
        $params=array_intersect_key($data,["details"=>'',"amount"=>'', "uid"=>'', "event_id"=>'']);
          
        Model::insert($query,$params);     
    }

    public function addExpense($data){
        if(!isset($_SESSION)) session_start();
        $data["uid"] = $_SESSION["user"]["uid"] = "REG0000016";
         /*var_dump($data);*/
         
         $query = 'INSERT INTO `expense` (`details`, `amount`, `uid`, `event_id`) VALUES (:details,  :amount, :uid, :event_id)';
         $params=array_intersect_key($data,["details"=>'',"amount"=>'', "uid"=>'', "event_id"=>'']);
           
         Model::insert($query,$params);     
     }

     public function updateIncome($data){
        if(!isset($_SESSION)) session_start();
        $query = 'SELECT * FROM income where record_id=:record_id ';
        $params = ["record_id" => $record_id];
        $result=Model::select($query,$params);
        return $result;

        $data["uid"] = $_SESSION["user"]["uid"] = "REG0000016";
         /*var_dump($data);*/
         
         $query = 'INSERT INTO `expense` (`details`, `amount`, `uid`, `event_id`) VALUES (:details,  :amount, :uid, :event_id)';
         $params=array_intersect_key($data,["details"=>'',"amount"=>'', "uid"=>'', "event_id"=>'']);
           
         Model::insert($query,$params);     
     }

    public function getIncomeDetails($event_id){
        $query = 'SELECT * FROM income where event_id=:event_id ';
        $params = ["event_id" => $event_id];
        $result=Model::select($query,$params);
        return $result;
    }

    public function getExpenseDetails($event_id){
        $query = 'SELECT * FROM expense where event_id=:event_id ';
        $params = ["event_id" => $event_id];
        $result=Model::select($query,$params);
       return $result;
    }

	
}