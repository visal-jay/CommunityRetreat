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

        if (!$validate->email($_POST["email"])) {
            $data["emailErr"] = "Invalid email";
        }

        if ($user->checkUserEmail($_POST["email"])) {
            $data["emailErr"] = "Email already taken";
        }

        if (!$validate->password($_POST["password"])) {
            $data["passwordErr"] = "Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols";
        }

        
        if (isset($data["emailErr"]) or isset($data["passwordErr"])) {
            $data["signup"] = true;
            if (isset($_POST["signupUser"]))
                $data["signupUser"] = true;
            elseif (isset($_POST["signupOrg"]))
                $data["signupOrg"] = true;
            Controller::redirect("/Login/view", $data);
        }

        if (isset($_POST["signupOrg"])) {
            $organisation->addOrganisation($_POST);
        }

        elseif(isset($_POST["signupUser"])){
            $registered_user->addRegisteredUser($_POST);
        }

        Controller::redirect("/Login/view",["signup_mail"=>true,"mail"=>true]);
    }

    function verifyEmail()
    {
        if(!isset($_GET["key"]))
            Controller::redirect("/Login/view");
        $key = $_GET["key"];
        $encyption = new Encryption;
        $data = $encyption->decrypt($key, 'email verificaition');
        $user = new User;
        $time = (int)shell_exec("date '+%s'");
        $user_details=$user->authenticateWithMails($data["email"], $data["password"],0);
        if($data["time"]>$time-86400 && $user_details) {
            $user->setVerification($user_details["uid"]);
            $user_details["username"]=$user->getUsername($user_details["uid"]);
            $_SESSION["user"] = array_intersect_key($user_details, ["uid" => '', "user_type" => '',"username"=>'']);
        }
         Controller::redirect("/Login/view");
    }

    function checkEmailAvailable(){
        if((new Validation)->email($_POST["email"]));
        echo json_encode(array("taken"=>(new User)->checkUserEmail($_POST["email"])));
    }
}
