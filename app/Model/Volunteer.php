<?php 

class Volunteer extends Model{
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