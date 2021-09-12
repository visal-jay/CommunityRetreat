<?php
class Announcement extends Model{

    public function addAnnouncement($data)
    {
        $query = "INSERT INTO `announcement` (`event_id`, `title`, `announcement`) VALUES (:event_id, :title, :announcement)";
        $params = array_intersect_key($data, ["event_id" => '', "title" => '', "announcement" => '']);
        Model::insert($query, $params);
    }

    public function getAnnouncement($event_id,$announcement_id=-1){
        if($announcement_id != -1){
            $query = "SELECT `title`, `announcement`, `announcement_id`, date(time_stamp) AS date FROM announcement WHERE event_id= :event_id AND announcement_id= :announcement_id";
            $params = ["event_id"=> $event_id, "announcement_id"=> $announcement_id];
        }
        else{
            $query = "SELECT `title`, `announcement`, `announcement_id`, date(time_stamp) AS date FROM announcement WHERE event_id= :event_id ORDER BY time_stamp DESC";
            $params = ["event_id"=> $event_id];
        }
        $result = Model::select($query, $params);
        return $result;
    }

    public function editAnnouncement($data)
    {
        $params=array();
        $old_data = $this->getAnnouncement($data["event_id"], $data["announcement_id"]);
        $new_data = array_merge($old_data, $data);
        $update_data = array_intersect_key($new_data, ['announcement_id' => "", 'title' => "", 'announcement' => ""]);
        $params=array_merge($update_data,$params);
        $query = "UPDATE announcement SET `title` = :title, `announcement` = :announcement WHERE `announcement_id`=:announcement_id ";
        Model::insert($query, $params);
    }

    public function deleteAnnouncement($announcement_id)
    {
        $query = "DELETE FROM `announcement` WHERE announcement_id= :announcement_id";
        $params = ["announcement_id" => $announcement_id];
        var_dump($params);
        Model::insert($query, $params);
    }

}