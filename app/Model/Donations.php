<?php

class Donations extends Model{

    public function getReport($data){
        $query="SELECT SUM(amount) as donation_sum ,date_format(time_stamp,'%x-%m-%d') as day FROM donation WHERE event_id = :event_id GROUP BY day ORDER BY day ASC";
        $params=["event_id"=>$data["event_id"]];
        $result=Model::select($query,$params);

        if (count($result)==0)
            return false;
        else
            return $result;
    }

    public function getDonateDetails($event_id){//get donation details from backend to UI
        $query = 'SELECT donation.amount, date(time_stamp) as date, registered_user.username FROM donation LEFT JOIN registered_user ON donation.uid=registered_user.uid WHERE event_id =:event_id'; 
        $params = ["event_id" => $event_id];
        $result=Model::select($query,$params);
       return $result;
    }

    public function disableDonation($event_id){//disable donations for an event
        $query = 'UPDATE event SET donation_status=0 WHERE event_id =:event_id';
        $params = ["event_id" => $event_id];
        Model::insert($query,$params);
        
    }

    public function enableDonation($event_id){//enable donations for an event
        $query = 'UPDATE event SET donation_status=1 WHERE event_id =:event_id';
        $params = ["event_id" => $event_id];
        Model::insert($query,$params);
        
    }

    public function updateDonationCapacity($event_id, $donation_capacity){//give a donation capacity for an event from the UI to store in backend
        $query = 'UPDATE event SET donation_capacity=:donation_capacity WHERE event_id =:event_id';
        $params = ["event_id" => $event_id, "donation_capacity" => $donation_capacity];
        Model::insert($query,$params);
    }
}