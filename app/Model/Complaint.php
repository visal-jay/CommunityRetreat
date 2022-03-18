<?php
class Complaint extends Model{

    public function addComplaint($data){
        if($data['status'] == 'event' || $data['status'] == 'organization'){
            $user_details = (new User)->getDetails($data['complainant_uid']);
            $query = 'INSERT INTO `complaint` (`complainant_name`, `uid`, `event_id`, `complaint_name`, `complaint`, `status`,`date`,`path`) VALUES (:complainant_name, :uid, :event_id, :complaint_name,:complaint,:status,CURRENT_TIMESTAMP,:path)';
            $params = ["complainant_name" => $user_details['username'], "uid" => $data['uid'], "event_id" => $data['event_id'], "complaint_name" => $data['complaint_name'], "complaint" => $data['complaint'], "status" => $data['status'],"path" => $data['path']];
        }
        else{
            $event_details = (new Events)->getDetails($data['event_id']);
            $query = 'INSERT INTO `complaint` (`complainant_name`, `uid`, `event_id`, `complaint_name`, `complaint`, `status`,`date`,`path`) VALUES (:complainant_name, :uid, :event_id, :complaint_name,:complaint,:status,CURRENT_TIMESTAMP,:path)';
            $params = ["complainant_name" => $event_details['event_name'], "uid" => $data['uid'], "event_id" => $data['event_id'], "complaint_name" => $data['complaint_name'], "complaint" => $data['complaint'], "status" => $data['status'],"path" => $data['path']];
        }
        Model::insert($query,$params);     

    }

    public function getComplaints($data){
        $params = $data;
        $query = 'SELECT event_id,uid,complainant_name,complaint_id, complaint_name,complaint ,date,status, path FROM complaint ORDER BY date DESC LIMIT :offset , :no_of_records_per_page';
        $result = Model::select($query,$params);                                          
        return $result;
    }

    public function deleteComplaint($data){
        if($data['status'] == 'user' || $data['status'] == 'organization'){
            $query = 'DELETE FROM complaint WHERE uid = :uid';
            $params = ['uid' => $data['uid']];
        }
        else{
            $query = 'DELETE FROM complaint WHERE status = :status AND event_id = :event_id';
            $params = ['event_id' => $data['event_id'],'status' => $data['status']];
        }      
        Model::insert($query,$params);
    }
}
?>