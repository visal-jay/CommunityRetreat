<?php 

class Volunteer extends Model{
    public function getVolunteerDetails($event_id){//get volunteer details from backend to UI
        $query = "SELECT registered_user.username, registered_user.contact_number, registered_user.email, volunteer.participate,  date_format(volunteer.date,'%x-%m-%d') as date FROM volunteer LEFT JOIN registered_user ON volunteer.uid=registered_user.uid WHERE event_id =:event_id"; 
        $params = ["event_id" => $event_id];
        $result=Model::select($query,$params);
       return $result;
    }

    public function disableVolunteer($event_id){//disable volunteers for an event
        $query = 'UPDATE event SET volunteer_status=0 WHERE event_id =:event_id';
        $params = ["event_id" => $event_id];
        Model::insert($query,$params);
    }

    public function enableVolunteer($event_id){//enable volunteers for an event
        $query = 'UPDATE event SET volunteer_status=1 WHERE event_id =:event_id';
        $params = ["event_id" => $event_id];
        Model::insert($query,$params);
    }

    public function updateVolunteerCapacity($event_id, $volunteer_capacity){//give a volunteer capacity for an event from the UI to store in backend
        $query = 'UPDATE event SET volunteer_capacity=:volunteer_capacity WHERE event_id =:event_id';
        $params = ["event_id" => $event_id, "volunteer_capacity" => $volunteer_capacity];
        Model::insert($query,$params);
    }

    public function getVolunteerSum($event_id){
        $query= 'SELECT COUNT(*) as volunteer_sum FROM volunteer WHERE event_id =:event_id';
        $params = ["event_id" => $event_id];
        $result=Model::select($query,$params);
        $result = ($result[0]["volunteer_sum"]==NULL)?0 : $result[0]["volunteer_sum"];
       return $result; 
    }


    public function addVolunteerDetails($event_id,$volunteer_dates){

        foreach($volunteer_dates as $volunteer_date){
            
            $query ='INSERT INTO `volunteer`(`uid`,`event_id`,`volunteer_date`) VALUES (:uid,:event_id,:volunteer_date)';
            $params = ['uid' => $_SESSION['user']['uid'] , 'event_id' => $event_id , 'volunteer_date' => $volunteer_date ];
            Model::insert($query,$params);
        }

    }
    
    public function getReport($data){
        $query="SELECT COUNT(event_id) as volunteer_sum ,date_format(date,'%x-%m-%d') as day FROM volunteer WHERE event_id = :event_id GROUP BY day ORDER BY day ASC";
        $params=["event_id"=>$data["event_id"]];
        $result=Model::select($query,$params);

        if (count($result)==0)
            return false;
        else
            return $result;

    }
}