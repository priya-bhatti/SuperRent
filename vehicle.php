<?php include_once 'config/init.php'; ?>
<?php
$vehicle = new Vehicle;

$template = new Template('templates/vehicle-detail.php');

$vehicle_id = isset($_GET['vtname']) ? $_GET['vtname'] : null;

//$template->vehicle = $vehicle->getVehicle($vehicle_id);
//$template->vehicles = $vehicle->getAllVehicles();

echo $template;