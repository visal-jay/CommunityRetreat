<?php
class SignupController
{

    function validate()
    {
        $email = $_POST["username"];
        $password =$_POST["password"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data = [
                "emailErr" => "Invalid email",
                "signup" => true,
                "signupUser" => true
            ];
        }
        else if (!preg_match('^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',$password))
        {
            $data = [
                "passwordErr" => "Password must contain lowercase,uppercase,number and of at least length 8",
                "signup" => true,
                "signupUser" => true
            ];
        }
      
        session_start();
        $_SESSION["data"]=$data;
        header("Location:/login/view");
    }
}
