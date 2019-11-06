<?php include_once 'config/init.php'; ?>
<?php
$vehicle = new Vehicle;

$vehicle_id = isset($_GET['id']) ? $_GET['id'] : null;

if(isset($_POST['submit'])){
    //create data array
    $data = array();
    $data['vehicle_title'] = $_POST['vehicle_title'];
    $data['company'] = $_POST['company'];
    $data['category_id'] = $_POST['category'];
    $data['description'] = $_POST['description'];
    $data['location'] = $_POST['location'];
    $data['salary'] = $_POST['salary'];
    $data['contact_user'] = $_POST['contact_user'];

    if($vehicle->update($vehicle_id, $data)){
        redirect('index.php', 'Your vehicle has been updated', 'success');
    } else {
        redirect('index.php', 'Something went wrong', 'error');

    }
}
$template = new Template('templates/vehicle-edit.php');

$template->vehicle = $vehicle->getVehicle($vehicle_id);

$template->categories = $vehicle->getCategories();

echo $template;