<?php
    class Calendar extends Model{

        public function getCalendarDetails($uid){
            $event_details =[];
            $params =["uid"=>"$uid"];
            $query = "SELECT event_id FROM calender WHERE uid = :uid";
            $result = Model::select($query,$params);
            $event_details = array();
            for($i=0;$i<count($result);$i++) {

                $event_params = ["event_id" =>  $result[$i]['event_id']];
                $get_event_query = 'SELECT event_id, event_name,organisation_username ,MONTH(start_date) AS month, DAY(start_date) AS day FROM event_details where event_id=:event_id AND status= "published" ';
                $event_result = Model::select($get_event_query,  $event_params);
                array_push($event_details,$event_result);
            }
            
  
                return $event_details;


        }
       
    }