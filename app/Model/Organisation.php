<?php
class Organisation extends User
{


    public function addOrganisation($data)
    {
        $db = Model::getDB();
        $db->beginTransaction();

        $insert_org_ql = 'INSERT INTO `organization` (`email`,`username`, `contact_number`) VALUES (:email,  :username, :contact_number)';
        $stmt = $db->prepare($insert_org_ql);
        $insertData = array_intersect_key($data, ["email" => '', "username" => '', "contact_number" => '']);
        $stmt->execute($insertData);
        $stmt->closeCursor();

        $last_insert_org_sql = 'SELECT uid FROM organization ORDER BY uid DESC LIMIT 1 ';
        $stmt = $db->prepare($last_insert_org_sql);
        $stmt->execute([]);
        $data["uid"] = $stmt->fetchColumn();
        $stmt->closeCursor();

        $data["user_type"] = "organization";
        $insertOrgLoginSql = 'INSERT INTO `login` (`email`,`password`, `uid`, `user_type`) VALUES (:email,  :password, :uid, :user_type)';
        $stmt = $db->prepare($insertOrgLoginSql);
        $insertData = array_intersect_key($data, ["email" => '', "password" => '', "uid" => '', "user_type" => '']);
        $stmt->execute($insertData);

        $db->commit();

        $encryption = new Encryption;
        $parameters = ["key" => $encryption->encrypt(array_intersect_key($data, ["email" => '', "password" => '']), 'email verificaition')];

        $mail = new Mail;

        $mail->verificationEmail($data["email"], "confirmationMail", "localhost/signup/verifyemail?" . http_build_query($parameters), 'Signup');
    }


    public function getDetails($uid)
    {
        $query = 'SELECT  org.username,org.email,org.contact_number,ST_X(org.latlang) as latitude ,ST_Y(org.latlang) as longitude ,org.profile_pic,org.cover_pic,org.about_us FROM organization org INNER JOIN login ON org.uid= login.uid WHERE org.uid = :uid  AND verified=1';
        $params = ["uid" => $uid];
        $result = User::select($query, $params);
        $result[0]["map"] = true;

        if (count($result[0]) > 1) {
            if ($result[0]["latitude"] == NULL || $result[0]["longitude"] == NULL) {
                $result[0]["map"] = false;
            }
            return $result[0];
        } else
            return false;
    }


    public function updateDetails($uid, $data)
    {

        $params = array();

        if ($_FILES["profile-photo"]["size"] != NULL) {
            $cover_pic = new Image($_SESSION["user"]["uid"], "profile/", "profile-photo", true);
            $params["profile_pic"] = $cover_pic->getURL();
        }

        if ($_FILES["cover-photo"]["size"] != NULL) {
            $cover_pic = new Image($_SESSION["user"]["uid"], "cover/", "cover-photo", true);
            $params["cover_pic"] = $cover_pic->getURL();
        }


        foreach (array_keys($data, NULL) as $key) {
            unset($array[$key]);
        }
        if (!$old_data = $this->getDetails($uid))
            return false;

        $params = array_merge(array_merge($old_data, $data), $params);
        $params["uid"] = $uid;

        unset($params["map"]);


        $query = 'UPDATE organization SET username= :username, email= :email, contact_number = :contact_number , latlang=POINT(:latitude,:longitude) ,profile_pic = :profile_pic,cover_pic = :cover_pic,about_us=:about_us  WHERE uid = :uid';
        User::insert($query, $params);
    }

    public function getEvents($status = "deleted")
    {
        $query = 'SELECT event_name,start_date,volunteer_status,donation_status from event WHERE NOT status="deleted" AND ';
        //$params = ["uid" => $uid];
        //$result=User::select($query,$params);
    }



    public function query($args)
    {
        $org_username = NULL;
        extract($args, EXTR_OVERWRITE);

        $query_select_primary = "SELECT uid ";
        $query_table = 'FROM organization WHERE ';
        $query_filter_organization_name = ' username LIKE  "%:org_username%" AND ';
        $query_filter_last = ' 1=1 ';

        $query = $query_select_primary;

        $query = $query . $query_table;

        if ($org_username != NULL) {
            $query = $query . $query_filter_organization_name;
            $params["org_username"] = $org_username;
        }

        $query = $query . $query_filter_last;

        $result = Model::select($query, $params);

        if (count($result) == 0)
            return false;
        return $result;
    }

    public function donationReport()
    {
        $event = new Events;
        $donations = new Donations;
        $data["events"] = array();
        if ($result = $event->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published", "donation_capacity" => true]))
            foreach ($result as $event) {
                if ($donation_details = $donations->getReport(["event_id" => $event["event_id"]])) {
                    $start_date = $date = new DateTime($donation_details[0]["day"]);
                    $end_date = new DateTime($donation_details[count($donation_details) - 1]["day"]);
                    for ($i = $start_date; $i < $end_date; $i->add(new DateInterval('P1D')))
                        $temp[$i->format('Y-m-d')] = 0;


                    foreach ($donation_details as $donation_detail)
                        $temp[$donation_detail["day"]] = $donation_detail["donation_sum"];

                    $count = $i = 1;
                    $sum = 0;
                    $data["events"][$event["event_name"]] = array();
                    foreach ($temp as $key => $value) {
                        $sum += $value;
                        if ($i == 7) {
                            $data["events"][$event["event_name"]]["week $count"] = $sum;
                            $sum = $i = 0;
                            $count++;
                        }
                        $i++;
                    }
                    if (count($temp) % 7 != 0)
                        $data["events"][$event["event_name"]]["week $count"] = $sum;

                    unset($temp);
                }
            }
        return json_encode($data["events"]);
    }

    public function donationPercentageReport()
    {
        $events = new Events;;
        $data["events"] = array();
        if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published", "donation_capacity" => true])) {
            foreach ($result as $event)
                $data["events"][$event["event_name"]] = $event["donation_percent"];
        }

        return json_encode($data["events"]);
    }

    public function volunteerReport()
    {
        $event = new Events;
        $volunteers = new Volunteer;
        $data["events"] = array();
        if ($result = $event->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published", "volunteer_capacity" => true]))
            foreach ($result as $event) {
                if ($volunteer_details = $volunteers->getReport(["event_id" => $event["event_id"]])) {
                    $start_date = $date = new DateTime($volunteer_details[0]["day"]);
                    $end_date = new DateTime($volunteer_details[count($volunteer_details) - 1]["day"]);
                    for ($i = $start_date; $i < $end_date; $i->add(new DateInterval('P1D')))
                        $temp[$i->format('Y-m-d')] = 0;


                    foreach ($volunteer_details as $volunteer_detail)
                        $temp[$volunteer_detail["day"]] = $volunteer_detail["volunteer_sum"];

                    $count = $i = 1;
                    $sum = 0;
                    $data["events"][$event["event_name"]] = array();
                    foreach ($temp as $key => $value) {
                        $sum += $value;
                        if ($i == 7) {
                            $data["events"][$event["event_name"]]["week $count"] = $sum;
                            $sum = $i = 0;
                            $count++;
                        }
                        $i++;
                    }
                    if (count($temp) % 7 != 0)
                        $data["events"][$event["event_name"]]["week $count"] = $sum;

                    unset($temp);
                }
            }
        return json_encode($data["events"]);
    }

    public function volunteerPercentageReport()
    {
        $events = new Events;;
        $data["events"] = array();
        if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published", "volunteer_capacity" => true])) {
            foreach ($result as $event)
                $data["events"][$event["event_name"]] = $event["volunteer_percent"];
        }

        return json_encode($data["events"]);
    }
}
