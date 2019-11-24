<?php include 'inc/header.php'; ?>
<body>
<main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3" style="color:#00bc8c">Start a Reservation</h1>
      <form method="GET" action="index.php">
      <div class="form-group">
        <select name="type" class="form-control">
          <option value="0">Choose a Vehicle Type</option>
          <?php foreach($types as $type): ?>
            <option value="<?php echo $type->vtname; ?>"><?php echo $type->vtname; ?></option>
          <?php endforeach; ?>
        </select>
        </div>
        <div class="form-group">
        <select name="branch" class="form-control">
          <option value="0">Choose a Location</option>
          <?php foreach($branches as $branch): ?>
            <option value="<?php echo $branch->location; ?>#<?php echo $branch->city; ?>">
            <?php echo $branch->location. ', ' . $branch->city ?></option>
          <?php endforeach; ?>
        </select>
        </div>
        <div class="form-group">
            <label>PICK-UP </label>
            <div class="form-row">
              <div class="col-md-6">
                <input type="text" class="form-control" name="fromdate" placeholder="YYYY-MM-DD">
              </div>
              <div class="col-md-6">
                <select name="fromtime" class="form-control">
                  <option value="09:00:00" selected >9:00 AM</option>
                  <option value="10:00:00">10:00 AM</option>
                  <option value="11:00:00">11:00 AM</option>
                  <option value="12:00:00">12:00 PM</option>
                  <option value="13:00:00">1:00 PM</option>
                  <option value="14:00:00">2:00 PM</option>
                  <option value="15:00:00">3:00 PM</option>
                  <option value="16:00:00">4:00 PM</option>
                  <option value="17:00:00">5:00 PM</option>
                  <option value="18:00:00">6:00 PM</option>
                  <option value="19:00:00">7:00 PM</option>
                  <option value="20:00:00">8:00 PM</option>
                  <option value="21:00:00">9:00 PM</option>
                </select>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label>RETURN </label>
            <div class="form-row">
              <div class="col-md-6">
                <input type="text" class="form-control" name="todate" placeholder="YYYY-MM-DD">
              </div>
              <div class="col-md-6">
              <select name="totime" class="form-control">
                  <option value="09:00:00" selected >9:00 AM</option>
                  <option value="10:00:00">10:00 AM</option>
                  <option value="11:00:00">11:00 AM</option>
                  <option value="12:00:00">12:00 PM</option>
                  <option value="13:00:00">1:00 PM</option>
                  <option value="14:00:00">2:00 PM</option>
                  <option value="15:00:00">3:00 PM</option>
                  <option value="16:00:00">4:00 PM</option>
                  <option value="17:00:00">5:00 PM</option>
                  <option value="18:00:00">6:00 PM</option>
                  <option value="19:00:00">7:00 PM</option>
                  <option value="20:00:00">8:00 PM</option>
                  <option value="21:00:00">9:00 PM</option>
                </select>
              </div>
            </div>
        </div>
        <input type="submit" style="margin-top:20px;" class="btn btn-lg btn-success" value="SEARCH">
      </form>
    </div>
  </div>
<?php if($vehicles): ?>
<?php foreach($vehicles as $vehicle): ?>
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h2><?php echo $vehicle->vtname; ?></h2>
        <h3><?php echo $vehicle->available. ' '. $vehicle->vtname. ' Fit Your Criteria'; ?> </h3>
        <p><a class="btn btn-outline-success" href="vehicle.php?vtname=<?php echo $vehicle->vtname.$url; ?>" role="button">View details &raquo;</a></p>
      </div>
    </div>
    <hr>
  </div>
<?php endforeach; ?>
<?php endif; ?>

</main>


<?php include 'inc/footer.php'; ?>
