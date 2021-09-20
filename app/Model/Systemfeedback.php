<?php

class Systemfeedback extends Model{

    public function updateSystemFeedback($data){

        $params = ["uid" => $data['uid'] , "feedback"=> $data['feedback']];
        $query = "INSERT INTO `system_feedback` (`feedback_id`, `uid`, `feedback`, `date`) VALUES (NULL, :uid, :feedback, CURRENT_TIMESTAMP)";
        Model::insert($query,$params); 

    }
}