<?php
class AdminController{
    public function dashboard(){
        $user_roles = Controller::accessCheck(["admin"]);
        View::render('adminPage',$user_roles);
    }

    public function profile(){
        $user_roles = Controller::accessCheck(["admin"]);
        $admin=new Admin();
        $uid=$_SESSION["user"]["uid"];
        $admin_details=$admin->getDetails($uid); 
        View::render('adminProfile',$admin_details,$user_roles);
    }

    public function activityLog()
    {
        View::render('history');
    }

    public function complaint(){
        $user_roles=Controller::accessCheck(["admin"]);
        View::render("admin",[],$user_roles);
    }
    public function systemFeedbacks(){
        $user_roles=Controller::accessCheck(["admin"]);
        View::render("systemFeedback",[],$user_roles);
    }

    public function viewFeedbacks(){
      
        $systemFeedback=new Systemfeedback();
        $systemFeedbacks= $systemFeedback->renderSystemFeedbacks();
        echo json_encode($systemFeedbacks);
        
    }
    public function feedbackViewed(){

        $systemFeedback=new Systemfeedback();
        $data=["feedback_id"=>$_POST['feedback_id']];
        $systemFeedback->changeFeedbackState($data);
        Controller::redirect("systemFeedbacks");
    }
}
