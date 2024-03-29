<?php
class ComplaintController{

    public function makeComplaint(){

        Controller::accessCheck(["registered_user", "organization"]);/*check whether organization or registered user accessed it.*/
        $complaint = new Complaint();
        // Controller::validateForm(['uid','event_id','complaint_name','complaint','complaint_status']);
        $complainant_uid = $_SESSION["user"]["uid"]; //Set user id of complainant
        if($_POST['complaint_status'] =='event'){ // If status of given complaint is event 

            $path = "window.location.href='/Event/view?page=about&&event_id={$_POST["event_id"]}'";
            /*send all details in data array*/
            $data = ["complainant_uid" => $complainant_uid, "uid" => NULL , "event_id" => $_POST['event_id'] , "complaint_name" => $_POST['complaint_name'] ,"complaint" => $_POST['complaint'], "status" =>  $_POST['complaint_status'], "path" => $path ];
            /*call addComplaint function in complaint model*/
            $complaint->addComplaint($data);
            Controller::redirect("/Event/view", ["event_id" => $_POST["event_id"], "page" => "about"]);
        }
        else if($_POST['complaint_status'] == "organization"){ // If status of given complaint is organization
            $path = "window.location.href='/Organisation/view?page=about&org_id={$_POST['uid']}'";
            /*send all details in data array*/
            $data = ["complainant_uid" => $complainant_uid, "uid" =>$_POST['uid'], "event_id" => NULL , "complaint_name" => $_POST['complaint_name'] , "complaint" =>  $_POST['complaint'], "status" =>  $_POST['complaint_status'], "path" => $path ];
            /*call addComplaint function in complaint model*/
            $complaint->addComplaint($data);
            Controller::redirect("/Organisation/view",["org_id" => $_POST["uid"], "page" => "about"]);

        }
        else if($_POST['complaint_status'] == "user"){ // If status of given complaint is user
            $path = "window.location.href='/Feedback/statusToggle?event_id={$_POST['event_id']}&&feedback_id={$_POST['feedback_id']}'";
            /* get event details*/
            $event_details = (new Events)->getDetails($_POST["event_id"]);
            /*send all details in data array*/
            $data = ["complainant_uid" => $complainant_uid, "uid" =>$_POST['uid'], "event_id" => $_POST['event_id'] , "complaint_name" =>  $_POST['complaint_name'] , "complaint" =>  $_POST['complaint'], "status" =>  $_POST['complaint_status'], "path" => $path ];
            /*call addComplaint function in complaint model*/
            $complaint->addComplaint($data);
            Controller::redirect("/Event/view", ["page" => "feedback", "event_id" => $_POST["event_id"]]);
        }

       
    }

    //Get complaints
    public function getComplaints($data){
        $complaint = new Complaint;
        $result = $complaint->getComplaints($data); //Call model to get complaints
        return $result;
    }

    //Dismiss the complaint
    public function dismissComplaint(){

        $complaint = new Complaint;
        $complaint->dismissComplaint($_POST['complaint_id']); //Call model to get complaint
        Controller::redirect("/Admin/complaint");
    }

    //Remove an existing complaint
    public function removeComplaint($data){
         $complaint = new Complaint;
         /* call deleteComplaint function in complaint model*/
         $complaint->deleteComplaint($data);
    }
 
    
}
?>