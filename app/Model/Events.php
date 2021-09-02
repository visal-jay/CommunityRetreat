<?php

class Events extends Model
{
    public function addEvent($data)
    {
        session_start();
        $data["org_uid"] = $_SESSION["user"]["uid"];
        if ($data["longitude"] == "NULL" || $data["latitude"] == "NULL") 
            $data["map"] = "false";
        else
            $data["map"] = "true";
       
        $query = "INSERT INTO `event` (`event_name`, `org_uid`, `latlang`, `start_date`,`start_time`,`end_time`, `about`,`mode`) VALUES (:event_name,  :org_uid, IF (STRCMP(:map, 'false')=0 ,NULL,POINT(:latitude ,:longitude)),:start_date,:start_time, :end_time , :about ,:mode)";
        $params = array_intersect_key($data, ["event_name" => '', "org_uid" => '', "latitude" => '', "longitude" => '', "start_date" => '', "start_time" => '',"end_time"=>'', "about" => '', "mode" => '', "map" => '']);
            
        var_dump($data);

        Model::insert($query, $params);
        
    }

    public function remove($event_id){
        $query="UPDATE `event` SET status='deleted' WHERE event_id= :event_id";
        $params=["event_id"=>$event_id];
        Model::insert($query,$params);
    }

    public function getDetails($event_id)
    {
        $query = 'SELECT `event_id`, `event_name`, `org_uid`,`organisation_username`, ST_X(`latlang`) as latitude, ST_Y(`latlang`) as longitude, `start_date`, `start_time`, `end_time`, `about`, `mode`, `volunteer_capacity`, `donation_capacity`, `cover_photo`, `donation_status`, `volunteer_status`, `donations`, `volunteered`, `status`, TIMEDIFF(end_time, start_time) as duration  FROM event_details where event_id=:event_id ';
        $params = ["event_id" => $event_id];
        $result = Model::select($query, $params);
      
        if(count($result[0])>=1)
            return $result[0];
        else
            return false;
    }

    public function updateDetails($data)
    {
        $old_data = $this->getDetails($data["event_id"]);
        var_dump($old_data);
        $new_data = array_merge($old_data, $data);
        $params= array_intersect_key($new_data, ['event_id'=>"", 'event_name'=>"", 'start_date'=>"", 'start_time'=>"",'end_time'=>"", 'about'=>"", 'mode'=>""]);
        $query = "UPDATE event SET `event_name` = :event_name, `start_date` = :start_date, `start_time`= :start_time, `end_time`= :end_time, `mode` = :mode, `about`=:about WHERE `event_id`=:event_id ";
        Model::insert($query,$params);
    }


    public function query($args)
    {
        $name=$city = $latitude = $longitude = $mode = $start_date = $org_uid = $distance = $order_type = $way = $status = $limit= NULL;
        extract($args, EXTR_OVERWRITE);
        //var_dump($args);
        $params=array();
        
        if ($city != NULL) {
            $city = trim($city);
            $city = str_replace(" ", "+", $city);
            $result = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $city . ",LK&key=AIzaSyAN2HxM42eIrEG1e5b9ar2H_2_V6bMRjWk"), true)["results"][0]["geometry"]["location"];
            $longitude = $result["lng"];
            $latitude = $result["lat"];

        }
        //$query='SELECT event_id, ( 6371 * acos( cos( radians(6.848) ) * cos( radians( ST_X(latlang) ) ) * cos( radians( ST_Y(latlang) ) - radians(80.005) ) + sin( radians(6.848) ) * sin( radians( ST_X(latlang) ) ) ) ) AS distance FROM event';
        $query_select_primary = "SELECT * ";
        $query_select_secondary = ', ( 6371 * acos( cos( radians(:latitude) ) * cos( radians( ST_X(latlang) ) ) * cos( radians( ST_Y(latlang) ) - radians(:longitude) ) + sin( radians(:latitude2) ) * sin( radians( ST_X(latlang) ) ) ) ) AS distance ';
        $query_table = 'FROM event_details WHERE ';
        $query_filter_event_mode = ' mode=:mode AND ';
        $query_filter_date = ' start_date= :start_date AND ';
        $query_filter_organzation = ' org_uid =:org_uid AND ';
        $query_filter_status = ' status =:status AND ';
        $query_filter_name=' event_name LIKE :name AND';
        $query_filter_last = ' 1=1 ';
        $query_filter_distance= ' distance=distance AND ';
        $query_filter_near = ' distance <= :distance AND ';
        $query_filter_limit = ' LIMIT :limit ';

        $query = $query_select_primary;

        if ($longitude != NULL && $latitude != NULL) {
            $query = $query . $query_select_secondary . $query_table;
            $params["latitude"] = $latitude;
            $params["longitude"] = $longitude;
            $params["latitude2"] = $latitude;
            if ($distance == NULL && $city!=NULL)
                $distance = 10;
            //$query=$query . " distance =distance AND ";
        } else
            $query = $query . $query_table;

        if ($mode != NULL) {
            $query = $query . $query_filter_event_mode;
            $params["mode"] = $mode;
        }
        

        if ($start_date != NULL) {
            $query = $query . $query_filter_date;
            $params["start_date"] = $start_date;
        }

        if ($name!=NULL){
            $query = $query .$query_filter_name;
            $params["name"]="%$name%";
        }

        if ($org_uid != NULL) {
            $query = $query . $query_filter_organzation;
            $params["org_uid"] = $org_uid;
        }

        if ($status != NULL) {
            $query = $query . $query_filter_status;
            $params["status"] = $status;
        }

        if($order_type=='volunteer_percent')
            $query=$query . ' volunteer_percent=volunteer_percent AND ';

        if($order_type=='dotaion_percent')
            $query=$query . ' dotaion_percent=dotaion_percent AND ';

        $query = $query . $query_filter_last ." HAVING ";

        if ($longitude != NULL && $latitude != NULL && $order_type=="distance") {
            $query = $query . $query_filter_distance;
        }

        if ($longitude != NULL && $latitude != NULL && $distance != NULL) {
            $query = $query . $query_filter_near;
            $params["distance"] = $distance;
        }

        $query = $query . $query_filter_last;
        

        if ($order_type != NULL) {
            if ($order_type=="distance")
                {
                    $params["longitude"]=$longitude;
                    $params["latitude"]=$latitude;
                }
            $query = $query ." ORDER BY " . $order_type;
            if ($way == NULL)
                $way = 'DESC';
            $query = $query . " " . $way;
        }

        if($limit != NULL){
            $query=$query . $query_filter_limit;
            $params["limit"]=$limit;
        }

       /*  var_dump($query);
        var_dump($params); */
        $result = Model::select($query, $params);
        
   
        if(count($result)==0)
            return false;
        return $result;
    }
}
