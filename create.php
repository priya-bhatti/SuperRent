<?php include_once 'config/init.php'; ?>
<?php
$vehicle = new Vehicle;

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

    if($vehicle->create($data)){
        redirect('index.php', 'Your vehicle has been listed', 'success');
    } else {
        redirect('index.php', 'Something went wrong', 'error');

    }
}
$template = new Template('templates/vehicle-create.php');

$template->categories = $vehicle->getCategories();

echo $template;