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
        $validate=new Validation();
        $organisation=new Organisation();
        
        if (!$validate->email($_POST["email"])) {
            $data["emailErr"]="Invalid email";
        }
        elseif (isset($_POST["signupOrg"]) AND $organisation->checkUserEmail($_POST["email"])){
            $data["emailErr"]="Email already taken";
        }
        elseif (!$validate->password($_POST["password"]))
        {
            $data["passwordErr"]="Invalid password";
        }
        if (isset($data["emailErr"]) OR isset($data["passwordErr"])){
            $data["signup"]=true;
            if(isset($_POST["signupUser"]))  
                $data["signupUser"]=true;
            elseif (isset($_POST["signupOrg"])) 
                $data["signupOrg"]=true;
            
            Controller::redirect("/login/view",$data);
        }
        echo "shit";
        $_POST["username"]="hello";
        $_POST["contact_number"]="123";
        $_POST["account_number"]="123";
        $_POST["username"]="hello";

        if (isset($_POST["signupOrg"]))
            $organisation->addOrganisation($_POST);
    }

    function verifyEmail(){
        $key=$_GET["key"];
        $encyption=new Encryption;
        $data=$encyption->decrypt($key,'email verificaition');
        $organisation=new Organisation;
        if($organisation->authenticate($data["email"],$data["password"])){
            Controller::redirect("/view/organisationDashboard.php");
        }
        else
            Controller::redirect("login/view");
    }
}
