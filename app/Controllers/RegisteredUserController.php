<?php 

class RegisteredUserController {

    //View Reg user edit profile
    public function profile(){
            $user_roles=Controller::accessCheck(["registered_user"]);
            $registered_user=new RegisteredUser();
            $uid=$_SESSION["user"]["uid"];
            $reguser_details=$registered_user->getDetails($uid); 
            View::render('profile',$reguser_details,$user_roles);
    }

    //View calendar
    public function calendar(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render("calender",[],$user_roles);
    }

    //Get volunteered event details to calendar
    public function  getCalendarDetails(){
    
        $uid=$_SESSION["user"]["uid"];
        $registered_user=new RegisteredUser();
        $calendar_details =  $registered_user->getCalendarDetails($uid);
        echo json_encode($calendar_details);
    }

    //View chat app
    public function chatApp(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render("chat/userChat",[],$user_roles);
    }

    //View administration
    public function administratored(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render("adminstration",[],$user_roles);
    }

    //View activity_log
    public function activityLog(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render('history',$user_roles);
    }
   
}


