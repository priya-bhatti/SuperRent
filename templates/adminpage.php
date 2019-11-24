<!DOCTYPE html>
<html>
<head>
    <title>SuperRent</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0">SuperRent</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="index.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Clerk</span>
          <a class="d-flex align-items-center text-muted" href="#">
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#rentv">
              Rent a Vehicle
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#returnv">
              Return a Vehicle
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Data</span>
          <a class="d-flex align-items-center text-muted" href="#">
          </a>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="#reservations">
              Reservations <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#rentals">
              Rentals
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#returns">
              Returns
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#customers">
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#branches">
              Branches
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#vehicles">
              Vehicles
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#vehicletypes">
              Vehicle Types
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Reports</span>
          <a class="d-flex align-items-center text-muted" href="#">
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#dailyrentals">
              Daily Rentals
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#branchrentals">
              Branch Rentals
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#dailyreturns">
              Daily Returns
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#branchreturns">
              Branch Returns
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div style="padding-top: 65px;" id="rentv">
      <h2>Rent a Vehicle</h2>
      <form method="post" action="admin.php">
        <div class="form-group">
          <label>Confirmation #: </label>
          <input type="number" class="form-control" name="confno">
        </div>
        <input type="submit" style="margin-top:20px;" class="btn btn-lg btn-success" value="Submit" name="rent">
      </form>
      <?php if($receiptRent): ?>
        <h2>Your Rental Receipt:</h2>
        <h3><?php echo 'Rental ID: '. $receiptRent->rid; ?> </h3>
        <h3><?php echo 'License Plate: '. $receiptRent->vlicense; ?> </h3>
        <h3><?php echo 'Confirmation #: '. $receiptRent->confno; ?> </h3>
        <h3><?php echo 'Drivers License: '. $receiptRent->dlicense; ?> </h3>
        <h3><?php echo 'Pick-Up Date: '. $receiptRent->fromdate; ?> </h3>
        <h3><?php echo 'Pick-Up Time: '. $receiptRent->fromtime; ?> </h3>
        <h3><?php echo 'Return Date: '. $receiptRent->todate; ?> </h3>
        <h3><?php echo 'Return Time: '. $receiptRent->totime; ?> </h3>
        <h3><?php echo 'Odometer: '. $receiptRent->odometer; ?> </h3>
      <?php endif; ?>
      <?php if($postConf && !$searchRes && !$receiptRent): ?>
        <h2>Reservation Not Found, Please Enter Information Below:</h2>
        <form method="post" action="admin.php">
        <div class="form-group">
        <label>Vehicle Type</label>
        <select name="vtname" class="form-control">
          <option value="0">Select From Available Vehicles (if empty then no available vehicles)</option>
          <?php foreach($reservedd as $vtype): ?>
            <option value="<?php echo $vtype->vtname; ?>">
            <?php echo $vtype->vtname?></option>
          <?php endforeach; ?>
        </select>
        </div>
        <div class="form-group">
        <label>Drivers License</label>
        <select name="dlicense" class="form-control">
          <option value="0">Select A Drivers License</option>
          <?php foreach($customers as $cust): ?>
            <option value="<?php echo $cust->dlicense; ?>">
            <?php echo $cust->dlicense?></option>
          <?php endforeach; ?>
        </select>
        </div>
        <div class="form-group">
        <label>Pick-Up Date</label>
        <input type="text" class="form-control" name="fromdate" placeholder="YYYY-MM-DD">
        </div>
        <div class="form-group">
        <label>Pick-Up Time</label>
        <input type="text" class="form-control" name="fromtime" placeholder="00:00:00">
        </div>
        <div class="form-group">
        <label>Return Date</label>
        <input type="text" class="form-control" name="todate" placeholder="YYYY-MM-DD">
        </div>
        <div class="form-group">
        <label>Return Time</label>
        <input type="text" class="form-control" name="totime" placeholder="00:00:00">
        </div>
        <input type="submit" style="margin-top:20px;" class="btn btn-lg btn-success" value="Submit" name="rentnew">
        </form>
      <?php endif; ?>
      <?php if($receiptResRent): ?>
        <h2>Your Rental Receipt:</h2>
        <h3><?php echo 'Rental ID: '. $receiptResRent->rid; ?> </h3>
        <h3><?php echo 'License Plate: '. $receiptResRent->vlicense; ?> </h3>
        <h3><?php echo 'Confirmation #: '. $receiptResRent->confno; ?> </h3>
        <h3><?php echo 'Drivers License: '. $receiptResRent->dlicense; ?> </h3>
        <h3><?php echo 'Pick-Up Date: '. $receiptResRent->fromdate; ?> </h3>
        <h3><?php echo 'Pick-Up Time: '. $receiptResRent->fromtime; ?> </h3>
        <h3><?php echo 'Return Date: '. $receiptResRent->todate; ?> </h3>
        <h3><?php echo 'Return Time: '. $receiptResRent->totime; ?> </h3>
        <h3><?php echo 'Odometer: '. $receiptResRent->odometer; ?> </h3>
      <?php endif; ?>
      <?php if($resmessage): ?>
        <h3 style="color:red;"><?php echo $resmessage; ?> </h3>
      <?php endif; ?>       
    </div>

      <div style="padding-top: 65px;" id="returnv">
      <h2>Return a Vehicle</h2>
        <form method="post" action="admin.php">
        <div class="form-group">
        <label>Rental ID</label>
        <select name="rid" class="form-control">
          <option value="0">Select A Rental Id (if empty then all vehicles are returned)</option>
          <?php foreach($rentalsdd as $rentdd): ?>
            <option value="<?php echo $rentdd->rid; ?>">
            <?php echo $rentdd->rid?></option>
          <?php endforeach; ?>
        </select>
        </div>
        <div class="form-group">
        <label>Return Date</label>
        <input type="text" class="form-control" name="dater" placeholder="YYYY-MM-DD">
        </div>
        <div class="form-group">
        <label>Return Time</label>
        <input type="text" class="form-control" name="timer" placeholder="00:00:00">
        </div>
        <div class="form-group">
        <label>Odometer</label>
        <input type="number" class="form-control" name="odometer">
        </div>
        <div class="form-group">
        <label>Tank Full? (yes or no)</label>
        <input type="text" class="form-control" name="fulltank">
        </div>
        <input type="submit" style="margin-top:20px;" class="btn btn-lg btn-success" value="Submit" name="return">
        </form>
      <?php if($receiptReturn): ?>
        <h2>Your Return Receipt:</h2>
        <h3><?php echo 'Confirmation #: '. $receiptReturn->confno; ?> </h3>
        <h3><?php echo 'Return Date: '. $receiptReturn->return_date; ?> </h3>
        <h3><?php echo 'Return Time: '. $receiptReturn->retunr_time; ?> </h3>
        <h3><?php echo 'Week Interval: '. $receiptReturn->winterval; ?> </h3>
        <h3><?php echo 'Week Rate: '. $receiptReturn->weekrate; ?> </h3>
        <h3><?php echo 'Week Insurance: '. $receiptReturn->weekinsur; ?> </h3>
        <h3><?php echo 'Day Interval: '. $receiptReturn->dinterval; ?> </h3>
        <h3><?php echo 'Day Rate: '. $receiptReturn->dayrate; ?> </h3>
        <h3><?php echo 'Day Insurance: '. $receiptReturn->dayinsur; ?> </h3>
        <h3><?php echo 'Odometer Difference: '. $receiptReturn->ododiff; ?> </h3>
        <h3><?php echo 'Odometer Rate: '. $receiptReturn->odorate; ?> </h3>
        <h3><?php echo 'Total $: '. $receiptReturn->total; ?> </h3>
      <?php endif; ?>
      <?php if($returnmessage): ?>
        <h3 style="color:red;"><?php echo $returnmessage; ?> </h3>
      <?php endif; ?> 
      </div>

      <div style="padding-top: 65px;" id="reservations">
      <h2>Reservations</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ConfNo</th>
              <th>Vtname</th>
              <th>Drivers License</th>
              <th>fromDate</th>
              <th>fromTime</th>
              <th>toDate</th>
              <th>toTime</th>
            </tr>
          </thead>
          <tbody>
          <?php if($reservations): ?>
            <?php foreach($reservations as $res): ?>
                <tr>
                    <td><?php echo $res->confno; ?></td>
                    <td><?php echo $res->vtname; ?></td>
                    <td><?php echo $res->dlicense; ?></td>
                    <td><?php echo $res->fromdate; ?></td>
                    <td><?php echo $res->fromtime; ?></td>
                    <td><?php echo $res->todate; ?></td>
                    <td><?php echo $res->totime; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <form method="post" action="admin.php">
        <label>Delete a Reservation. If desired option not available the record must be deleted from the Rent table first.</label>
        <div class="row">
          <div class="col-sm-1">
            <input type="submit" class="btn btn-md btn-danger" value="DELETE" name="deleteReservation">
          </div>
          <div class="col-sm-11">
            <div class="form-group">
              <select name="confo" class="form-control">
                <option value="0">Select A Confno</option>
                <?php foreach($delRes as $delr): ?>
                <option value="<?php echo $delr->confno; ?>">
                <?php echo $delr->confno?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        </form>
        <?php if($resDelMessage): ?>
        <h3 style="color:red;"><?php echo $resDelMessage; ?> </h3>
      <?php endif; ?>
      <form method="GET" action="admin.php">
        <label>Update a Reservation. </label>
        <div class="row">
          <div class="col-sm-11">
            <div class="form-group">
              <select name="confoUpdate" class="form-control">
                <option value="0">Select A Confno</option>
                <?php foreach($reservations as $resUp): ?>
                <option value="<?php echo $resUp->confno; ?>">
                <?php echo $resUp->confno?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-sm-1">
              <input type="submit" class="btn btn-md btn-primary" value="  GO  ">
          </div>
        </div>
        </form>
      <?php if($updateRes): ?>
      <form method="post" action="admin.php">
        <div class="row">
          <div class="col-sm-1">
          <input type="submit" class="btn btn-md btn-primary" value="UPDATE" name="updateReserv">
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <label>Vehicle Type</label>
              <select name="vtname" class="form-control">
                <option value="<?php echo $singleres->vtname; ?>"><?php echo $singleres->vtname; ?></option>
                <?php foreach($vehicletypes as $type): ?>
                <option value="<?php echo $type->vtname; ?>"><?php echo $type->vtname; ?></option>
                <?php endforeach; ?>
              </select>
              <label>Pick-Up Date</label>
              <input type="text" class="form-control" name="fromdate" value="<?php echo $singleres->fromdate; ?>">
              <label>Return Date</label>
              <input type="text" class="form-control" name="todate" value="<?php echo $singleres->todate; ?>">
            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <label>Drivers License</label>
              <select name="dlicense" class="form-control">
                <option value="<?php echo $singleres->dlicense; ?>"><?php echo $singleres->dlicense; ?></option>
                <?php foreach($customers as $cust): ?>
                <option value="<?php echo $cust->dlicense; ?>"><?php echo $cust->dlicense; ?></option>
                <?php endforeach; ?>
              </select>
              <label>Pick-Up Time</label>
              <input type="text" class="form-control" name="fromtime" value="<?php echo $singleres->fromtime; ?>">
              <label>Return Time</label>
              <input type="text" class="form-control" name="totime" value="<?php echo $singleres->totime; ?>">
              <input type="hidden" class="form-control" name="confno" value="<?php echo $singleres->confno; ?>">
            </div>
          </div>
        </form>
      </div>
      <?php endif; ?> 
      <?php if($upresmessage): ?>
        <h3 style="color:red;"><?php echo $upresmessage; ?> </h3>
      <?php endif; ?>
      </div>

      <div style="padding-top: 65px;" id="rentals">
      <h2>Rentals</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>rid</th>
              <th>vlicense</th>
              <th>dlicense</th>
              <th>fromdate</th>
              <th>fromtime</th>
              <th>todate</th>
              <th>totime</th>
              <th>odometer</th>
              <th>confno</th>
            </tr>
          </thead>
          <tbody>
          <?php if($rentals): ?>
            <?php foreach($rentals as $rent): ?>
                <tr>
                    <td><?php echo $rent->rid; ?></td>
                    <td><?php echo $rent->vlicense; ?></td>
                    <td><?php echo $rent->dlicense; ?></td>
                    <td><?php echo $rent->fromdate; ?></td>
                    <td><?php echo $rent->fromtime; ?></td>
                    <td><?php echo $rent->todate; ?></td>
                    <td><?php echo $rent->totime; ?></td>
                    <td><?php echo $rent->odometer; ?></td>
                    <td><?php echo $rent->confno; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <form method="post" action="admin.php">
        <label>Delete a Rental. If desired option not available the record must be deleted from the Return table first.</label>
        <div class="row">
          <div class="col-sm-1">
            <input type="submit" class="btn btn-md btn-danger" value="DELETE" name="deleteRental">
          </div>
          <div class="col-sm-11">
            <div class="form-group">
              <select name="rid" class="form-control">
                <option value="0">Select A Rental ID</option>
                <?php foreach($delRent as $delre): ?>
                <option value="<?php echo $delre->rid; ?>">
                <?php echo $delre->rid?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        </form>
        <?php if($rentDelMessage): ?>
        <h3 style="color:red;"><?php echo $rentDelMessage; ?> </h3>
      <?php endif; ?> 
      </div>

      <div style="padding-top: 65px;" id="returns">
      <h2>Returns</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>rid</th>
              <th>dater</th>
              <th>timer</th>
              <th>odometer</th>
              <th>fulltank</th>
            </tr>
          </thead>
          <tbody>
          <?php if($returns): ?>
            <?php foreach($returns as $ret): ?>
                <tr>
                    <td><?php echo $ret->rid; ?></td>
                    <td><?php echo $ret->dater; ?></td>
                    <td><?php echo $ret->timer; ?></td>
                    <td><?php echo $ret->odometer; ?></td>
                    <td><?php echo $ret->fulltank; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <form method="post" action="admin.php">
        <label>Delete a Return.</label>
        <div class="row">
          <div class="col-sm-1">
            <input type="submit" class="btn btn-md btn-danger" value="DELETE" name="deleteReturn">
          </div>
          <div class="col-sm-11">
            <div class="form-group">
              <select name="rid" class="form-control">
                <option value="0">Select A Return ID</option>
                <?php foreach($returns as $delret): ?>
                <option value="<?php echo $delret->rid; ?>">
                <?php echo $delret->rid?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        </form>
        <?php if($retDelMessage): ?>
        <h3 style="color:red;"><?php echo $retDelMessage; ?> </h3>
      <?php endif; ?> 
      </div>

      <div style="padding-top: 65px;" id="customers">
      <h2>Customers</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>cellphone</th>
              <th>cname</th>
              <th>caddress</th>
              <th>dlicense</th>
            </tr>
          </thead>
          <tbody>
          <?php if($customers): ?>
            <?php foreach($customers as $cus): ?>
                <tr>
                    <td><?php echo $cus->cellphone; ?></td>
                    <td><?php echo $cus->cname; ?></td>
                    <td><?php echo $cus->caddress; ?></td>
                    <td><?php echo $cus->dlicense; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <form method="post" action="admin.php">
        <label>Delete a Customer. If desired option not available the record must be deleted from the Reservation table first</label>
        <div class="row">
          <div class="col-sm-1">
            <input type="submit" class="btn btn-md btn-danger" value="DELETE" name="deleteCustomer">
          </div>
          <div class="col-sm-11">
            <div class="form-group">
              <select name="dlicense" class="form-control">
                <option value="0">Select A Dlicense</option>
                <?php foreach($delCust as $delc): ?>
                <option value="<?php echo $delc->dlicense; ?>">
                <?php echo $delc->dlicense?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        </form>
        <?php if($cusDelMessage): ?>
        <h3 style="color:red;"><?php echo $cusDelMessage; ?> </h3>
      <?php endif; ?> 
      </div>

      <div style="padding-top: 65px;" id="branches">
      <h2>Branches</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>location</th>
              <th>city</th>
            </tr>
          </thead>
          <tbody>
          <?php if($branches): ?>
            <?php foreach($branches as $br): ?>
                <tr>
                    <td><?php echo $br->location; ?></td>
                    <td><?php echo $br->city; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <form method="post" action="admin.php">
        <label>Delete a Branch. If desired option not available the record must be deleted from the Vehicle table first</label>
        <div class="row">
          <div class="col-sm-1">
            <input type="submit" class="btn btn-md btn-danger" value="DELETE" name="deleteBranch">
          </div>
          <div class="col-sm-11">
            <div class="form-group">
            <select name="branch" class="form-control">
              <option value="0">Choose a Location</option>
              <?php foreach($delBranch as $branch): ?>
              <option value="<?php echo $branch->location; ?>#<?php echo $branch->city; ?>">
              <?php echo $branch->location. ', ' . $branch->city ?></option>
              <?php endforeach; ?>
           </select>
            </div>
          </div>
        </div>
        </form>
        <?php if($brDelMessage): ?>
        <h3 style="color:red;"><?php echo $brDelMessage; ?> </h3>
      <?php endif; ?>
      <form method="post" action="admin.php">
      <label>Insert A Branch. </label>
        <div class="row">
          <div class="col-sm-1">
          <input type="submit" class="btn btn-md btn-success" value="INSERT" name="insertBranch">
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <label>Location</label>
              <input type="text" class="form-control" name="location">
            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control" name="city">
            </div>
          </div>
        </form>
        <?php if($branchmessage): ?>
        <h3 style="color:red;"><?php echo $branchmessage; ?> </h3>
      <?php endif; ?>
      </div>

      <div style="padding-top: 65px;" id="vehicles">
      <h2>Vehicles</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>vlicense</th>
              <th>make</th>
              <th>model</th>
              <th>year</th>
              <th>color</th>
              <th>odometer</th>
              <th>status</th>
              <th>vtname</th>
              <th>location</th>
              <th>city</th>
            </tr>
          </thead>
          <tbody>
          <?php if($vehicles): ?>
            <?php foreach($vehicles as $veh): ?>
                <tr>
                    <td><?php echo $veh->vlicense; ?></td>
                    <td><?php echo $veh->make; ?></td>
                    <td><?php echo $veh->model; ?></td>
                    <td><?php echo $veh->year; ?></td>
                    <td><?php echo $veh->color; ?></td>
                    <td><?php echo $veh->odometer; ?></td>
                    <td><?php echo $veh->status; ?></td>
                    <td><?php echo $veh->vtname; ?></td>
                    <td><?php echo $veh->location; ?></td>
                    <td><?php echo $veh->city; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <form method="post" action="admin.php">
        <label>Delete a Vehicle. If desired option not available the record must be deleted from the Rent table first</label>
        <div class="row">
          <div class="col-sm-1">
            <input type="submit" class="btn btn-md btn-danger" value="DELETE" name="deleteVehicle">
          </div>
          <div class="col-sm-11">
            <div class="form-group">
              <select name="vlicense" class="form-control">
                <option value="0">Select A Vlicense</option>
                <?php foreach($delVeh as $delv): ?>
                <option value="<?php echo $delv->vlicense; ?>">
                <?php echo $delv->vlicense?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        </form>
        <?php if($vehDelMessage): ?>
        <h3 style="color:red;"><?php echo $vehDelMessage; ?> </h3>
      <?php endif; ?>
      <form method="post" action="admin.php">
      <label>Insert A Vehicle. </label>
        <div class="row">
          <div class="col-sm-1">
          <input type="submit" class="btn btn-md btn-success" value="INSERT" name="insertveh">
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>License Plate</label>
              <input type="text" class="form-control" name="vlicense">
              <label>Make</label>
              <input type="text" class="form-control" name="make">
              <label>Model</label>
              <input type="text" class="form-control" name="model">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Year</label>
              <input type="text" class="form-control" name="year">
              <label>Color</label>
              <input type="text" class="form-control" name="color">
              <label>Odometer</label>
              <input type="text" class="form-control" name="odometer">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control">
                  <option value="available" selected >available</option>
                  <option value="rented">rented</option>
                  <option value="maintenance">maintenance</option>
              </select>
              <label>Vehicle Type</label>
              <select name="vtname" class="form-control">
                <option value="0">Choose a Vehicle Type</option>
                <?php foreach($vehicletypes as $type): ?>
                <option value="<?php echo $type->vtname; ?>"><?php echo $type->vtname; ?></option>
                <?php endforeach; ?>
              </select>
              <label>Branch</label>
              <select name="branch" class="form-control">
                <option value="0">Choose a Location</option>
                <?php foreach($branches as $branch): ?>
                <option value="<?php echo $branch->location; ?>#<?php echo $branch->city; ?>">
                <?php echo $branch->location. ', ' . $branch->city ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        </form>
        <?php if($insertvmessage): ?>
        <h3 style="color:red;"><?php echo $insertvmessage; ?> </h3>
      <?php endif; ?>
      </div>

      <div style="padding-top: 65px;" id="vehicletypes">
      <h2>Vehicle Types</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>vtname</th>
              <th>features</th>
              <th>wrate</th>
              <th>drate</th>
              <th>hrate</th>
              <th>wirate</th>
              <th>dirate</th>
              <th>hirate</th>
              <th>krate</th>
            </tr>
          </thead>
          <tbody>
          <?php if($vehicletypes): ?>
            <?php foreach($vehicletypes as $vt): ?>
                <tr>
                    <td><?php echo $vt->vtname; ?></td>
                    <td><?php echo $vt->features; ?></td>
                    <td><?php echo $vt->wrate; ?></td>
                    <td><?php echo $vt->drate; ?></td>
                    <td><?php echo $vt->hrate; ?></td>
                    <td><?php echo $vt->wirate; ?></td>
                    <td><?php echo $vt->dirate; ?></td>
                    <td><?php echo $vt->hirate; ?></td>
                    <td><?php echo $vt->krate; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <form method="post" action="admin.php">
        <label>Delete a Vehicle Type. If desired option not available the record must be deleted from the Vehicle table first</label>
        <div class="row">
          <div class="col-sm-1">
            <input type="submit" class="btn btn-md btn-danger" value="DELETE" name="deleteVehicleType">
          </div>
          <div class="col-sm-11">
            <div class="form-group">
              <select name="vtname" class="form-control">
                <option value="0">Select A Vtname</option>
                <?php foreach($delTypes as $delvt): ?>
                <option value="<?php echo $delvt->vtname; ?>">
                <?php echo $delvt->vtname?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        </form>
        <?php if($vehtDelMessage): ?>
        <h3 style="color:red;"><?php echo $vehtDelMessage; ?> </h3>
      <?php endif; ?>
      <form method="post" action="admin.php">
      <label>Insert A Vehicle Type. </label>
        <div class="row">
          <div class="col-sm-1">
          <input type="submit" class="btn btn-md btn-success" value="INSERT" name="insertvt">
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Vehicle Type</label>
              <input type="text" class="form-control" name="vtname">
              <label>Features</label>
              <input type="text" class="form-control" name="features">
              <label>Per KM Rate</label>
              <input type="text" class="form-control" name="krate">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Weekly Rate</label>
              <input type="text" class="form-control" name="wrate">
              <label>Daily Rate</label>
              <input type="text" class="form-control" name="drate">
              <label>Hourly Rate</label>
              <input type="text" class="form-control" name="hrate">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Weekly Insurance Rate</label>
              <input type="text" class="form-control" name="wirate">
              <label>Daily Insurance Rate</label>
              <input type="text" class="form-control" name="dirate">
              <label>Hourly Insurance Rate</label>
              <input type="text" class="form-control" name="hirate">
            </div>
          </div>
        </div>
        </form>
        <?php if($vtmessage): ?>
        <h3 style="color:red;"><?php echo $vtmessage; ?> </h3>
      <?php endif; ?>
      </div>

      <div style="padding-top: 65px;" id="dailyrentals">
      <h2>Daily Rentals</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Location</th>
              <th>City</th>
              <th>Amount Rented</th>
              <th>Vehicle Type</th>
              <th>Branch Total</th>
              <th>Company Total</th>
            </tr>
          </thead>
          <tbody>
          <?php if($dailyrentals): ?>
            <?php foreach($dailyrentals as $dr): ?>
                <tr>
                    <td><?php echo $dr->loc; ?></td>
                    <td><?php echo $dr->city; ?></td>
                    <td><?php echo $dr->numrented; ?></td>
                    <td><?php echo $dr->vname; ?></td>
                    <td><?php echo $dr->tv; ?></td>
                    <td><?php echo $dr->ta; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      </div>

      <div style="padding-top: 65px;" id="branchrentals">
      <h2>Branch Rentals</h2>
      <form method="GET" action="admin.php">
        <div class="form-group">
        <select name="branch" class="form-control">
          <option value="0">Choose a Location</option>
          <?php foreach($branches as $branch): ?>
            <option value="<?php echo $branch->location; ?>#<?php echo $branch->city; ?>">
            <?php echo $branch->location. ', ' . $branch->city ?></option>
          <?php endforeach; ?>
        </select>
        </div>
        <input type="submit" style="margin-bottom:10px;" class="btn btn-lg btn-success" value="SEARCH">
      </form>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Vehicle Type</th>
              <th>Number</th>
              <th>Total Amount</th>
            </tr>
          </thead>
          <tbody>
          <?php if($branchrentals): ?>
            <?php foreach($branchrentals as $br): ?>
                <tr>
                    <td><?php echo $br->vname; ?></td>
                    <td><?php echo $br->num; ?></td>
                    <td><?php echo $br->ta; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      </div>

      <div style="padding-top: 65px;" id="dailyreturns">
      <h2>Daily Returns</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Location</th>
              <th>City</th>
              <th>Returned</th>
              <th>Vehicle Type</th>
              <th>Total by Vehicle Type $</th>
              <th>Total by Branch $</th>
              <th>Total Revenue $</th>
            </tr>
          </thead>
          <tbody>
          <?php if($dailyreturns): ?>
            <?php foreach($dailyreturns as $dret): ?>
                <tr>
                    <td><?php echo $dret->loc; ?></td>
                    <td><?php echo $dret->city; ?></td>
                    <td><?php echo $dret->numreturned; ?></td>
                    <td><?php echo $dret->vname; ?></td>
                    <td><?php echo $dret->totbyvt; ?></td>
                    <td><?php echo $dret->totbyb; ?></td>
                    <td><?php echo $dret->cra; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      </div>

      <div style="padding-top: 65px;" id="branchreturns">
      <h2>Branch Returns</h2>
      <form method="GET" action="admin.php">
        <div class="form-group">
        <select name="branch" class="form-control">
          <option value="0">Choose a Location</option>
          <?php foreach($branches as $branch): ?>
            <option value="<?php echo $branch->location; ?>#<?php echo $branch->city; ?>">
            <?php echo $branch->location. ', ' . $branch->city ?></option>
          <?php endforeach; ?>
        </select>
        </div>
        <input type="submit" style="margin-bottom:10px;" class="btn btn-lg btn-success" value="SEARCH">
      </form>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Location</th>
              <th>City</th>
              <th>Returned</th>
              <th>Vehicle Type</th>
              <th>Total by Vehicle Type $</th>
              <th>Total by Branch $</th>
            </tr>
          </thead>
          <tbody>
          <?php if($branchreturns): ?>
            <?php foreach($branchreturns as $bret): ?>
                <tr>
                    <td><?php echo $bret->loc; ?></td>
                    <td><?php echo $bret->city; ?></td>
                    <td><?php echo $bret->numreturned; ?></td>
                    <td><?php echo $bret->vname; ?></td>
                    <td><?php echo $bret->totbyvt; ?></td>
                    <td><?php echo $bret->totbyb; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      </div>
    </main>
  </div>
</div>
</body>
</html>



