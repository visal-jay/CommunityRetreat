<?php
class ComplaintController{

    public function makeComplaint(){

        $complaint = new Complaint();
        Controller::validateForm(['uid','event_id','complaint_name','complaint','complaint_status']);
        if($_POST['complaint_status'] =='event'){

            $path = "window.location.href='/Event/view?page=about&&event_id={$_POST["event_id"]}'";
            $data = ["uid" => NULL , "event_id" => $_POST['event_id'] , "complaint_name" => $_POST['complaint_name'] ,"complaint" => $_POST['complaint'], "status" =>  $_POST['complaint_status'], "path" => $path ];
            $complaint->addComplaint($data);
            Controller::redirect("/Event/view", ["event_id" => $_POST["event_id"], "page" => "about"]);
        }
        else if($_POST['complaint_status'] == "organization"){
            $path = "window.location.href='/Organisation/view?page=about&org_id={$_POST['uid']}'";
            $data = ["uid" =>$_POST['uid'], "event_id" => NULL , "complaint_name" => $_POST['complaint_name'] , "complaint" =>  $_POST['complaint'], "status" =>  $_POST['complaint_status'], "path" => $path ];
            $complaint->addComplaint($data);
            Controller::redirect("/Organisation/view");

        }
    }
 
    
}
?>