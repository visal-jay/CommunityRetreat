<?php
class Task extends Model
{
    public function getTask($event_id, $task_id = -1)
    {
        if ($task_id != -1) {
            $query = "SELECT `task`, `task_id`, `start_date`, `end_date`, `completed` FROM work_timeline WHERE task_id= :task_id";
            $params = ["task_id" => $task_id];
        } else {
            $query = "SELECT `task`, `task_id`, `start_date`, `end_date`, `completed` FROM work_timeline WHERE event_id= :event_id ORDER BY `start_date` ASC";
            $params = ["event_id" => $event_id];
        }
        $result = Model::select($query, $params);
        return $result;
    }

    public function addTask($data)
    {
        $query = "INSERT INTO `work_timeline` (`event_id`, `task`, `start_date`, `end_date`) VALUES (:event_id, :task, :start_date, :end_date)";
        $params = array_intersect_key($data, ["event_id" => '', "task" => '', "start_date" => '', "end_date" => '']);
        Model::insert($query, $params);
    }

    public function editTask($data)
    {
        $params = array();
        $old_data = $this->getTask($data["event_id"], $data["task_id"]);
        $new_data = array_merge($old_data, $data);
        $update_data = array_intersect_key($new_data, ['task_id' => "", 'task' => "", 'start_date' => "", 'end_date' => ""]);
        $params = array_merge($update_data, $params);
        $query = "UPDATE work_timeline SET `task` = :task, `start_date` = :start_date, `end_date` = :end_date WHERE `task_id`=:task_id ";
        Model::insert($query, $params);
    }

    public function deleteTask($task_id)
    {
        $query = "DELETE FROM `work_timeline` WHERE task_id= :task_id";
        $params = ["task_id" => $task_id];
        Model::insert($query, $params);
    }

    public function completed($task_id)
    {
        $result = $this->getTask(-1, $task_id);
        if ($result[0]["completed"] == 0) {
            $query = "UPDATE work_timeline SET completed=1 WHERE task_id= :task_id";
        } else {
            $query = "UPDATE work_timeline SET completed=0 WHERE task_id= :task_id";
        }

        $params = ["task_id" => $task_id];
        Model::insert($query, $params);
    }
}
