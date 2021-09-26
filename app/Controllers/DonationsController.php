<?php

class DonationsController{
    public function view($event_details){
        /*view the donations in the UI by sending the data from backend*/
        $user_roles = Controller::accessCheck(["treasurer", "organization"]);/*check whether organization or treasurer accessed it.*/
        $data = array_intersect_key((new Events)->getDetails($_GET["event_id"]), ["donation_status" => '', "donation_capacity" => '']);
        $donation = new Donations();
        $donate_details = $donation->getDonateDetails($_GET["event_id"]);
        $data["donations"] = $donate_details;
        $donate_sum = $donation->getDonationSum($_GET["event_id"]);
        $data["donation_sum"] = $donate_sum;
        $data = array_merge($data, $event_details);
        View::render('eventPage', $data, $user_roles);/*send all the data to eventPage*/
    }

    public function disableDonation()
    { /*disable donations for an event*/
        $donation = new Donations;
        $donation->disableDonation($_GET["event_id"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after disabling donation.*/
    }

    public function enableDonation()
    { /*enable donations for an event*/
        $donation = new Donations;
        $donation->enableDonation($_GET["event_id"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after enabling donation.*/
    }

    public function updateDonationCapacity()
    { /*update donation capacity*/
        $donation = new Donations;
        $donation->updateDonationCapacity($_GET["event_id"], $_POST["donation_capacity"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after updating donation capacity.*/
    }

    public function donationReport()/*Generate the report of all the donations*/
    {
        $donation = new Donations;
        $data["donations"] = $donation->donationReportGenerate($_GET["event_id"]);
        $data["donations_graph"] = json_encode($donation->getReport(["event_id" => $_GET["event_id"]]));
        $data["event_name"]  = (new Events)->getDetails($_GET["event_id"])["event_name"];
        View::render('donationsReport', $data);/*send all the data to donationsReport page*/
    }

    public function donationRefund(){/*change the status in database when donations are refunded*/
        $donation = new Donations;
        $donation->donationRefund($_GET["event_id"]);
               
    }

    public function donationCredit(){/*change the status in database when donations are credited to organizations account*/
        $donation = new Donations;
        $donation->donationCredit($_GET["event_id"]);
        
    }
}