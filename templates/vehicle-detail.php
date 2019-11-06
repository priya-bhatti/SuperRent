<?php include 'inc/header.php'; ?>
<div class="jumbotron">
    <div class="container">
    <h2 class="page-header"><?php echo $vehicle->vehicle_title; ?></h2>
    <h5>Posted By <?php echo $vehicle->contact_user; ?></h5>
    <hr>
    <p class="lead"><?php echo $vehicle->description; ?></p>
    <ul class="list-group">
        <li class="list-group-item"><strong>Company: </strong><?php echo $vehicle->company; ?></li>
        <li class="list-group-item"><strong>Salary: </strong><?php echo $vehicle->salary; ?></li>
    </ul>
    <div class="well" style="margin-top:20px;">
    <a href="reserve.php?id=<?php echo $vehicle->id; ?>" class="btn btn-success">RESERVE</a>
    </div>
    </div>
</div>
  <div class="container">
    <div class="row">
      <!-- TODO vehicle type table -->
        <h2>table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                </tr>
            </thead>
            <?php if($vehicles): ?>
            <?php foreach($vehicles as $vehicle): ?>
                <tr>
                    <td><?php echo $vehicle->vehicle_title; ?></td>
                    <td><?php echo $vehicle->category_id; ?></td>
                    <td><?php echo $vehicle->description; ?></td>
                    <td><?php echo $vehicle->contact_user; ?></td>
                    <td><?php echo $vehicle->salary; ?></td>
                    <td><?php echo $vehicle->company; ?></td>
                    <td><?php echo $vehicle->location; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
    <hr>
  </div>
<br>
<br>


<?php include 'inc/footer.php'; ?>
