<?php
class Complaint extends Model{

    public function addComplaint($data){
              
        $query = 'INSERT INTO `complaint` (`uid`, `event_id`, `complaint_name`, `complaint`, `status`,`date`,`path`) VALUES (:uid, :event_id, :complaint_name,:complaint,:status,CURRENT_TIMESTAMP,:path)';
        $params = ["uid" => $data['uid'], "event_id" => $data['event_id'], "complaint_name" => $data['complaint_name'], "complaint" => $data['complaint'], "status" => $data['status'],"path" => $data['path']];
        Model::insert($query,$params);     

    }

    public function getComplaints(){
        $query = 'SELECT * FROM complaint';
        $result = Model::select($query,[]);
        return $result;
    }
}
?>