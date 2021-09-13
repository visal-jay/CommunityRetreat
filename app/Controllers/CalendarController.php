<?php 

    class CalendarController{

        public function view(){
         
            View::render("calender");
            
        }
        public function  getCalendarDetails(){

            $calendar = new Calendar();
            $_SESSION["user"]["uid"]='REG0000032';
            $uid=$_SESSION["user"]["uid"];
            if(!isset($_SESSION)){
                session_start();
            }
            $calendar_details = $calendar->getCalendarDetails($uid);
            echo json_encode($calendar_details);
        }
        

    }