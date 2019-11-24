<?php include_once 'config/init.php'; ?>
<?php
$vehicle = new Vehicle;

$template = new Template('templates/vehicle-detail.php');

$type = isset($_GET['vtname']) ? $_GET['vtname'] : null;
$loc = isset($_GET['location']) ? $_GET['location'] : null;
$city = isset($_GET['city']) ? $_GET['city'] : null;
$fd = isset($_GET['fromdate']) ? $_GET['fromdate'] : null;
$ft = isset($_GET['fromtime']) ? $_GET['fromtime'] : null;
$td = isset($_GET['todate']) ? $_GET['todate'] : null;
$tt = isset($_GET['totime']) ? $_GET['totime'] : null;

if($type && $loc && $city && $fd && $ft && $td && $tt) {
    $can_reserve = true;
    $url = "vtname=".$type."&location=".$loc."&city=".$city."&fromdate=".$fd."&fromtime=".$ft."&todate=".$td."&totime=".$tt;
} else {
    $can_reserve = false;
}

$template->can_reserve = $can_reserve;
$template->url = $url;
$template->vehicle = $vehicle->getVehicleDetail($type);
$template->vehicles = $vehicle->getAllVehicles($type);

echo $template;
