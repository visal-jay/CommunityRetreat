<?php 

class RegisteredUserController {

    public function profile(){
            $user_roles=Controller::accessCheck(["registered_user"]);
            $registered_user=new RegisteredUser();
            $uid=$_SESSION["user"]["uid"];
            $reguser_details=$registered_user->getDetails($uid); 
            View::render('profile',$reguser_details,$user_roles);
    }

    public function updateProfilePic(){
        
        $registered_user=new RegisteredUser();
        $uid=$_SESSION["user"]["uid"];
        $data=["uid"=>$uid,"profile_pic"=>$_FILES['profile_pic']];
        $registered_user->changeProfilePic($data); 
    }

    public function calendar(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render("calender",[],$user_roles);
    }

    public function chatApp(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render("chat/userChat",[],$user_roles);
    }

    public function administratored(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render("adminstration",[],$user_roles);
    }
    public function activityLog(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render('history',$user_roles);
    }
   
}


