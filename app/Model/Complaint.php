<?php
class Complaint extends Model{

    public function addComplaint($data){
              
        $query = 'INSERT INTO `complaint` (`complainant_uid`, `uid`, `event_id`, `complaint_name`, `complaint`, `status`,`date`,`path`) VALUES (:complainant_uid, :uid, :event_id, :complaint_name,:complaint,:status,CURRENT_TIMESTAMP,:path)';
        $params = ["complainant_uid" => $data['complainant_uid'], "uid" => $data['uid'], "event_id" => $data['event_id'], "complaint_name" => $data['complaint_name'], "complaint" => $data['complaint'], "status" => $data['status'],"path" => $data['path']];
        Model::insert($query,$params);     

    }

    public function getComplaints($data){
        $params = $data;
        $query = 'SELECT complaint.event_id,complaint.uid,reg.username,complaint.complaint_id, complaint.complaint_name, complaint.complaint ,complaint.date, complaint.path FROM complaint JOIN registered_user reg ON complaint.complainant_uid = reg.uid ORDER BY date DESC LIMIT :offset , :no_of_records_per_page';
        $result = Model::select($query,$params);                                          
        return $result;
    }

    public function deleteComplaint($complaint_id){
        $query = 'DELETE FROM complaint WHERE complaint_id = :complaint_id';
        $params = ['complaint_id' => $complaint_id];
        Model::insert($query,$params);
    }
}
?>