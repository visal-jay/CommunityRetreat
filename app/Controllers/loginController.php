<?php
class LoginController
{

    function view()
    {

        $data = [
            'login' => true,
            'signupUser' => true,
            'passwordErr'=>"",
            'emailErr'=>""
        ];
        session_start();
        if ($_SESSION["data"]!=null)
            $data = $_SESSION["data"];
        View::render("login", $data);
        
    }
}
