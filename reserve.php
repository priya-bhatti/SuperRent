<?php include_once 'config/init.php'; ?>
<?php
$vehicle = new Vehicle;

$template = new Template('templates/reservation.php');

$vehicle_id = isset($_GET['id']) ? $_GET['id'] : null;

$template->vehicle = $vehicle->getVehicle($vehicle_id);

echo $template;