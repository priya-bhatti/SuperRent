<?php include 'inc/header.php'; ?>
<body>
<main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3" style="color:#00bc8c">Enter Your Information</h1>
      <form method="GET" action="reserve.php">
        <!-- TODO: Phone number -->
        <div class="form-group">
            <label>PHONE NUMBER </label>
            <input type="text" class="form-control" name="fromdate" placeholder="123-456-789">
        </div>
        <input type="submit" style="margin-top:20px;" class="btn btn-lg btn-success" value="SEARCH">
      </form>
    </div>
  </div>
  <!-- TODO: if phone number returns customer -->
  <!-- <?php if($vehicles): ?>
<?php foreach($vehicles as $vehicle): ?>
  <div class="container">
    <div class="row">
      <div class="col-md-10"> -->
        <!-- TODO customer name-->
        <!-- <h2><?php echo $vehicle->vehicle_title; ?></h2> -->
        <!-- TODO customer address-->
        <!-- <h2><?php echo $vehicle->vehicle_title; ?></h2> -->
        <!-- TODO customer dlicence-->
        <!-- <h2><?php echo $vehicle->vehicle_title; ?></h2>
        <p><a class="btn btn-outline-success" href="confirm.php?id=<?php echo $vehicle->id; ?>" role="button">View details &raquo;</a></p>
      </div>
    </div>
    <hr>
  </div>
<?php endforeach; ?> -->
<!-- else put input forms -->
<!-- <p><a class="btn btn-outline-success" href="confirm.php?id=<?php echo $vehicle->id; ?>" role="button">View details &raquo;</a></p>
<?php endif; ?> -->
</main>


<?php include 'inc/footer.php'; ?>