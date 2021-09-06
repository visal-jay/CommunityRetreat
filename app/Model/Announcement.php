<?php
class Announcement extends Model{

    public function addAnnouncement($data)
    {
        $query = "INSERT INTO `announcement` (`event_id`, `title`, `announcement`) VALUES (:event_id, :title, :announcement)";
        $params = array_intersect_key($data, ["event_id" => '', "title" => '', "announcement" => '']);
        Model::insert($query, $params);
    }

    public function getAnnouncement($event_id){
        $query = "SELECT `title`, `announcement`, date(time_stamp) AS date FROM announcement WHERE event_id= :event_id";
        $params = ["event_id"=> $event_id];
        $result = Model::select($query, $params);
        return $result;
    }

    public function editAnnouncement($data)
    {

        $params=array();
        $old_data = $this->getAnnouncement($data["announcement_id"]);
        $new_data = array_merge($old_data, $data);
        $update_data = array_intersect_key($new_data, ['announcement_id' => "", 'title' => "", 'announcement' => ""]);
        $params=array_merge($update_data,$params);
        $query = "UPDATE event SET `title` = :title, `date`= :date(time_stamp) AS date FROM announcement, `announcement`= :announcement WHERE announcement_id`=:announcement_id ";
 
        Model::insert($query, $params);
    }

}