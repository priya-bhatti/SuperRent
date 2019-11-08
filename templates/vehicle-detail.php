<?php include 'inc/header.php'; ?>
<div class="jumbotron">
    <div class="container">
    <h2 class="page-header"><?php echo $vehicle->vtname; ?></h2>
    <h5>Features:  <?php echo $vehicle->features; ?></h5>
    <hr>
    <ul class="list-group">
        <li class="list-group-item"><strong>Weekly Rate: $</strong><?php echo $vehicle->wrate; ?></li>
        <li class="list-group-item"><strong>Daily Rate: $</strong><?php echo $vehicle->drate; ?></li>
        <li class="list-group-item"><strong>Hourly Rate: $</strong><?php echo $vehicle->hrate; ?></li>
        <li class="list-group-item"><strong>Weekly Insurance Rate: $</strong><?php echo $vehicle->wirate; ?></li>
        <li class="list-group-item"><strong>Daily Insurance Rate: $</strong><?php echo $vehicle->dirate; ?></li>
        <li class="list-group-item"><strong>Hourly Insurance Rate: $</strong><?php echo $vehicle->hirate; ?></li>
        <li class="list-group-item"><strong>Per KM Rate: $</strong><?php echo $vehicle->krate; ?></li>
    </ul>
    <div class="well" style="margin-top:20px;">
        <?php if ($can_reserve): ?>
            <!-- TODO FIX URL -->
            <a href="reserve.php?id=<?php echo $vehicle->vlicense; ?>" class="btn btn-success">RESERVE</a>
        <?php else: ?>
            <p class="bg-warning text-white">Must Enter Vehicle Type, Location, And a Time Interval to Reserve</p>
        <?php endif; ?>
    </div>
    </div>
</div>
  <div class="container">
    <div class="row">
      <!-- TODO vehicle type table must match search inputs -->
        <h2><?php echo $vehicle->vtname. '\'s'; ?></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Licence Plate</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Colour</th>
                    <th>Odometer</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Branch</th>
                    <th>City</th>
                </tr>
            </thead>
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
        </table>
    </div>
    <hr>
  </div>
<br>
<br>


<?php include 'inc/footer.php'; ?>
