<?php

use Stripe\Event;

class DonationsController
{
    public function view($event_details)
    {
        /*view the donations in the UI by sending the data from backend*/

        /*checking whether all the required data comes from the form */
        Controller::validateForm([], ["url", "event_id", "page"]);
        /*check whether organization or treasurer accessed it.*/
        $user_roles = Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);
        /*get details about the events*/
        $event = (new Events)->getDetails($_GET["event_id"]);
        /* get the common records from event array */
        $data = array_intersect_key($event, ["donation_status" => '', "donation_capacity" => '', "status" => '']);
        $donation = new Donations();
        /* call the pagination functions*/
        $pagination = Model::pagination("donation", 10, "WHERE event_id =:event_id", ["event_id" => $_GET["event_id"]]);
        /* get the donation details to data array */
        $data["donations"] = $donation->getDonateDetails($_GET["event_id"], $pagination["offset"],  $pagination["no_of_records_per_page"]);
        /* get the donation sum to data array */
        $data["donation_sum"] = $donation->getDonationSum($_GET["event_id"]);
        /* get organization details */
        $check_accountNo = (new Organisation)->getDetails($event['org_uid']);
        /* make ready for javascript */ 
        $data["donations_graph"] = json_encode($donation->getReport(["event_id" => $_GET["event_id"]]));
        $event = new Events;
        /* get the donation_percent from event details to data array */
        $data["donation_percent"] = $event->getDetails($_GET["event_id"])["donation_percent"];
        /* check if an account number exist in the organization */
        if ($check_accountNo['account_number'] != NULL && $check_accountNo["bank_name"] != NULL) {
            $data["have_account_number"] = "TRUE";
        } else {
            $data["have_account_number"] = "FALSE";
        }
        /* merge the data array and event details array to data array */
        $data = array_merge($data, $event_details);
        /* merge the data array and pagination array to data array */
        $data = array_merge($data, $pagination);
        /*send all the data to eventPage*/
        View::render('eventPage', $data, $user_roles);
    }

    public function disableDonation()
    { /*disable donations for an event*/

        /*checking whether all the required data comes from the form */
        Controller::validateForm([], ["url", "event_id"]);
        /*check whether organization or treasurer accessed it.*/
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);
        /* Activity log will be updated after disabling donations */
        (new UserController)->addActivity("Donation disabled", $_GET["event_id"]);
        /* calling disable donaion function */
        (new Donations)->disableDonation($_GET["event_id"]);
        /*redirect to event page after disabling donation.*/
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);
    }

    public function enableDonation()
    { /*enable donations for an event*/

        /*checking whether all the required data comes from the form */
        Controller::validateForm([], ["url", "event_id"]);
        /*check whether organization or treasurer accessed it.*/
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);
        /* Activity log will be updated after enabling donations */
        (new UserController)->addActivity("Enable donations", $_GET["event_id"]);;
        /* get details of an event */
        $event = (new Events)->getDetails($_GET["event_id"]);
        /* calling disable donaion function */
        (new Donations)->enableDonation($_GET["event_id"]);
        /* sending notifications when donations are enabled */
        (new VolunteerController)->sendNotificationstoVolunteers("{$event['event_name']} event accepts donations now.You can donate..!", "/Event/view?page=about&event_id={$_GET['event_id']}", $_GET["event_id"], "donationEnabledMail", ["event_name" => $event['event_name']], "Donations for " . $event['event_name'] . " have been enabled.");
        /*redirect to event page after enabling donation.*/
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);
    }


    public function updateDonationCapacity()
    { /*update donation capacity*/

        /*checking whether all the required data comes from the form */
        Controller::validateForm(["donation_capacity"], ["url", "event_id"]);
        /*check whether organization or treasurer accessed it.*/
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);
        /* Activity log will be updated after donation capacity is updated */
        (new UserController)->addActivity("Update donation capacity", $_GET["event_id"]);
        /* calling update donation capacity function */
        (new Donations)->updateDonationCapacity($_GET["event_id"], $_POST["donation_capacity"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "donations"]);/*redirect to event page after updating donation capacity.*/
    }

    public function donationReport()/*Generate the report of all the donations*/
    {
        /*checking whether all the required data comes from the form */
        Controller::validateForm([], ["url", "event_id"]);
        /*check whether organization or treasurer accessed it.*/
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);
        $donation = new Donations;

        /* get donation details to data array */
        $data["donations"] = $donation->donationReportGenerate($_GET["event_id"], isset($_POST["date"]) ? $_POST["date"] : -1);
        /* get selected date from drop down bar */
        $data["selected_date"] = isset($_POST["date"]) ? $_POST["date"] : -1;
        /* send the donation details to javascript jfunction for donation graph */
        $data["donations_graph"] = json_encode($donation->getReport(["event_id" => $_GET["event_id"]]));
        /* send donation sum */
        $data["donation_sum"] = $donation->getDonationSum($_GET["event_id"]);
        /* send event details */
        $event_details = (new Events)->getDetails($_GET["event_id"]);
        /* converting date format*/
        $time = (int)shell_exec("date '+%s'");
        /* get the event start date */
        $start_date = $event_details["start_date"];
        /* get the dates of the donations into dates array */
        $dates = array_column(json_decode($data["donations_graph"]),"day");
        /* get the earliest of the dates array */
        $min =min($dates);
        /*check whether earliest donating date is later than the starting date of the event*/
        if(sizeof($dates)==0 || $min>$start_date){
            /* if then the first date would be starting date of the event*/
            $first_date = $event_details["start_date"];
        } else{
            /* else the first date would be first donated day*/
            $first_date = $min;
        }
        /* send all the donation details to data array*/
        $data["donations"] = $donation->donationReportGenerate($_GET["event_id"], isset($_POST["date"]) ? $_POST["date"] : -1);
        $end_date = gmdate("Y-m-d", $time) < $event_details["end_date"] && $time != 0 ? gmdate("Y-m-d", $time) : $event_details["end_date"];
        //$end_date = $event_details["end_date"];
        /* get event name in to data array */
        $data["event_name"]  = $event_details["event_name"];
        $period = new DatePeriod(
            new DateTime($first_date),
            new DateInterval('P1D'),
            new DateTime($end_date)
        );

        foreach ($period as $date) {
            $data["period"][] = $date->format('Y-m-d');
        }

        /*send all the data to donationsReport page*/
        View::render('donationsReport', $data);
    }

    public function donationCredit($event_id)
    {/*change the status in database when donations are credited to organizations account*/

        /*check whether organization or treasurer accessed it.*/
        Controller::accessCheck(["treasurer", "organization"], $_GET["event_id"]);
        /* call add activity function in usercontroller*/
        (new UserController)->addActivity("Update donation status as credited", $_GET["event_id"]);
        $donation = new Donations;
        $donation->donationCredit($event_id);
        /* call add donationCredit function in donation model*/
        $donation->donationCredit($event_id);
    }

    public function pay()
    {
        /*checking whether all the required data comes from the form */
        Controller::validateForm(["amount", "terms"], ["url"]);
        /*check whether registered user accessed it.*/
        Controller::accessCheck(["registered_user"]);

        $validate = new Validation;
        /*find whether amount is valid*/
        if (!$validate->currency($_POST["amount"]))
            Controller::redirect("/Event/view?page=about&&event_id=" . $_POST["event_id"], ["amountErr" => "Inavlid amount"]);
        
        /* require the stripe library*/    
        require __DIR__ . "/../Libararies/stripe-php-master/init.php";

        /* setting the API key*/
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
        /*checking whether all the required data comes from the form */
        Controller::validateForm([], ["event_id", "session_id"]);
        /*check whether registered user accessed it.*/
        Controller::accessCheck(["registered_user"]);

        /* require the stripe library*/    
        require __DIR__ . "/../Libararies/stripe-php-master/init.php";

        /* setting the API key*/
        \Stripe\Stripe::setApiKey('sk_test_51JdYJ6JhZDUPzRAXbJg3k221yQ9pgNLhCFYz2ifKf6FPXszolkCJdx6N4tvg5CBvz5bSOVw3OnBZnAV7WFYnR2Ne00yji9wY0R');

        /*calling the retrieve function with the session id*/
        $session = \Stripe\Checkout\Session::retrieve($_GET["session_id"]);

        /* call the addActivity function usercontroller when donation is accepted*/
        (new UserController)->addActivity("Donated " . substr($session["amount_total"], 0, -2), $_GET["event_id"]);

        /* Call the donationAccept function in donation model*/
        (new Donations)->donationAccept($_SESSION["user"]["uid"], $_GET["event_id"], substr($session["amount_total"], 0, -2), $session["payment_intent"]);

        Controller::redirect("/Event/view", ["page" => "about", "event_id" => $_GET["event_id"]]);
    }

    public function donationRefund($event_id)
    {/*change the status in database when donations are refunded*/

        /*check whether organization or admin accessed it.*/
        Controller::accessCheck(["admin", "organization"]);
        $donation = new Donations;
        /* get the refund details to donation_dtails variable */
        $donation_details = $donation->getRefundDetails($event_id);
        /* get event details */
        $data = (new Events)->getDetails($event_id);
        /* call donationRefund function in donation model*/
        $donation->donationRefund($event_id);
        foreach ($donation_details as $donation_data) {
            /* call sendNotification function in usercontroller when event is removed & donation is refunded*/
            (new UserController)->sendNotifications("{$data['event_name']} event has been removed. We refunded your donations.", $donation_data["uid"], "event", "window.location.href= '' ", $event_id, "donationRefundMail", ["event_name" => $data['event_name']], "Donation refunded.");
            /*call refund function*/
            $this->refund($donation_data["intent_id"]);
        }
    }

    public function refund($intent_id)
    {
        /* require the stripe library*/  
        require __DIR__ . "/../Libararies/stripe-php-master/init.php";
        /* setting the API key*/
        \Stripe\Stripe::setApiKey('sk_test_51JdYJ6JhZDUPzRAXbJg3k221yQ9pgNLhCFYz2ifKf6FPXszolkCJdx6N4tvg5CBvz5bSOVw3OnBZnAV7WFYnR2Ne00yji9wY0R');
        \Stripe\Refund::create([
            'payment_intent' => $intent_id,
        ]);
    }
}
