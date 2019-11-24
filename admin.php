<?php include_once 'config/init.php'; ?>
<?php
$tables = new Vehicle;

$template = new Template('templates/adminpage.php');

//create a rental
//if the customer has a reservation
if(isset($_POST['rent'])){
    $data = array();
    $data['confno'] = $_POST['confno'];
    $template->postConf = true;

    if($tables->insertRental($data)){
        $template->receiptRent = $tables->getRentalConf($_POST['confno']);
        $template->message = '';
    } else {
        $template->searchRes = false;
        $template->message = '';
    }
}
//if customer does not have reservation
if(isset($_POST['rentnew'])){
    //create data array
    $data = array();
    $data['vtname'] = $_POST['vtname'];
    $data['dlicense'] = $_POST['dlicense'];
    $data['fromDate'] = $_POST['fromdate'];
    $data['fromTime'] = $_POST['fromtime'];
    $data['toDate'] = $_POST['todate'];
    $data['toTime'] = $_POST['totime'];

    if($_POST['vtname'] == '0' || $_POST['dlicense'] == '0' || empty($_POST['fromdate']) || empty($_POST['fromtime']) || empty($_POST['todate']) || empty($_POST['totime'])){
        $template->resmessage = 'Must Enter All Fields';
    } else {
        if($tables->insertReservation($data)){
            if($tables->insertRentalRes($data)){
                $template->receiptResRent = $tables->getRentalConfRes($_POST['dlicense'], $_POST['fromdate'], $_POST['todate']);
                $template->resmessage = '';
            }
        } 

    }


}

//return vehicle
if(isset($_POST['return'])){
    //create data array
    $data = array();
    $data['rid'] = $_POST['rid'];
    $data['dater'] = $_POST['dater'];
    $data['timer'] = $_POST['timer'];
    $data['odometer'] = $_POST['odometer'];
    $data['fulltank'] = $_POST['fulltank'];

    if($_POST['rid'] == '0' || empty($_POST['dater']) || empty($_POST['timer']) || empty($_POST['odometer']) || empty($_POST['fulltank'])){
        $template->returnmessage = 'Must Enter All Fields';
    } else {

        if($tables->insertReturn($data)){
            $template->receiptReturn = $tables->getReturnConf($_POST['rid']);
            $template->returnmessage = '';
        }
    }


}

//insert Branch
if(isset($_POST['insertBranch'])){
    //create data array
    $data = array();
    $data['location'] = $_POST['location'];
    $data['city'] = $_POST['city'];

    if(empty($_POST['location']) || empty($_POST['city'])){
        $template->branchmessage = 'Must Enter All Fields';
    } else {
        if($tables->insertBranch($data)){
            $template->branchmessage = '';
        }else{
            $template->branchmessage = 'Invalid Inputs';
        }
    }
}

//insert vehicle
if(isset($_POST['insertveh'])){
    $data = array();
    $data['vlicense'] = $_POST['vlicense'];
    $data['make'] = $_POST['make'];
    $data['model'] = $_POST['model'];
    $data['year'] = $_POST['year'];
    $data['color'] = $_POST['color'];
    $data['odometer'] = $_POST['odometer'];
    $data['status'] = $_POST['status'];
    $data['vtname'] = $_POST['vtname'];
    $data['branch'] = $_POST['branch'];

    if(empty($_POST['vlicense']) || empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['color']) ||
        empty($_POST['odometer']) || $_POST['status'] == '0' || $_POST['vtname'] == '0' || $_POST['branch'] == '0'){
        $template->insertvmessage = 'Must Enter All Fields';
    } else {
        $loc = $_POST['branch'];
        $loc_arr = explode("#", $loc);
        $data['location'] = $loc_arr[0];
        $data['city'] = $loc_arr[1];
        if($tables->insertVehicle($data)){
            $template->insertvmessage = '';
        }else{
            $template->insertvmessage = 'Invalid Inputs';
        }
    }
}

//insert vehicle type
if(isset($_POST['insertvt'])){
    //create data array
    $data = array();
    $data['vtname'] = $_POST['vtname'];
    $data['features'] = $_POST['features'];
    $data['wrate'] = $_POST['wrate'];
    $data['drate'] = $_POST['drate'];
    $data['hrate'] = $_POST['hrate'];
    $data['wirate'] = $_POST['wirate'];
    $data['dirate'] = $_POST['dirate'];
    $data['hirate'] = $_POST['hirate'];
    $data['krate'] = $_POST['krate'];

    if(empty($_POST['vtname']) || empty($_POST['features']) || empty($_POST['wrate']) || empty($_POST['drate']) || empty($_POST['hrate']) ||
        empty($_POST['wirate']) || empty($_POST['dirate']) || empty($_POST['hirate']) || empty($_POST['krate'])){
        $template->vtmessage = 'Must Enter All Fields';
    } else {
        if($tables->insertVehicleType($data)){
            $template->vtmessage = '';
        }else{
            $template->vtmessage = 'Invalid Inputs';
        }
    }
}

