<?php

class Systemfeedback extends Model{

    public function updateSystemFeedback($data){

        $params = ["uid" => $data['uid'] , "feedback"=> $data['feedback']];
        $query = "INSERT INTO `system_feedback` (`feedback_id`, `uid`, `feedback`, `date`) VALUES (NULL, :uid, :feedback, CURRENT_TIMESTAMP)";
        Model::insert($query,$params); 

    }
    public function renderSystemFeedbacks($data){

        $query = "SELECT * FROM system_feedback ORDER BY date DESC LIMIT :offset , :no_of_records_per_page";
        $params = $data;
        $results = Model::select($query,$params);
        return $results;

    }
    public function changeFeedbackState($data){
        
        $query = "UPDATE system_feedback SET viewed = 1 WHERE feedback_id =:feedback_id";
        $params = ["feedback_id"=>$data['feedback_id']];
        Model::insert($query,$params);
    }
}