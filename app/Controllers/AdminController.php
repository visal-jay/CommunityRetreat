<?php
class AdminController
{

    public function profile()
    {        
        $user_roles=Controller::accessCheck(["admin"]);
        $admin = new Admin();
        $uid = $_SESSION["user"]["uid"];
        $admin_details = $admin->getDetails($uid);
        View::render('adminProfile', $admin_details,$user_roles);
    }

    public function activityLog()
    {
        View::render('history');
    }
}
