<?php

class Donations extends Model{

    
    public function getReport($data){/*get the donation sum and date and send it to the graph in view file*/
        $query="SELECT SUM(amount) as donation_sum ,date_format(time_stamp,'%x-%m-%d') as day FROM donation WHERE event_id = :event_id GROUP BY day ORDER BY day ASC";
        $params=["event_id"=>$data["event_id"]];
        $result=Model::select($query,$params);

        if (count($result)==0)
            return false;
        else
            return $result;
    }

    public function getDonateDetails($event_id){/*get donation details from backend to UI*/
        $query = 'SELECT donation.amount, date(time_stamp) as date, registered_user.username FROM donation LEFT JOIN registered_user ON donation.uid=registered_user.uid WHERE event_id =:event_id'; 
        $params = ["event_id" => $event_id];
        $result=Model::select($query,$params);
       return $result;
       
    }

    public function disableDonation($event_id){/*disable donations for an event*/
        $query = 'UPDATE event SET donation_status=0 WHERE event_id =:event_id';
        $params = ["event_id" => $event_id];
        Model::insert($query,$params);
        
    }

    public function enableDonation($event_id){/*enable donations for an event*/
        $query = 'UPDATE event SET donation_status=1 WHERE event_id =:event_id';
        $params = ["event_id" => $event_id];
        Model::insert($query,$params);
        
    }

    public function updateDonationCapacity($event_id, $donation_capacity){/*give a donation capacity for an event from the UI to store in backend*/
        $query = 'UPDATE event SET donation_capacity=:donation_capacity WHERE event_id =:event_id';
        $params = ["event_id" => $event_id, "donation_capacity" => $donation_capacity];
        Model::insert($query,$params);
    }

    public function getDonationSum($event_id){/*get the sum of all the donations*/
        $query= 'SELECT SUM(amount) as donation_sum FROM donation WHERE event_id =:event_id';
        $params = ["event_id" => $event_id];
        $result=Model::select($query,$params);
        $result = ($result[0]["donation_sum"]==NULL)?0 : $result[0]["donation_sum"];
       return $result;
       
    }

    public function donationReportGenerate($event_id){/*generate a report with all the details of donations*/
        $query = 'SELECT donation.amount, donation.contact_no, date(time_stamp) as date, registered_user.username FROM donation LEFT JOIN registered_user ON donation.uid=registered_user.uid WHERE event_id =:event_id'; 
        $params = ["event_id" => $event_id];
        $result=Model::select($query,$params);
       return $result;
    }

    public function donationRefund($event_id){/*set status as refunded in the event table*/
        $query = "UPDATE event SET donation_status='refunded' WHERE event_id =:event_id";
        $params = ["event_id" => $event_id];
        Model::insert($query,$params);
    }

    public function donationCredit(){/*set donation_status as credited in the donation table*/
        $query = "UPDATE donation SET donation_status='credited' WHERE event_id IN (SELECT event_id FROM event WHERE end_date < cast((now()) as date))";
        $params = [];
        Model::insert($query,$params);
    }
    
}