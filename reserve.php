<?php include_once 'config/init.php'; ?>
<?php
$reservation = new Vehicle;

$template = new Template('templates/reservation.php');

// vehicle info
$type = isset($_GET['vtname']) ? $_GET['vtname'] : null;
$loc = isset($_GET['location']) ? $_GET['location'] : null;
$city = isset($_GET['city']) ? $_GET['city'] : null;
$fd = isset($_GET['fromdate']) ? $_GET['fromdate'] : null;
$ft = isset($_GET['fromtime']) ? $_GET['fromtime'] : null;
$td = isset($_GET['todate']) ? $_GET['todate'] : null;
$tt = isset($_GET['totime']) ? $_GET['totime'] : null;

if(!empty($type)){
    $template->vehicle = array($type, $loc, $city, $fd, $ft, $td, $tt);
} else {
    $template->vehicle = array($_POST['vtname'], $_POST['location'], $_POST['city'], $_POST['fromdate'], $_POST['fromtime'], $_POST['todate'], $_POST['totime']);
}
// customer info
$dlicense = isset($_GET['dlicense']) ? $_GET['dlicense'] : null;

if (!empty($dlicense)){
    $template->customer = $reservation->getCustomer($dlicense);
}

if(isset($_POST['submit'])){
    //create data array
    $data = array();
    $data['vtname'] = $_POST['vtname'];
    $data['dlicense'] = $_POST['dlicense'];
    $data['fromDate'] = $_POST['fromdate'];
    $data['fromTime'] = $_POST['fromtime'];
    $data['toDate'] = $_POST['todate'];
    $data['toTime'] = $_POST['totime'];

    if($reservation->insertReservation($data)){
        $template->confirmation = $reservation->getReservation($_POST['vtname'], $_POST['dlicense'], $_POST['fromdate'], $_POST['fromtime'], $_POST['todate'], $_POST['totime']);
    } 
}

if(isset($_POST['addCustomer'])){
    $data = array();
    $data['cellphone'] = $_POST['cellphone'];
    $data['cname'] = $_POST['cname'];
    $data['caddress'] = $_POST['caddress'];
    $data['dlicense'] = $_POST['dlicense'];
    $data['vtname'] = $_POST['vtname'];
    $data['dlicense'] = $_POST['dlicense'];
    $data['fromDate'] = $_POST['fromdate'];
    $data['fromTime'] = $_POST['fromtime'];
    $data['toDate'] = $_POST['todate'];
    $data['toTime'] = $_POST['totime'];

    if($reservation->insertCustomer($data)){
        $template->message = 'You have been added as a customer';
    } else {
        $template->message = 'Oops something wrong';
    }
}

echo $template;
