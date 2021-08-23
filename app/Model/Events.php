<?php
class Events extends Model{
    public function addEvent($data){
        session_start();
        $data["org_uid"]=$_SESSION["user"]["uid"];
        var_dump($data);
        if($data["longitude"]=="NULL" || $data["latitude"]=="NULL"){
            $query = 'INSERT INTO event (`event_name`, `org_uid`, `start_date`,`start_time`, `about`,`mode`) VALUES (:event_name,  :org_uid, :start_date,:start_time, :about, :mode)';
            $params=array_intersect_key($data,["event_name"=>'',"org_uid"=>'',"start_date"=>'',"start_time"=>'',"about"=>'',"mode"=>'']);
            var_dump($params);
        }
        else{
            $query = 'INSERT INTO `event` (`event_name`, `org_uid`, `latlang`, `start_date`,`start_time`, `about`,`mode`) VALUES (:event_name,  :org_uid, POINT(:latitude ,:longitude),:start_date,:start_time , :about ,:mode)';
            $params=array_intersect_key($data,["event_name"=>'',"org_uid"=>'',"latitude"=>'',"longitude"=>'',"start_date"=>'',"start_time"=>'',"about"=>'',"mode"=>'']);
        }   

        Model::insert($query,$params);     
    }

    public function getDetails($event_id){
        $query = 'SELECT event_name as event  FROM event where event_id=:event_id ';
        $params = ["event_id" => $event_id];
        $result=Model::select($query,$params);
        var_dump($result);
        exit();
    }

    public function updateDetails($data){
        $old_data=$this->getDetails($data["event_id"]);
        //Mode::insert($query,$params);
    }
}