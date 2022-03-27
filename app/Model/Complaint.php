<?php
class Complaint extends Model{

    //Insert a complaint
    public function addComplaint($data){
        if($data['status'] == 'user' || $data['status'] == 'organization'){ //If complaint is given by user or organization
            $user_details = (new User)->getDetails($data['complainant_uid']); //Get details of complainant
            $query = 'INSERT INTO `complaint` (`complainant_name`, `uid`, `event_id`, `complaint_name`, `complaint`, `status`,`date`,`path`) VALUES (:complainant_name, :uid, :event_id, :complaint_name,:complaint,:status,CURRENT_TIMESTAMP,:path)';
            $params = ["complainant_name" => $user_details['username'], "uid" => $data['uid'], "event_id" => $data['event_id'], "complaint_name" => $data['complaint_name'], "complaint" => $data['complaint'], "status" => $data['status'],"path" => $data['path']];
        }
        else{ //If complaint is given by event
            $event_details = (new Events)->getDetails($data['event_id']); //Get  event details(complainant)
            $query = 'INSERT INTO `complaint` (`complainant_name`, `uid`, `event_id`, `complaint_name`, `complaint`, `status`,`date`,`path`) VALUES (:complainant_name, :uid, :event_id, :complaint_name,:complaint,:status,CURRENT_TIMESTAMP,:path)';
            $params = ["complainant_name" => $event_details['event_name'], "uid" => $data['uid'], "event_id" => $data['event_id'], "complaint_name" => $data['complaint_name'], "complaint" => $data['complaint'], "status" => $data['status'],"path" => $data['path']];
        }
        Model::insert($query,$params);     

    }
    //Get complaints from Database
    public function getComplaints($data){
        $params = $data;
        $query = 'SELECT event_id,uid,complainant_name,complaint_id, complaint_name,complaint ,date,status, path FROM complaint ORDER BY date DESC LIMIT :offset , :no_of_records_per_page';
        $result = Model::select($query,$params);                                          
        return $result;
    }

    //Delete an existing complaint record
    public function deleteComplaint($data){
        if($data['status'] == 'user' || $data['status'] == 'organization'){ //If status of given complaint is user or organization delete all the records releted that user
            $query = 'DELETE FROM complaint WHERE uid = :uid';
            $params = ['uid' => $data['uid']];
        }
        else{ //If status of given complaint is event  delete all the records releted have event_id of that complaint and status is event
            $query = 'DELETE FROM complaint WHERE status = :status AND event_id = :event_id';
            $params = ['event_id' => $data['event_id'],'status' => $data['status']];
        }      
        Model::insert($query,$params);
    }

    //Remove any complaint without taken action
    public function dismissComplaint($data){
        $query = 'DELETE FROM complaint WHERE complaint_id = :complaint_id';
        $params = ['complaint_id' => $data];
        Model::insert($query,$params);
    }
}
?>