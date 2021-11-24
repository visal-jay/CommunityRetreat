<?php

class Gallery extends Model
{

    public function getGallery($data, $organisation = false)
    {
        if ($organisation)
            $query = "SELECT * FROM organization_gallery WHERE uid = :uid LIMIT :offset , :no_of_records_per_page";
        else
            $query = " SELECT * FROM (SELECT photo.* , reg.username FROM add_photo photo INNER JOIN registered_user reg ON reg.uid=photo.uid  UNION SELECT photo.* , org.username FROM add_photo photo INNER JOIN organization org ON org.uid=photo.uid) sub WHERE event_id = :event_id LIMIT :offset , :no_of_records_per_page";

        $params = $data;
        $result = Model::select($query, $params);
        if (count($result) == 0)
            return false;
        else
            return $result;
    }

    public function addPhoto($data = [], $organisation = false)
    {
        $image_count=count($_FILES["photo"]["name"]);
        for ($i = 0; $i < $image_count; $i++) { 
            $db = Model::getDB();
            $db->beginTransaction();

            if ($organisation)
                $query = " SELECT image_id from organization_gallery ORDER BY image_id DESC LIMIT 1";
            else
                $query = "SELECT image_id from add_photo ORDER BY image_id DESC LIMIT 1";

            $params = array();
            $stmt = $db->prepare($query);
            $stmt->execute($params);
            $image_id = $stmt->fetchColumn();
            $stmt->closeCursor();

            if (!$image_id)
                $image_id = 0;
            else
                $image_id = $image_id + 1;

            if (isset($_FILES["photo"])) {
                if ($organisation)
                    $image = new Image($_SESSION["user"]["uid"] . "-" . $image_id, "organisation/gallery/", "photo");
                else
                    $image = new Image($data["event_id"] . "-" . $_SESSION["user"]["uid"] . "-" . $image_id, "event/gallery/", "photo");

                $params["image"] = $image->getURL();
                $params["image_id"] = $image_id;
            }

            if ($organisation) {
                $query = "INSERT INTO `organization_gallery` (`image_id`, `uid`, `image`) VALUES (:image_id, :uid , :image)";
                $params = array_merge(["uid" => $_SESSION["user"]["uid"]], $params);
            } else {
                $query = "INSERT INTO `add_photo` (`image_id`,`event_id`, `uid`, `image`) VALUES (:image_id, :event_id , :uid , :image)";
                $params = array_merge(["event_id" => $data["event_id"], "uid" => $_SESSION["user"]["uid"]], $params);
            }


            $stmt = $db->prepare($query);
            $stmt->execute($params);

            $db->commit();
        }//
    }

    public function deletePhoto($data, $organisation = false)
    {
        $image = $data["image"];
        if ($organisation)
            $query = "DELETE FROM organization_gallery where image= :image";
        else
            $query = "DELETE FROM add_photo where image= :image";

        $params = ["image" => $image];
        Model::insert($query, $params);
        exec("rm ". __DIR__ ."/.." .$image);
    }
}
