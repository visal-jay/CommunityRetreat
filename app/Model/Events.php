<?php

use Stripe\Event;

class Events extends Model
{
    //add new event 
    public function addEvent($data)
    {
        $db = Model::getDB();
        $db->beginTransaction();

        $data["org_uid"] = $_SESSION["user"]["uid"];
        if ($data["longitude"] == "NULL" || $data["latitude"] == "NULL")
            $data["map"] = "false";
        else
            $data["map"] = "true";

        $query = "INSERT INTO `event` (`event_name`, `org_uid`, `latlang`, `start_date`,`end_date`,`start_time`,`end_time`, `about`,`mode`) VALUES (:event_name,  :org_uid, IF (STRCMP(:map, 'false')=0 ,NULL,POINT(:latitude ,:longitude)),:start_date,:end_date,:start_time, :end_time , :about ,:mode)";
        $params = array_intersect_key($data, ["event_name" => '', "org_uid" => '', "latitude" => '', "longitude" => '', "start_date" => '', "end_date" => '', "start_time" => '', "end_time" => '', "about" => '', "mode" => '', "map" => '']);
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $stmt->closeCursor();
        $select_query = "SELECT MAX(event_id) FROM event";
        $stmt = $db->prepare($select_query);
        $stmt->execute([]);
        $event_id = $stmt->fetchColumn();
        $stmt->closeCursor();
        $db->commit();
        $this->insertVolunteerCapacities($event_id,$params['start_date'],$params['end_date']);

    }

    //remove an exsiting event
    public function remove($event_id)
    {
        $query = "UPDATE `event` SET status='deleted' WHERE event_id = :event_id";
        $params = ["event_id" => $event_id];
        Model::insert($query, $params);
    }

    //calling data from backend 
    public function getDetails($event_id)
    {
        $query = 'SELECT `event_id`, `event_name`, `org_uid`,`organisation_username`, ST_X(`latlang`) as latitude, ST_Y(`latlang`) as longitude, `start_date`,`end_date`, `start_time`, `end_time`, `about`, `mode`, `volunteer_capacity`, `donation_capacity`, `cover_photo`, `donation_status`, `volunteer_status`, `donations`, `volunteered`, `status`, volunteer_percent, donation_percent, TIMEDIFF(end_time, start_time) as duration  FROM event_details where event_id=:event_id ';
        $params = ["event_id" => $event_id];
        $result = Model::select($query, $params);

        if (count($result) >= 1)
            return $result[0];
        else
            return false;
    }

    //update details of an already exsting event
    public function updateDetails($data)
    {
        //...
        $db = Model::getDB();
        $db->beginTransaction();

        $params = array();
        if ($_FILES["cover-photo"]["size"][0] != NULL) {
            $time = (int)shell_exec("date '+%s'");
            exec("rm -rf /Users/visaljayathilaka/code/group-project/Group-16/app/Uploads/event/cover" . $data["event_id"] . "*");
            $cover_pic = new Image($data["event_id"] . $time, "event/cover/", "cover-photo", true);
            $params["cover_photo"] = $cover_pic->getURL();
        }

        //updating date, start time, duration, mode, description, event name, location, cover photo & status???    
        $old_data = $this->getDetails($data["event_id"]);
        $new_data = array_merge($old_data, $data);

        if (isset($new_data["longitude"]) || isset($new_data["latitude"]))
            $new_data["map"] = "true";
        else
            $new_data["map"] = "false";

        $update_data = array_intersect_key($new_data, ['event_id' => "", 'start_date' => "", 'end_date' => "", 'start_time' => "", 'end_time' => "", 'mode' => "", 'about' => "", 'event_name' => "", 'longitude' => "", 'latitude' => "", 'map' => '', 'cover_photo' => "", 'status' => ""]);
        $params = array_merge($update_data, $params);
        $volunteer = new Volunteer();
        $volunteer->removeVolunteerCapacity($params["event_id"], $params["start_date"], $params["end_date"]);
        $query = "UPDATE event SET `start_date` = :start_date, `end_date` = :end_date, `start_time`= :start_time, `end_time`= :end_time, `mode` = :mode, `about`=:about,`cover_photo` = :cover_photo, `status` = :status, `latlang`= IF (STRCMP(:map, 'false')=0 ,NULL,POINT(:latitude ,:longitude)) , `event_name` =:event_name WHERE `event_id`=:event_id ";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $db->commit();
        $this->insertVolunteerCapacities($params["event_id"], $params["start_date"], $params["end_date"]);
    }



