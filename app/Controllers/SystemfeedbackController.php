<?php

class SystemfeedbackController{

    //Insert a complaint
    public function makeSystemFeedbacks(){
        Controller::validateForm(["feedback"]);
        $user_roles=Controller::accessCheck(["admin","organization","registered_user"]);
        $feedback = new Systemfeedback();
        $uid = $_SESSION["user"]["uid"];
        $data = ['uid' => $uid, 'feedback'=>$_POST['feedback']];
        $feedback->updateSystemFeedback($data); //insert a systemfeedback
        (new UserController)->addActivity("You gave system feedback"); //add activity "You gave system feedback"
        if($user_roles["organization"]) //if feedback given by organization
            Controller::redirect("/Organisation/dashboard");
        elseif($user_roles["registered_user"] ) //if feedback given by registered user
            View::render("home",[],$user_roles);
    }
    //Get systemfeedbacks to the view
    public function getSystemFeedbacks($data){
        $systemFeedback=new Systemfeedback();
        $systemFeedbacks= $systemFeedback->renderSystemFeedbacks($data); //render feedbacks into the view
        return $systemFeedbacks;
    }

    //Set feedback as viewed
    public function setFeedbackViewed($data){
        $systemFeedback=new Systemfeedback();
        $systemFeedback->changeFeedbackState($data);  //set feedback as viewed (set viewed = 1)
    }

}