// deletes
//reservation
if(isset($_POST['deleteReservation'])){
    if($_POST['confo'] == '0'){
        $template->resDelMessage = 'Must Select A Confno';
    } else {
        if($tables->deleteReservation($_POST['confo'])){
            $template->resDelMessage = ' ';
        }
    }
}

//rentals
if(isset($_POST['deleteRental'])){
    if($_POST['rid'] == '0'){
        $template->rentDelMessage = 'Must Select RID';
    } else {
        if($tables->deleteRental($_POST['rid'])){
            $template->rentDelMessage = ' ';
        }
    }
}

//returns
if(isset($_POST['deleteReturn'])){
    if($_POST['rid'] == '0'){
        $template->rentDelMessage = 'Must Select RID';
    } else {
        if($tables->deleteReturn($_POST['rid'])){
            $template->retDelMessage = ' ';
        }
    }
}

//customers
if(isset($_POST['deleteCustomer'])){
    if($_POST['dlicense'] == '0'){
        $template->cusDelMessage = 'Must Select dlicense';
    } else {
        if($tables->deleteCustomer($_POST['dlicense'])){
            $template->cusDelMessage = ' ';
        }
    }
}

//branches
if(isset($_POST['deleteBranch'])){
    if($_POST['branch'] == '0'){
        $template->brDelMessage = 'Must Select Branch';
    } else {
        $loc = $_POST['branch'];
        $loc_arr = explode("#", $loc);
        if($tables->deleteBranch($loc_arr[0],$loc_arr[1])){
            $template->brDelMessage = ' ';
        }
    }
}

//vehicle
if(isset($_POST['deleteVehicle'])){
    if($_POST['vlicense'] == '0'){
        $template->vehDelMessage = 'Must Select Vehicle';
    } else {
        if($tables->deleteVehicle($_POST['vlicense'])){
            $template->vehDelMessage = ' ';
        }
    }
}

//vehicle type
if(isset($_POST['deleteVehicleType'])){
    if($_POST['vtname'] == '0'){
        $template->vehtDelMessage = 'Must Select Vehicle Type';
    } else {
        if($tables->deleteVehicleType($_POST['vtname'])){
            $template->vehtDelMessage = ' ';
        }
    }
}

//update reservation
if(isset($_GET['confoUpdate'])){
    if($_GET['confoUpdate'] == '0'){
        $template->updateRes = false;
    } else {
        $template->updateRes = true;
        $template->singleres = $tables->getSingleReservation($_GET['confoUpdate']);
    }
}

if(isset($_POST['updateReserv'])){
    //create data array
    $data = array();
    $data['confno'] = $_POST['confno'];
    $data['vtname'] = $_POST['vtname'];
    $data['dlicense'] = $_POST['dlicense'];
    $data['fromDate'] = $_POST['fromdate'];
    $data['fromTime'] = $_POST['fromtime'];
    $data['toDate'] = $_POST['todate'];
    $data['toTime'] = $_POST['totime'];

    if(empty($_POST['fromdate']) || empty($_POST['fromtime']) || empty($_POST['todate']) || empty($_POST['totime'])){
        $template->upresmessage = 'Must Enter All Fields';
    } else {
        if($tables->updateReservation($data)){
                $template->upresmessage = '';
        } else {
            $template->upresmessage = 'Invalid Input';
        }
    }
}

//dropdowns
$template->rentalsdd = $tables->getRentalsDropdown();
$template->reservedd = $tables->getVtypesDropDown();

//delete dropdowns
$template->delRes = $tables->getDelReservations();
$template->delRent = $tables->getDelRentals();
$template->delCust = $tables->getDelCustomers();
$template->delBranch = $tables->getDelBranches();
$template->delVeh = $tables->getDelVehicles();
$template->delTypes = $tables->getDelTypes();

//all tables in db
//reservation
$template->reservations = $tables->getAllReservations();

//rentals
$template->rentals = $tables->getAllRentals();

//returns
$template->returns = $tables->getAllReturns();

//customers
$template->customers = $tables->getAllCustomers();

//branches
$template->branches = $tables->getBranches();

//vehicles
$template->vehicles = $tables->getAllVehicle();

//vehicle types
$template->vehicletypes = $tables->getTypes();

//daily rentals
$template->dailyrentals = $tables->getAllDailyRentals();

//daily returns
$template->dailyreturns = $tables->getAllDailyReturns();

//branch rentals and returns
$loc = isset($_GET['branch']) ? $_GET['branch'] : null;
if($loc && $loc !== '0'){
    $loc_arr = explode("#", $loc);
    $template->branchrentals = $tables->getAllBranchRentals($loc_arr[0], $loc_arr[1]);
    $template->branchreturns = $tables->getAllBranchReturns($loc_arr[0], $loc_arr[1]);
 }


echo $template;
