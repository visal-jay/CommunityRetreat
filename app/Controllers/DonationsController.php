<?php

use Stripe\Event;

class DonationsController
{
    public function view($event_details)
    {
        /*view the donations in the UI by sending the data from backend*/

        Controller::validateForm([], ["url", "event_id", "page"]);
        $user_roles = Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        $event = (new Events)->getDetails($_GET["event_id"]);
        $data = array_intersect_key($event, ["donation_status" => '', "donation_capacity" => '', "status" => '']);
        $donation = new Donations();
        $pagination = Model::pagination("donation", 10, "WHERE event_id =:event_id", ["event_id" => $_GET["event_id"]]);
        $data["donations"] = $donation->getDonateDetails($_GET["event_id"], $pagination["offset"],  $pagination["no_of_records_per_page"]);
        $data["donation_sum"] = $donation->getDonationSum($_GET["event_id"]);
        $check_accountNo = (new Organisation)->getDetails($event['org_uid']);
        $data["donations_graph"] = json_encode($donation->getReport(["event_id" => $_GET["event_id"]]));
        $event = new Events;
        $data["donation_percent"] = $event->getDetails($_GET["event_id"])["donation_percent"];
        $check_accountNo = (new Organisation)->getDetails($_SESSION['user']['uid']);


        if ($check_accountNo['account_number'] != NULL || $check_accountNo["bank_name"] != NULL) {

            $data["have_account_number"] = "TRUE";
        } else {
            $data["have_account_number"] = "FALSE";
        }

        $data = array_merge($data, $event_details);
        $data = array_merge($data, $pagination);
        View::render('eventPage', $data, $user_roles);/*send all the data to eventPage*/
    }

    public function disableDonation()
    { /*disable donations for an event*/

        Controller::validateForm([], ["url", "event_id"]);
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        (new UserController)->addActivity("Donation disabled", $_GET["event_id"]);
        (new Donations)->disableDonation($_GET["event_id"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after disabling donation.*/
    }

    public function enableDonation()
    { /*enable donations for an event*/

        Controller::validateForm([], ["url", "event_id"]);
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        (new UserController)->addActivity("Enable donations", $_GET["event_id"]);;
        $event = (new Events)->getDetails($_GET["event_id"]);
        (new Donations)->enableDonation($_GET["event_id"]);
        (new VolunteerController)->sendNotificationstoVolunteers("{$event['event_name']} event accepts donations now.You can donate..!", "/Event/view?page=about&event_id={$_GET['event_id']}", $_GET["event_id"], "donationEnabledMail", ["event_name" => $event['event_name']], "Donations for " . $event['event_name'] . " have been enabled.");
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after enabling donation.*/
    }


    public function updateDonationCapacity()
    { /*update donation capacity*/

        Controller::validateForm(["donation_capacity"], ["url", "event_id"]);
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        (new UserController)->addActivity("Update donation capacity", $_GET["event_id"]);
        (new Donations)->updateDonationCapacity($_GET["event_id"], $_POST["donation_capacity"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after updating donation capacity.*/
    }

    public function donationReport()/*Generate the report of all the donations*/
    {
        Controller::validateForm([], ["url", "event_id"]);
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        $donation = new Donations;
        $data["donations"] = $donation->donationReportGenerate($_GET["event_id"], isset($_POST["date"]) ? $_POST["date"] : -1);
        $data["selected_date"] = isset($_POST["date"]) ? $_POST["date"] : -1;
        $data["donations_graph"] = json_encode($donation->getReport(["event_id" => $_GET["event_id"]]));
        $data["donation_sum"] = $donation->getDonationSum($_GET["event_id"]);
        $event_details = (new Events)->getDetails($_GET["event_id"]);
        $time = (int)shell_exec("date '+%s'");
        $start_date = $event_details["start_date"];

        
        $dates = array_column(json_decode($data["donations_graph"]),"day");
        $min =min($dates);
        
        if(sizeof($dates)==0 || $min>$start_date){
            $first_date = $event_details["start_date"];
        } else{
            $first_date = $min;
        }

        $data["donations"] = $donation->donationReportGenerate($_GET["event_id"], isset($_POST["date"]) ? $_POST["date"] : -1);

        $end_date = gmdate("Y-m-d", $time) < $event_details["end_date"] && $time != 0 ? gmdate("Y-m-d", $time) : $event_details["end_date"];
        $end_date = $event_details["end_date"];
        $data["event_name"]  = $event_details["event_name"];
        $period = new DatePeriod(
            new DateTime($first_date),
            new DateInterval('P1D'),
            new DateTime($end_date)
        );

        foreach ($period as $date) {
            $data["period"][] = $date->format('Y-m-d');
        }


        View::render('donationsReport', $data);/*send all the data to donationsReport page*/
    }

    public function donationCredit($event_id)
    {/*change the status in database when donations are credited to organizations account*/

        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        (new UserController)->addActivity("Update donation status as credited", $_GET["event_id"]);
        $donation = new Donations;
        $donation->donationCredit($event_id);
    }

    public function pay()
    {

        Controller::validateForm(["amount", "terms"], ["url"]);
        Controller::accessCheck(["registered_user"]);/*check whether registered user accessed it.*/

        $validate = new Validation;
        if (!$validate->currency($_POST["amount"]))/*find whether amount is valid*/
            Controller::redirect("/Event/view?page=about&&event_id=" . $_POST["event_id"], ["amountErr" => "Inavlid amount"]);

        require __DIR__ . "/../Libararies/stripe-php-master/init.php";

        \Stripe\Stripe::setApiKey('sk_test_51JdYJ6JhZDUPzRAXbJg3k221yQ9pgNLhCFYz2ifKf6FPXszolkCJdx6N4tvg5CBvz5bSOVw3OnBZnAV7WFYnR2Ne00yji9wY0R');

        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $YOUR_DOMAIN = $protocol . $_SERVER['HTTP_HOST'];


        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    "currency" => "lkr",
                    "product_data" => [
                        "name" => "Donation"
                    ],
                    "unit_amount" => $_POST["amount"] . "00"
                ],
                'quantity' => 1,

            ]],
            'payment_method_types' => [
                'card',
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/Donations/donationAccept?session_id={CHECKOUT_SESSION_ID}&event_id=' . $_GET["event_id"],
            'cancel_url' => $YOUR_DOMAIN . '/Event/view?page=about&event_id=' . $_POST["event_id"],
        ]);

        header("Location: $checkout_session->url", true,  302);
        exit();
    }

