<?php
class Complaint extends Model{

    public function addComplaint($data){
        if(!isset($_SESSION)) session_start();
        $data["uid"] = $_SESSION["user"]["uid"] ;       
        $query = 'INSERT INTO `complaint` (`uid`, `event_id`, `details`, `date`, `status`) VALUES (:uid, :event_id, :details, :date, "added")';
        $params=array_intersect_key($data,["details"=>'',"amount"=>'', "uid"=>'', "event_id"=>'']); 
        Model::insert($query,$params);     

    }
}
?>