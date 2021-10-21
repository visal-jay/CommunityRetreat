<?php
class ComplaintController{

    public function makeComplaint(){

        $complaint = new Complaint();
        // Controller::validateForm(['uid','event_id','complaint_name','complaint','complaint_status']);
        $complainant_uid = $_SESSION["user"]["uid"];
        if($_POST['complaint_status'] =='event'){

            $path = "window.location.href='/Event/view?page=about&&event_id={$_POST["event_id"]}'";
            $data = ["complainant_uid" => $complainant_uid, "uid" => NULL , "event_id" => $_POST['event_id'] , "complaint_name" => $_POST['complaint_name'] ,"complaint" => $_POST['complaint'], "status" =>  $_POST['complaint_status'], "path" => $path ];
            $complaint->addComplaint($data);
            Controller::redirect("/Event/view", ["event_id" => $_POST["event_id"], "page" => "about"]);
        }
        else if($_POST['complaint_status'] == "organization"){
            $path = "window.location.href='/Organisation/view?page=about&org_id={$_POST['uid']}'";
            $data = ["complainant_uid" => $complainant_uid, "uid" =>$_POST['uid'], "event_id" => NULL , "complaint_name" => $_POST['complaint_name'] , "complaint" =>  $_POST['complaint'], "status" =>  $_POST['complaint_status'], "path" => $path ];
            $complaint->addComplaint($data);
            Controller::redirect("/Organisation/view");

        }
        else if($_POST['complaint_status'] == "user"){
            $path = "window.location.href='/Feedback/statusToggle?event_id={$_POST['event_id']}&&feedback_id={$_POST['feedback_id']}'";
            $data = ["complainant_uid" => $complainant_uid, "uid" =>$_POST['uid'], "event_id" => NULL , "complaint_name" =>  $_POST['complaint_name'] , "complaint" =>  $_POST['complaint'], "status" =>  $_POST['complaint_status'], "path" => $path ];
            $complaint->addComplaint($data);
            Controller::redirect("/Event/view", ["page" => "feedback", "event_id" => $_POST["event_id"]]);
        }
    }
 
    
}
?>