    public function donationAccept()
    {
        Controller::validateForm([], ["event_id", "session_id"]);
        Controller::accessCheck(["registered_user"]);/*check whether registered user accessed it.*/
        require __DIR__ . "/../Libararies/stripe-php-master/init.php";

        \Stripe\Stripe::setApiKey('sk_test_51JdYJ6JhZDUPzRAXbJg3k221yQ9pgNLhCFYz2ifKf6FPXszolkCJdx6N4tvg5CBvz5bSOVw3OnBZnAV7WFYnR2Ne00yji9wY0R');

        $session = \Stripe\Checkout\Session::retrieve($_GET["session_id"]);
        (new UserController)->addActivity("Donated " . substr($session["amount_total"], 0, -2), $_GET["event_id"]);
        (new Donations)->donationAccept($_SESSION["user"]["uid"], $_GET["event_id"], substr($session["amount_total"], 0, -2), $session["payment_intent"]);
        Controller::redirect("/Event/view", ["page" => "about", "event_id" => $_GET["event_id"]]);
    }

    public function donationRefund($event_id)
    {/*change the status in database when donations are refunded*/

        Controller::accessCheck(["admin", "organization"]);/*check whether organization or admin accessed it.*/
        $donation = new Donations;
        $donation_details = $donation->getRefundDetails($event_id);
        $data = (new Events)->getDetails($event_id);
        $donation->donationRefund($event_id);
        foreach ($donation_details as $donation_data) {
            (new UserController)->sendNotifications("{$data['event_name']} event has been removed. We refunded your donations.", $donation_data["uid"], "event", "window.location.href= '' ", $event_id, "donationRefundMail", ["event_name" => $data['event_name']], "Donation refunded.");
            $this->refund($donation_data["intent_id"]);
        }
    }

    public function refund($intent_id)
    {
        require __DIR__ . "/../Libararies/stripe-php-master/init.php";
        \Stripe\Stripe::setApiKey('sk_test_51JdYJ6JhZDUPzRAXbJg3k221yQ9pgNLhCFYz2ifKf6FPXszolkCJdx6N4tvg5CBvz5bSOVw3OnBZnAV7WFYnR2Ne00yji9wY0R');
        \Stripe\Refund::create([
            'payment_intent' => $intent_id,
        ]);
    }
}
