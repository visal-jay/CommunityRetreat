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
}