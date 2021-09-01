<?php 

class RegisteredUserController {

    public function view(){
            $registered_user=new RegisteredUser();
            if(!isset($_SESSION)) 
                session_start();
            $_SESSION["user"]["uid"]='REG0000022';
            $uid=$_SESSION["user"]["uid"];
            $reguser_details=$registered_user->getDetails($uid); 
            View::render('profile',$reguser_details);
    }

    public function updateUsername(){

        $registered_user = new RegisteredUser();
        $_SESSION["user"]["uid"]='REG0000022';
        $uid=$_SESSION["user"]["uid"];
        $registered_user->changeUsername($uid,$_POST['username']);
        Controller::redirect("/RegisteredUser/view");
        
    }

    public function updateContactNumber(){

        $validate = new Validation();
        $registered_user = new RegisteredUser();
        $_SESSION["user"]["uid"]='REG0000022';
        $uid=$_SESSION["user"]["uid"];
        $data = [ "contact_number"=> $_POST['contact_number']];
        if (!$validate->telephone($_POST["contact_number"])){
            $error["telephoneerr"] = "+94XXXXXXXXX";
        }   
        if(isset($error)) {

            View::render('profile',$error);
        }          
            
        else
            
            $registered_user->changeContactNumber($uid,$data);
            Controller::redirect("/RegisteredUser/view");
        
    }
    public function updateEmail(){

        $registered_user = new RegisteredUser();
        $user = new User();
        $validate =new Validation();
        $_SESSION["user"]["uid"]='REG0000022';
        $uid=$_SESSION["user"]["uid"];
        $data = ["email"=>$_POST['email']];
        if(!$validate->email($_POST["email"])){
            $error["invaliderr"] = "Invalid email";
        }
        elseif($user->checkUserEmail($_POST["email"])) {
            $error["emailErr"] = "Email already taken";
        }
        else
            $registered_user->changeEmail($uid,$data);
            Controller::redirect("/RegisteredUser/view");
        
    }
    public function updatePassword(){
        $registered_user = new RegisteredUser();
        $user = new User();
        $validate =new Validation();
        $_SESSION["user"]["uid"]='REG0000022';
        $uid=$_SESSION["user"]["uid"];
        $data = ["uid"=>$_POST['uid'],"password"=>$_POST['password']];
        if(!$user->checkCurrentPassword($uid,$_POST['current_password'])){
            $error1=["currentpassworderr"=>"Password does not matched"];
            Controller::redirect("/RegisteredUser/view", $error1);
        }
        if(!$validate->password($_POST["new_password"])) {
            $error2 = ["newpassworderr"=>"Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols"];
            Controller::redirect("/RegisteredUser/view",$error2);
        }
        else{
            $registered_user->changePassword($uid,$data);
            Controller::redirect("/RegisteredUser/view");

        }
            

        
    }
    function checkPassword(){
        $_SESSION["user"]["uid"]='REG0000022';
        $uid=$_SESSION["user"]["uid"];
        echo json_encode(array("taken"=>(new User)->checkCurrentPassword($uid,$_POST["current_password"])));
    }
    public function activityLog(){

        View::render('history');
    }



   
}


