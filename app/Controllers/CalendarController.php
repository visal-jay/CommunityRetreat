<?php 

    class CalendarController{

        public function view(){
         
            View::render("calender");
            
        }
        public function  getCalendarDetails(){

            $calendar = new Calendar();
            $uid=$_SESSION["user"]["uid"];
            $calendar_details = $calendar->getCalendarDetails($uid);
            echo json_encode($calendar_details);
        }
        

    }