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

    public function updateProfile(){
        var_dump("hello");
        $registered_user = new RegisteredUser();
        $validate = new Validation();
        $user = new User();
        $_SESSION["user"]["uid"]='REG0000022';
        $uid=$_SESSION["user"]["uid"];
        if(!$validate->telephone($_POST["contact_number"]))
            $error=["telephoneerr"=>"Invalid telephone number","error"=>true];
        if ($user->checkUserEmail($_POST["email"])) {
            $data["emailErr"] = "Email already taken";
        }
        if(!$validate->password($_POST["password"]))
            $error=["passworderr"=>"Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols","error"=>true];
        if(isset($error))
            Controller::redirect("/RegisteredUser/view",$error);
        $registered_user->update($uid,$_POST);
        
        Controller::redirect("/RegisteredUser/view");
        
    }

   
}


