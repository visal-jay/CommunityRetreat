<?php

class SearchController {

    function view() {
        
        View::render("searchPage");
    }

    public function searchAll(){
        foreach ($_POST as $key => $value){
            if($_POST[$key]=="")
                unset ($_POST[$key]);
        }
        $event_model= new Events;
        $events=$event_model->query($_POST);

        $event_details=array();
        if($events!=false)
            foreach($events as $event)
                array_push($event_details,$event_model->getDetails($event["event_id"]));

        echo json_encode($event_details);
    }

}