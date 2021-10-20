<?php
class Feedback extends Model{

    public function addFeedback($data)
    {
        $query = "INSERT INTO `event_feedback` (`event_id`, `uid`, `feedback`, `rate`) VALUES (:event_id, :uid, :feedback, :rate)";
        $params = array_intersect_key($data, ["event_id" => '', "uid" => '', "feedback" => '', "rate" => '']);
        Model::insert($query, $params);
    }

    public function getFeedback($event_id=-1, $feedback_id=-1, $status=NULL){
        if($feedback_id != -1){
            $query = "SELECT `feedback_id`, `feedback`, `time_stamp`, `rate`, event_feedback.uid, event_feedback.status, registered_user.username FROM event_feedback LEFT JOIN registered_user ON event_feedback.uid=registered_user.uid WHERE feedback_id= :feedback_id";
            $params = ["feedback_id"=> $feedback_id];
        }
        else if($event_id != -1 && $status != NULL){
            $query = "SELECT `feedback_id`, `feedback`, `time_stamp`, `rate`, event_feedback.uid, event_feedback.status, registered_user.username FROM event_feedback LEFT JOIN registered_user ON event_feedback.uid=registered_user.uid WHERE event_id= :event_id AND status = :status ORDER BY time_stamp DESC";
            $params = ["event_id"=> $event_id, "status"=> $status];
        }
        else{
            $query = "SELECT `feedback_id`, `feedback`, `time_stamp`, `rate`, event_feedback.uid, event_feedback.status, registered_user.username FROM event_feedback LEFT JOIN registered_user ON event_feedback.uid=registered_user.uid WHERE event_id= :event_id ORDER BY time_stamp DESC";
            $params = ["event_id"=> $event_id];
        }
        $result = Model::select($query, $params);
        return $result;
    }

    public function totalFeedback($event_id){
        $query = "SELECT SUM(rate)/COUNT(feedback_id) AS avg_rate, COUNT(feedback_id) AS total FROM event_feedback WHERE event_id= :event_id";
        $params = ["event_id"=>$event_id];
        $result = Model::select($query, $params); 
        $result[0]["avg_rate"] = $result[0]["avg_rate"] == NULL ? 0: $result[0]["avg_rate"];
        $result[0]["total"] = $result[0]["total"] == NULL ? 0: $result[0]["total"];
        return $result[0];
    }

    public function statusToggle($feedback_id){
        $result= $this->getFeedback(-1,$feedback_id);
        if ($result[0]["status"]== "show"){
            $query = "UPDATE event_feedback SET status='hide' WHERE feedback_id= :feedback_id";
        }
        else {
            $query = "UPDATE event_feedback SET status='show' WHERE feedback_id= :feedback_id";
        }
        
        $params = ["feedback_id" => $feedback_id];
        Model::insert($query, $params);
    }

}