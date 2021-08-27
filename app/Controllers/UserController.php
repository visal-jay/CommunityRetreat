<?php

class UserController{
    public function home(){
        View::render("home");
    }

    public function calendar(){
        View::render("calender");
    }

    public function administratored(){
        View::render("adminstration");
    }

    public function profile(){
        (new RegisteredUserController)->view();
    }
}