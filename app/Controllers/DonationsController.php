<?php

class DonationsController{
    public function view($event_details){
       
        

        /*view the donations in the UI by sending the data from backend*/

        Controller::validateForm([], ["url", "event_id", "page"]);
        $user_roles = Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
       // exit();
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

        Controller::validateForm([], ["url", "event_id"]);
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        $donation = new Donations;
        $donation->disableDonation($_GET["event_id"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after disabling donation.*/
    }

    public function enableDonation()
    { /*enable donations for an event*/

        Controller::validateForm([], ["url", "event_id"]);
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        $donation = new Donations;
        $donation = new Donations;
        $donation->enableDonation($_GET["event_id"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after enabling donation.*/
    }

    public function updateDonationCapacity()
    { /*update donation capacity*/

        Controller::validateForm(["donation_capacity"], ["url", "event_id"]);
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        $donation = new Donations;
        $donation->updateDonationCapacity($_GET["event_id"], $_POST["donation_capacity"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after updating donation capacity.*/
    }

    public function donationReport()/*Generate the report of all the donations*/
    {
        Controller::validateForm([], ["url", "event_id"]);
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        $donation = new Donations;
        $data["donations"] = $donation->donationReportGenerate($_GET["event_id"]);
        $data["donations_graph"] = json_encode($donation->getReport(["event_id" => $_GET["event_id"]]));
        $data["event_name"]  = (new Events)->getDetails($_GET["event_id"])["event_name"];
        View::render('donationsReport', $data);/*send all the data to donationsReport page*/
    }

    public function donationRefund(){/*change the status in database when donations are refunded*/

        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        $donation = new Donations;
        $donation->donationRefund($_GET["event_id"]);
               
    }

    public function donationCredit(){/*change the status in database when donations are credited to organizations account*/

        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        $donation = new Donations;
        $donation->donationCredit($_GET["event_id"]);
        
    }

    public function pay(){
        require __DIR__."/../Libararies/stripe-php-master/init.php";
        
        \Stripe\Stripe::setApiKey('sk_test_51JdYJ6JhZDUPzRAXbJg3k221yQ9pgNLhCFYz2ifKf6FPXszolkCJdx6N4tvg5CBvz5bSOVw3OnBZnAV7WFYnR2Ne00yji9wY0R');
        
        $YOUR_DOMAIN = 'http://localhost:8080';

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price' => 'price_1JeMF8JhZDUPzRAXf8dXeI5D',
                'quantity' => 1,
              ]],
        'payment_method_types' => [
            'card',
        ],
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '/success.html',
        'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        Controller::redirect($checkout_session->url);
    }
}