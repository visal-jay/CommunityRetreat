<?php

class SearchController {

    function view() {
        
        View::render("searchPage");
    }

    public function searchAll(){
        foreach ($_POST as $key => $value){
            $_POST[$key]=trim($_POST[$key]);
            if($_POST[$key]=="")
                unset ($_POST[$key]);
        }
        
        $event_model= new Events;
        $events=$event_model->query($_POST);
        //var_dump($events);

        $event_details=array();
        if($events!=false)
            foreach($events as $event){
                /* var_dump($event_model->getDetails($event["event_id"]));
                echo "<br>";
                var_dump($event);
                break; */
                $details=(array_merge($event_model->getDetails($event["event_id"]),$event));
                array_push($event_details,$details);
                
                }
                //var_dump($event_details);

        echo json_encode($event_details,JSON_INVALID_UTF8_IGNORE);
    }

}