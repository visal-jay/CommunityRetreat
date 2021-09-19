<?php

class UserController{
    public function home(){
        $user_roles=Controller::accessCheck(["registered_user","guest_user"]);
        View::render("home",[],$user_roles);
    }

    public function calendar(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render("calender",[],$user_roles);
    }

    public function administratored(){
        $user_roles=Controller::accessCheck(["registered_user"]);
        View::render("adminstration",[],$user_roles);
    }

    public function profile(){
        (new RegisteredUserController)->view();
    }
}