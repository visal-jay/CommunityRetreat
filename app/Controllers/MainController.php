<?php

class MainController
{
    public function index()
    {
        Controller::redirect("/User/home");
    }

    public function aboutUs()
    {
        $user_roles = Controller::accessCheck(["organization","registered_user","guest_user"]);
        View::render("aboutUs",$user_roles);
    }
}
