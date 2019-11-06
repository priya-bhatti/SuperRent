<?php include_once 'config/init.php'; ?>

<?php
$vehicle = new Vehicle;
$template = new Template('templates/frontpage.php');

$type = isset($_GET['type']) ? $_GET['type'] : null;
$loc = isset($_GET['branch']) ? $_GET['branch'] : null;
$time = isset($_GET['fromdate'], $_GET['fromtime'], $_GET['todate'], $_GET['totime'])
             ? array($_GET['fromdate'], $_GET['fromtime'], $_GET['todate'], $_GET['totime']) : null;

if($type){
    $template->vehicles = $vehicle->getVType($type);
 }

//  if($loc){
//     $loc_arr = explode("#", $loc);
//     $template->vehicles = $vehicle->getVTypesByLoc($loc_arr[0], $loc_arr[1]);
//  }

//  if($time){
//     $template->vehicles = $vehicle->getVTypesByTime($time[0], $time[1], $time[2], $time[3]);
//  }

//  if($type && $loc){
//     $loc_arr = explode("#", $loc);
//     $template->vehicles = $vehicle->getVTypeByTypeLoc($type, $loc_arr[0], $loc_arr[1]);
//  }

//  if($type && $time){
//     $template->vehicles = $vehicle->getVTypeByTypeTime($type, $time[0], $time[1], $time[2], $time[3]);
//  }

//  if($loc && $time){
//     $loc_arr = explode("#", $loc);
//     $template->vehicles = $vehicle->getVTypesLocTime($loc_arr[0], $loc_arr[1], $time[0], $time[1], $time[2], $time[3]);
//  }

//  if($type && $loc && $time){
//     $loc_arr = explode("#", $loc);
//     $template->vehicles = $vehicle->getVTypeByTypeLocTime($loc_arr[0], $loc_arr[1], $time[0], $time[1], $time[2], $time[3]);
//  }

$template->types = $vehicle->getTypes();
$template->branches = $vehicle->getBranches();

echo $template;