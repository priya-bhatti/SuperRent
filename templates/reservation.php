<?php include 'inc/header.php'; ?>
<body>
<main role="main">
  <div class="jumbotron">
  <?php if($confirmation): ?>
  <div class="container">
    <div class="row">
      <div class="col-md-10">
      <h2>Please Save This Information</h2>
      <h3><?php echo 'Confirmation #: '. $confirmation->confno; ?> </h3>
      <h3><?php echo 'Vehicle Type: '. $confirmation->vtname; ?> </h3>
      <h3><?php echo 'Drivers License: '. $confirmation->dlicense; ?> </h3>
      <h3><?php echo 'Pick-Up Date: '. $confirmation->fromdate; ?> </h3>
      <h3><?php echo 'Pick-Up Time: '. $confirmation->fromtime; ?> </h3>
      <h3><?php echo 'Return Date: '. $confirmation->todate; ?> </h3>
      <h3><?php echo 'Return Time: '. $confirmation->totime; ?> </h3>
      </div>
    </div>
    <hr>
  </div>
<?php endif; ?>
<?php if(!$confirmation): ?>
    <div class="container">
      <h1 class="display-3" style="color:#00bc8c">Enter Your Information</h1>
      <form method="GET" action="reserve.php">
        <!-- TODO: Driver's Licence -->
        <div class="form-group">
            <label>DRIVERS LICENSE </label>
            <input type="text" class="form-control" name="dlicense">
            <input type="hidden" class="form-control" id="vtname" name="vtname" value= "<?php echo $vehicle[0]; ?>">
            <input type="hidden" class="form-control" id="location" name="location" value="<?php echo $vehicle[1]; ?>">
            <input type="hidden" class="form-control" id="city" name="city" value="<?php echo $vehicle[2]; ?>">
            <input type="hidden" class="form-control" id="fromdate" name="fromdate" value="<?php echo $vehicle[3]; ?>">
            <input type="hidden" class="form-control" id="fromtime" name="fromtime" value="<?php echo $vehicle[4]; ?>">
            <input type="hidden" class="form-control" id="todate" name="todate" value="<?php echo $vehicle[5]; ?>">
            <input type="hidden" class="form-control" id="totime" name="totime" value="<?php echo $vehicle[6]; ?>">
        </div>
        <input type="submit" style="margin-top:20px;" class="btn btn-lg btn-success" value="SEARCH">
      </form>
    </div>
  <?php endif; ?>
  </div>
  <!-- TODO: if phone number returns customer form to make reservation -->
  <?php if($customer): ?>
  <?php foreach($customer as $cus): ?>
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <form method="post" action="reserve.php">
        <div class="form-group">
            <label>Drivers License: </label>
            <input type="text" class="form-control" name="dlicense" value="<?php echo $cus->dlicense; ?>">
        </div>
        <div class="form-group">
            <label>Vehicle Type: </label>
            <input type="text" class="form-control" name="vtname" value="<?php echo $vehicle[0]; ?>">
        </div>
        <div class="form-group">
            <label>Location: </label>
            <input type="text" class="form-control" name="location" value="<?php echo $vehicle[1]; ?>">
        </div>
        <div class="form-group">
            <label>City: </label>
            <input type="text" class="form-control" name="city" value="<?php echo $vehicle[2]; ?>">
        </div>
        <div class="form-group">
            <label>Pick-Up Date: </label>
            <input type="text" class="form-control" name="fromdate" value="<?php echo $vehicle[3]; ?>">
        </div>
        <div class="form-group">
            <label>Pick-Up Time: </label>
            <input type="text" class="form-control" name="fromtime" value="<?php echo $vehicle[4]; ?>">
        </div>
        <div class="form-group">
            <label>Return Date: </label>
            <input type="text" class="form-control" name="todate" value="<?php echo $vehicle[5]; ?>">
        </div>
        <div class="form-group">
            <label>Return Time: </label>
            <input type="text" class="form-control" name="totime" value="<?php echo $vehicle[6]; ?>">
        </div>
        <input type="submit" style="margin-top:20px;" class="btn btn-lg btn-success" value="Submit" name="submit">
    </form>
      </div>
    </div>
    <hr>
  </div>
  <?php endforeach; ?>
  <?php elseif(!$customer && !$confirmation): ?>
    <div class="container">
    <div class="row">
      <div class="col-md-10">
      <h2>New Customer? Add Your Information</h2>
        <form method="post" action="reserve.php">
        <div class="form-group">
            <label>Cellphone: </label>
            <input type="number" class="form-control" name="cellphone">
        </div>
        <div class="form-group">
            <label>Name: </label>
            <input type="text" class="form-control" name="cname">
        </div>
        <div class="form-group">
            <label>Address: </label>
            <input type="text" class="form-control" name="caddress">
        </div>
        <div class="form-group">
            <label>Driver's License: </label>
            <input type="text" class="form-control" name="dlicense">
        </div>
        <div class="form-group">
        <input type="hidden" class="form-control" id="vtname" name="vtname" value= "<?php echo $vehicle[0]; ?>">
            <input type="hidden" class="form-control" id="location" name="location" value="<?php echo $vehicle[1]; ?>">
            <input type="hidden" class="form-control" id="city" name="city" value="<?php echo $vehicle[2]; ?>">
            <input type="hidden" class="form-control" id="fromdate" name="fromdate" value="<?php echo $vehicle[3]; ?>">
            <input type="hidden" class="form-control" id="fromtime" name="fromtime" value="<?php echo $vehicle[4]; ?>">
            <input type="hidden" class="form-control" id="todate" name="todate" value="<?php echo $vehicle[5]; ?>">
            <input type="hidden" class="form-control" id="totime" name="totime" value="<?php echo $vehicle[6]; ?>">
        </div>
        <input type="submit" style="margin-top:20px;" class="btn btn-lg btn-success" value="Submit" name="addCustomer">
    </form>
    <h4><?php echo $vehicle->vtname; ?></h4>
      </div>
    </div>
    <hr>
  </div>
<?php endif; ?>
</main>


<?php include 'inc/footer.php'; ?>
