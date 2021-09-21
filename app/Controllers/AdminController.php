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
    public function systemFeedback(){
        $user_roles=Controller::accessCheck(["admin"]);
        View::render("systemFeedback",[],$user_roles);
    }
}
