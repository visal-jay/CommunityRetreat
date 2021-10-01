<?php
class ComplaintController{

    public function addComplaint(){

        $data=array_merge($_GET, $_POST);
        (new Complaint)->addComplaint($data);
        //Controller::redirect("/Event/view",["page"=>'budget',"event_id"=> $_POST["event_id"]]);/*redirect to event page after adding the income.*/
    }
    
}
?>