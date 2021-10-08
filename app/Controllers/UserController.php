<?php

class UserController{
    public function home(){
        $user_roles=Controller::accessCheck(["admin","organization","registered_user","guest_user"]);
        if($user_roles["admin"])
            Controller::redirect("/Admin/dashboard");
        else if($user_roles["organization"])
            Controller::redirect("/Organisation/dashboard");
        elseif($user_roles["registered_user"] || $user_roles["guest_user"])
            View::render("home",[],$user_roles);
    }

    public function profile(){
        $user_roles=Controller::accessCheck(["admin","organization","registered_user"]);
        if($user_roles["admin"])
            Controller::redirect("/Admin/profile");
        else if($user_roles["organization"])
            Controller::redirect("/Organisation/profile");
        elseif($user_roles["registered_user"] || $user_roles["guest_user"])
            Controller::redirect("/RegisteredUser/profile");     
    }

    public function getController(){
        $user_roles=Controller::accessCheck(["admin","organization","registered_user"]);
        if($user_roles["admin"])
            $controller="Admin";
        else if($user_roles["organization"])
            $controller="Organisation";
        elseif($user_roles["registered_user"] || $user_roles["guest_user"])
            $controller="RegisteredUser";
        return $controller;
    }

    public function notifications(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render("notification",[],$user_roles);
    }

    public function updatePassword(){
        Controller::validateForm(["current_password", "new_password","password"]);
        $controller=$this->getController();
        $user = new $controller();
        $validate =new Validation();
        $uid=$_SESSION["user"]["uid"];
        $data = ["uid"=>$_POST['uid'],"password"=>$_POST['password']];
        if(!$user->checkCurrentPassword($uid,$_POST['current_password'])){
            $error1=["currentpassworderr"=>"Password incorrect"];
            Controller::redirect("/$controller/profile", $error1);
        }
        if(!$validate->password($_POST["new_password"])) {
            $error2 = ["newpassworderr"=>"Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols"];
            Controller::redirect("/$controller/profile",$error2);
        }
        else{
            $user->changePassword($uid,$data);
            Controller::redirect("/$controller/profile");
        }       
    }

    public function updateProfilePic(){
        // Controller::validateForm(["profile_pic"]);
        Controller::accessCheck(["admin","registered_user"]);
        $controller=$this->getController();
        $user=new $controller();
        $uid=$_SESSION["user"]["uid"];
        $data=["uid"=>$uid,"profile_pic"=>$_FILES['profile_pic']];
        $user->changeProfilePic($data);
    }

    public function updateUsername(){
        Controller::validateForm(["username"]);
        $controller=$this->getController();
        $user = new $controller();
        $User = new UserController();
        $uid=$_SESSION["user"]["uid"];
        $user->changeUsername($uid,$_POST['username']);
        $this->addActivity("Username Changed",-1);
        Controller::redirect("/$controller/profile");
    }

    public function updateContactNumber(){
        Controller::validateForm(["contact_number"]);
        $controller=$this->getController();
        $validate = new Validation();
        $user = new $controller();
        $uid=$_SESSION["user"]["uid"];
        $data = [ "contact_number"=> $_POST['contact_number']];
        if (!$validate->telephone($_POST["contact_number"])){
            $error["telephoneerr"] = "Valid telephone number required !";
        }   
        if(isset($error)) {

            View::render('profile',$error);
        }          
        else
            $user->changeContactNumber($uid,$data);
            Controller::redirect("/$controller/profile");
    }

    public function updateEmail(){
        Controller::validateForm(["email"]);
        $controller=$this->getController();
        $user = new $controller();
        $validate =new Validation();
        $uid=$_SESSION["user"]["uid"];
        $data = ["email"=>$_POST['email']];
        if(!$validate->email($_POST["email"])){
            $error["invaliderr"] = "Invalid email";
        }
        if((new User)->checkUserEmail($_POST["email"])) {
            $error["emailErr"] = "Email already taken";
        }
        if(isset($error["invaliderr"])){
            Controller::redirect("/$controller/profile",$error);
        }
        else
            $user->changeEmail($uid,$data);
            Controller::redirect("/$controller/profile");
    }

    function addActivity($activity,$event_id=-1){
        $user = new User();
        $user->insertActivity($activity,$event_id);
    }

    function viewActivityLog(){
        $user = new User();
        $activities = $user->getActivity();
        echo json_encode($activities);
    }

    // /Event/view?page=forum&event_id=#&update_announcement_id=#
    //sendNotifications("You have assigend modertor user role",$uid,"system","window.location.href=/Event/view?page=about&event_id=" . $_GET["event_id"], $_GET["event_id"])
    function sendNotifications($notification,$uid,$status,$path,$event_id =-1){
        $user = new User();
        $user->insertNotification($notification,$uid,$status,$path,$event_id);
    }

    function viewNotifications(){
        $user = new User();
        $user->setNotificationViewed();

    }
    function getNotifications(){
        $user = new User();
        $notifications = $user->getNotifications();
        echo json_encode($notifications);

    }
    
    function checkEmailAvailable(){
        Controller::validateForm(["email"]);
        if((new Validation)->email($_POST["email"]));
        echo json_encode(array("taken"=>(new User)->checkUserEmail($_POST["email"])));
    }

}