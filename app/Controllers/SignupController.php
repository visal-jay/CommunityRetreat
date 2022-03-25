<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Defuse\Crypto\Key;



require_once('./Libararies/defuse-crypto.phar');

class SignupController
{
    function validate()
    {
        $validate = new Validation();
        $organisation = new Organisation();
        $registered_user = new RegisteredUser();
        $user= new User();

        //validate if this ia valid email
        if (!$validate->email($_POST["email"])) { 
            $data["emailErr"] = "Invalid email";
        }

        //validate email is taken
        if ($user->checkUserEmail($_POST["email"])) {
            $data["emailErr"] = "Email already taken";
        }

        //check password constraints
        if (!$validate->password($_POST["password"])) {
            $data["passwordErr"] = "Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols";
        }

        //if there are any errors redirect to login page
        if (isset($data["emailErr"]) or isset($data["passwordErr"])) {
            $data["signup"] = true;
            if (isset($_POST["signupUser"]))
                $data["signupUser"] = true;
            elseif (isset($_POST["signupOrg"]))
                $data["signupOrg"] = true;
            Controller::redirect("/Login/view", $data);
        }

        //add a organzation
        if (isset($_POST["signupOrg"])) {
            $organisation->addOrganisation($_POST);
        }

        //add a user
        elseif(isset($_POST["signupUser"])){
            $registered_user->addRegisteredUser($_POST);
        }

        Controller::redirect("/Login/view",["signup_mail"=>true,"mail"=>true]);
    }

    //email verification
    function verifyEmail()
    {
        if(!isset($_GET["key"]))    //if key is not present it's a invalid request
            Controller::redirect("/Login/view");
        $key = $_GET["key"];
        $encyption = new Encryption;
        $data = $encyption->decrypt($key, 'email verificaition');   //decrypt the key
        $user = new User;
        $time = (int)shell_exec("date '+%s'");  //get current time
        $user_details=$user->authenticateWithMails($data["email"], $data["password"],0);    //authenticate if he email is for a user waiting to be verficiation
        //check if the email verification is not expired
        if($data["time"]>$time-86400 && $user_details) {
            $user->setVerification($user_details["uid"]); //verify user
            $user_details["username"]=$user->getUsername($user_details["uid"]); //get username
            $_SESSION["user"] = array_intersect_key($user_details, ["uid" => '', "user_type" => '',"username"=>'']);    //set session
        }
         Controller::redirect("/Login/view");
    }

    //check email is taken
    function checkEmailAvailable(){
        if((new Validation)->email($_POST["email"]));
        echo json_encode(array("taken"=>(new User)->checkUserEmail($_POST["email"])));
    }
}
