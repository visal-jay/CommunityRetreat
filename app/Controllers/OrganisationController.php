<?php

//use Defuse\Crypto\File;

class OrganisationController
{
    public function view($org_id = '')
    {

        $org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : $org_id;
        $data = (new Organisation)->getDetails($org_id);
        View::render("organisationDashboard", $data);
    }

    public function dashboard()
    {
        $this->view($_SESSION["user"]["uid"]);
    }

    public function addPhoto()
    {
        (new Gallery)->addPhoto([], true);
        Controller::redirect("/organisation/gallery");
    }


    public function gallery()
    {
        if (!$data = (new Gallery)->getGallery(["uid" => $_SESSION["user"]["uid"]], true))
            $data = array();

        View::render("organisationGallery", array_merge(["photos" => $data]));
    }

    public function deletePhoto()
    {
        (new Gallery)->deletePhoto(["image" => $_POST["photo"]], true);
        Controller::redirect("/organisation/gallery");
    }

    public function update()
    {
        Controller::accessCheck(["organization"]);
        $validate = new Validation();
        if (!$validate->telephone($_POST["contact_number"]))
            $error = ["telephone" => "Wrong telephone number", "error" => true];
        if (isset($error))
            Controller::redirect("/organisation/dashboard", $error);
        (new Organisation)->updateDetails($_SESSION["user"]["uid"], $_POST);
        Controller::redirect("/Organisation/dashboard");
    }

    public function events()
    {
        $event = new Events;
        $data["events"] = array();
        if ($result = $event->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published"]))
            foreach ($result as $event)
                array_push($data["events"], $event);
        if ($result = $event->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "added"]))
            foreach ($result as $event)
                array_push($data["events"], $event);

        usort($data["events"], function ($a, $b) {
            return $a['event_id'] <=> $b['event_id'];
        });

        View::render("manageEvents", $data);
    }

    public function report()
    {
        $event = new Events;
        $donations = new Donations;
        $data["events"] = array();
        if ($result = $event->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published" ,"donation_capacity"=>true]))
            foreach ($result as $event){
                if ($donation_details = $donations->getReport(["event_id" => $event["event_id"]])) {
        
                    $start_time = strtotime($donation_details[0]["day"]);
                    $start_date=date("d", $start_time);
                    $start_month = date("m", $start_time);
                    $start_year = date("Y", $start_time);
                    $end_time = strtotime($donation_details[count($donation_details) - 1]["day"]);
                    $end_date=date("d", $end_time);
                    $end_month=date("m", $end_time);
                    $end_year = date("Y", $end_time);
                    //var_dump($end_date,$end_month, $end_year);
                    
                    $temp=array();
                    for ($year=$start_year ; $year<=$end_year ; $year++){
                        $loop_start_month = ($year==$start_year) ? $start_month : 0;
                        $loop_end_month = ($year==$end_year) ? $end_month : 12;
                        for ($month = $loop_start_month ; $month <= $loop_end_month ; $month++){
                            $loop_start_date= ($year==$start_year && $month==$start_month) ? $start_date : 1 ;
                            $loop_end_date= ($year==$end_year && $month==$end_month) ? $end_date : cal_days_in_month(CAL_GREGORIAN,$month,$year) ;
                            for ($day = $loop_start_date ; $day <= $loop_end_date ; $day++)
                                $temp["$year-". str_pad($month,2,"0", STR_PAD_LEFT) ."-".str_pad($day,2,"0", STR_PAD_LEFT)]=0;
                        }
                    }

                    foreach ($donation_details as $donation_detail)
                        $temp[$donation_detail["day"]]=$donation_detail["donation_sum"];
                        

                    $count=$i=1;
                    $sum=0;
                    $data["events"][$event["event_name"]]=array();
                    foreach ($temp as $key => $value){
                        $sum+=$value;
                        if($i==7)
                        {
                            $data["events"][$event["event_name"]]["donations"]["week $count"]=$sum;
                            $sum=$i=0; 
                            $count++;
                        }
                        $i++;
                    }
                    if(count($temp)%7!=0)
                        $data["events"][$event["event_name"]]["donations"]["week $count"]=$sum;
                        
                    unset($temp);
                }

                $data["events"][$event["event_name"]]["donations_percent"]=$event["donation_percent"];
                $data["events"]= json_encode($data["events"]);

            }
            

       View::render("report",$data);
    }
}
