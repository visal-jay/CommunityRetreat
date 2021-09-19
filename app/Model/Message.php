<?php
class Message extends Model
{
    public function getMessages($user, $reciever)
    {
        $query = "SELECT message,time_stamp,(:user_id = sender) 'is_sender' from messages WHERE (sender= :sender_1 AND reciever= :reciever_1) OR (sender= :sender_2 AND reciever= :reciever_2)";
        $params = ["user_id" => $user, "sender_1" => $user, "sender_2" => $reciever, "reciever_1" => $reciever, "reciever_2" => $user];
        $result= Model::select($query, $params);
        $query = "UPDATE messages SET seen = 1  WHERE sender= :reciever AND reciever= :sender";
        $params = ["sender"=>$user,"reciever"=>$reciever];
        Model::insert($query,$params);
        return $result;
    }

    public function getChatList($user)
    {
        $query = "SELECT reciever as uid from messages WHERE sender= :sender UNION SELECT sender as uid from messages WHERE reciever= :reciever";
        $params = ["sender" => $user, "reciever" => $user];
        return Model::select($query, $params);
    }

    public function getLastMessage($user, $reciever)
    {
        $query = "SELECT message,time_stamp,seen,(:user_id = sender) 'is_sender' from messages WHERE (sender= :sender_1 AND reciever= :reciever_1) OR (sender= :sender_2 AND reciever= :reciever_2) ORDER BY time_stamp DESC LIMIT 1";
        $params = ["user_id"=>$user,"sender_1" => $user, "sender_2" => $reciever, "reciever_1" => $reciever, "reciever_2" => $user];
        //var_dump(Model::select($query, $params));
        $result= Model::select($query, $params);
        //var_dump($result);
        return $result;
    }

    public function insertMessage($sender, $reciever, $message)
    {
        $query = "INSERT INTO messages (sender,reciever,message) VALUES (:sender,:reciever,:message)";
        $params = ["sender" => $sender, "reciever" => $reciever, "message" => $message];
        Model::insert($query, $params);
    }
}
