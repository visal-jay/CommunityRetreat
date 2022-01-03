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
        $uid=$_SESSION["user"]["uid"];
        $pagination = Model::pagination("moderator_treasurer", 10, " WHERE uid = :uid", ["uid" => $uid]);
        $registered_user = new RegisteredUser();
        $data['administrations'] = $registered_user->getAdministrations(["uid" =>$uid,"offset" => $pagination["offset"], "no_of_records_per_page" => $pagination["no_of_records_per_page"]]);
        View::render("adminstration",array_merge($data,$pagination),$user_roles);
    }

   
}


