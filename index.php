<?php include_once 'config/init.php'; ?>

<?php
$vehicle = new Vehicle;
$template = new Template('templates/frontpage.php');

$type = isset($_GET['type']) ? $_GET['type'] : null;
$loc = isset($_GET['branch']) ? $_GET['branch'] : null;
$time = isset($_GET['fromdate'], $_GET['fromtime'], $_GET['todate'], $_GET['totime'])
             ? array($_GET['fromdate'], $_GET['fromtime'], $_GET['todate'], $_GET['totime']) : null;

// only cartype
if($type !== '0' && $loc == '0' && empty($_GET['fromdate']) && empty($_GET['todate'])){
    $template->vehicles = $vehicle->getVType($type);
    $url = "";
 }

// only location
 if($loc !== '0' && $type == '0' && empty($_GET['fromdate']) && empty($_GET['todate'])){
    $loc_arr = explode("#", $loc);
    $template->vehicles = $vehicle->getVTypesByLoc($loc_arr[0], $loc_arr[1]);
    $url = "&location=".$loc_arr[0]."&city=".$loc_arr[1];
 }

// only time interval
 if($loc == '0' && $type == '0' && !empty($_GET['fromdate']) && !empty($_GET['todate'])){
    $template->vehicles = $vehicle->getVTypesByTime($time[0], $time[1], $time[2], $time[3]);
    $url = "&fromdate=".$time[0]."&fromtime=".$time[1]."&todate=".$time[2]."&totime=".$time[3];
 }

// type and location
 if($loc !== '0' && $type !== '0' && empty($_GET['fromdate']) && empty($_GET['todate'])){
    $loc_arr = explode("#", $loc);
    $template->vehicles = $vehicle->getVTypeByTypeLoc($type, $loc_arr[0], $loc_arr[1]);
    $url = "&location=".$loc_arr[0]."&city=".$loc_arr[1];
 }

// type and time
 if($type !== '0' && $loc == '0' && !empty($_GET['fromdate']) && !empty($_GET['todate'])){
    $template->vehicles = $vehicle->getVTypeByTypeTime($type, $time[0], $time[1], $time[2], $time[3]);
    $url = "&fromdate=".$time[0]."&fromtime=".$time[1]."&todate=".$time[2]."&totime=".$time[3];
 }

// location and time
 if($type == '0' && $loc !== '0' && !empty($_GET['fromdate']) && !empty($_GET['todate'])){
    $loc_arr = explode("#", $loc);
    $template->vehicles = $vehicle->getVTypesLocTime($loc_arr[0], $loc_arr[1], $time[0], $time[1], $time[2], $time[3]);
    $url = "&location=".$loc_arr[0]."&city=".$loc_arr[1]."&fromdate=".$time[0]."&fromtime=".$time[1]."&todate=".$time[2]."&totime=".$time[3];
 }

//all 3
 if($type !== '0' && $loc !== '0' && !empty($_GET['fromdate']) && !empty($_GET['todate'])){
    $loc_arr = explode("#", $loc);
    $template->vehicles = $vehicle->getVTypeByTypeLocTime($type, $loc_arr[0], $loc_arr[1], $time[0], $time[1], $time[2], $time[3]);
    $url = "&location=".$loc_arr[0]."&city=".$loc_arr[1]."&fromdate=".$time[0]."&fromtime=".$time[1]."&todate=".$time[2]."&totime=".$time[3];
 }

// none selected
 if($type == '0' && $loc == '0' && empty($_GET['fromdate']) && empty($_GET['todate'])){
    $template->vehicles = $vehicle->getAll();
    $url = "";
 }

$template->types = $vehicle->getTypes();
$template->branches = $vehicle->getBranches();
$template->url = $url;
echo $template;
