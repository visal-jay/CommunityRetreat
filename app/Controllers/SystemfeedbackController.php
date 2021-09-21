<?php

class SystemfeedbackController{

    public function getSystemFeedbacks(){
        $feedback = new Systemfeedback();
        $uid = $_SESSION["user"]["uid"];
        $data = ['uid' => $uid, 'feedback'=>$_POST['feedback']];
        $feedback->updateSystemFeedback($data);
        View::render("home");
    }
}