    public function query($args)
    {
        $name = $city = $latitude = $longitude = $mode = $start_date = $org_uid = $distance = $order_type = $way = $status =$not_status= $limit= $offset = $donation_capacity = $volunteer_capacity = $volunteer_status = $donation_status=$is_virtual = NULL;
        extract($args, EXTR_OVERWRITE);
        $params = array();

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
        $query_filter_name = ' event_name LIKE :name AND';
        $query_filter_volunteer_status = ' volunteer_status = :volunteer_status AND';
        $query_filter_donation_status = ' donation_status = :donation_status AND';
        $query_filter_volunteer_capacity = ' volunteer_capacity IS NOT NULL AND';
        $query_filter_donation_capacity = ' donation_capacity IS NOT NULL AND';
        $query_filter_last = ' 1=1 ';
        $query_filter_distance = ' distance=distance AND ';
        $query_filter_near = ' distance <= :distance AND ';
        $query_filter_limit = ' LIMIT :offset , :limit ';
        $query_is_virtual = ' is_virtual = :is_virtual AND ';

        $query = $query_select_primary;

        if ($longitude != NULL && $latitude != NULL) {
            $query = $query . $query_select_secondary . $query_table;
            $params["latitude"] = $latitude;
            $params["longitude"] = $longitude;
            $params["latitude2"] = $latitude;
        } else
            $query = $query . $query_table;

        if ($mode != NULL) {
            $query = $query . $query_filter_event_mode;
            $params["mode"] = $mode;
        }


        if ($start_date != NULL) {
            $date_query = "(";
            $dates = explode(",", $start_date);
            for ($i = 0; $i < count($dates); $i++) {
                $date_query = $date_query . " :date$i BETWEEN start_date AND end_date ";
                if ($i + 1 < count($dates))
                    $date_query = $date_query . " OR ";
                $params["date$i"] = $dates[$i];
            }
            $date_query = $date_query . " ) AND ";
            $query = $query . $date_query;

            /* $query = $query . $query_filter_date;
            $params["start_date"] = $start_date; */
        }

        if ($name != NULL) {
            $query = $query . $query_filter_name;
            $params["name"] = "%$name%";
        }

        if ($volunteer_status != NULL) {
            $query = $query . $query_filter_volunteer_status;
            $params["volunteer_status"] = $volunteer_status;
        }

        if ($donation_status != NULL) {
            $query = $query . $query_filter_donation_status;
            $params["donation_status"] = $donation_status;
        }


        if ($volunteer_capacity != NULL) {
            $query = $query . $query_filter_volunteer_capacity;
        }

        if ($donation_capacity != NULL) {
            $query = $query . $query_filter_donation_capacity;
        }

        if($is_virtual != NULL){
            $query = $query . $query_is_virtual;
            $params["is_virtual"]=$is_virtual;
        }

        if ($org_uid != NULL) {
            $query = $query . $query_filter_organzation;
            $params["org_uid"] = $org_uid;
        }

        if ($status != NULL) {
            if ($not_status!=NULL)
                $query=$query. " NOT ";
            $query = $query . $query_filter_status;
            $params["status"] = $status;
        }

/*         if ($order_type == 'volunteer_percent')
            $query = $query . ' volunteer_percent=volunteer_percent AND ';

        if ($order_type == 'donation_percent')
            $query = $query . ' donation_percent=donation_percent AND '; */

        $query = $query . $query_filter_last . " HAVING ";

        /* if ($longitude != NULL && $latitude != NULL && $order_type == "distance") {
            $query = $query . $query_filter_distance;
        } */

        if ($longitude != NULL && $latitude != NULL && $distance != NULL) {
            $query = $query . $query_filter_near;
            $params["distance"] = $distance;
        }

        $query = $query . $query_filter_last;


        if ($order_type != NULL) {
            if ($order_type == "distance") {
                $params["longitude"] = $longitude;
                $params["latitude"] = $latitude;
            }
            $query = $query . " ORDER BY " . $order_type;

            if ($way == NULL)
                $way = 'DESC';
            $query = $query . " " . $way;
        }

        if ($limit != NULL && $offset!=NULL) {
            $query = $query . $query_filter_limit;
            $params["limit"] = $limit;
            $params["offset"] =$offset;
        }

        /* var_dump($query);
        var_dump($params); */
        $result = Model::select($query, $params);

        if (count($result) == 0)
            return false;
        return $result;
    }

    public function insertVolunteerCapacities($event_id,$start_date,$end_date){

        $startDate = new DateTime($start_date);
        $interval = new DateInterval('P1D');
        $realEnd = new DateTime($end_date);
        $realEnd->add($interval);
    
    
        $period = new DatePeriod($startDate, $interval, $realEnd);
    
        foreach ($period as $date) {
            $event_date = $date->format('Y-m-d');
            $capacity_query = "INSERT IGNORE INTO `volunteer_capacity`(`event_id`,`event_date`,`capacity`) VALUES (:event_id,:event_date,0)";
            $capacity_params = ["event_id" =>$event_id, "event_date" =>  $event_date];
            var_dump($event_date);
            Model::insert($capacity_query,$capacity_params);
        }
    
    }

    /*public function endEvents($event_id, $end_date, $status)
    {
        if($end_date < date("Y-m-d") && $status= 'published'){
            $query = "UPDATE event INTO `volunteer_capacity`(`event_id`,`event_date`,`capacity`) VALUES (:event_id,:event_date,0)";
            $params = ["event_id" =>$event_id, "event_date" =>  $event_date];
            Model::insert($query,$params);
        }   
    }    */

    public function endEvents($event_id)
    {
        $query = "UPDATE event SET status ='ended', volunteer_status=0, donation_status=0 WHERE event_id = :event_id";
        $params = ["event_id" => $event_id];
        Model::insert($query, $params);
    }

    public function getEndedEvents()
    {
        $query = "SELECT event_id FROM event WHERE status='published' AND end_date < cast((now()) as date)";
        $params = [];
        $result = Model::select($query, $params);
        return $result;
    }

    public function getDetailsofNearEvents()
    {
        $query = 'SELECT  DISTINCT event_id,volunteer_date FROM `volunteer` WHERE volunteer_date = CURDATE() + INTERVAL 7 DAY OR volunteer_date = CURDATE() + INTERVAL 3 DAY ';
        $result = Model::select($query,[]);
        return $result;
    }
}



