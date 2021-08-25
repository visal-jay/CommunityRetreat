<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Defuse\Crypto\Key;

require './Libararies/PHPMailer-6.5.0/src/Exception.php';
require './Libararies/PHPMailer-6.5.0/src/PHPMailer.php';
require './Libararies/PHPMailer-6.5.0/src/SMTP.php';

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
            Controller::redirect("/login/view", $data);
        }

        if (isset($_POST["signupOrg"])) {
            $_POST["username"] = "hello";
            $_POST["contact_number"] = "123";
            $_POST["account_number"] = "123";
            $_POST["username"] = "hello";
            $_POST["first_failed_login"]=time();
            $organisation->addOrganisation($_POST);
        }
    }

    function verifyEmail()
    {
        if(!isset($_GET["key"]))
            Controller::redirect('/login/view');
        $key = $_GET["key"];
        $encyption = new Encryption;
        $data = $encyption->decrypt($key, 'email verificaition');
        $user = new User;
        if ($user_details=$user->authenticate($data["email"], $data["password"],0)) {
           $user->setVerification($user_details["uid"]);
        } 
        else
            Controller::redirect('/login/view');
        LoginController::validate($data["email"],$data["password"]);
    }

    function checkEmailAvailable(){
        echo json_encode(array("taken"=>(new User)->checkUserEmail($_POST["email"])));
    }
}
