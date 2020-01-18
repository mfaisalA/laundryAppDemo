<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 
if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");


	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");


	$sql = "SELECT * FROM appointments 
	WHERE DATE(_datetime) >= '$start_date' AND DATE(_datetime) <= '$end_date' AND appointment_status != 1 AND status = 1 
	ORDER BY created_date DESC";
	$rs = mysqli_query($con, $sql);
	}

	?>

<section id="main">
  <div class="container">
  	<div class="row">
      <div class="clearfix"></div>
	  		<br>

	  <div class="panel panel-default">
	  	<div class="panel-heading">
	  		<h3 class="text-center">Request Report</h3>
	  	</div>
	  	<div class="panel-body">
	  		<table class="table table-bordered table-striped">
	  			<thead>
	  				<tr>
	  					<th>
	  						ID
	  					</th>
	  					<th>
	  						Customer Name
	  					</th>
	  					<th>
	  						Customer Email
	  					</th>
	  					<th>
	  						Vehicle Brand
	  					</th>
	  					<th>
	  						Vehicle Model
	  					</th>
	  					<th>
	  						Total Charges
	  					</th>
	  					<th>
	  						Service Date
	  					</th>
	  					<th>
	  						Request Date
	  					</th>
	  					<th>
	  						Request Status
	  					</th>
	  					<th>
	  						Details
	  					</th>
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  					$totalRequests = 0;
  					$totalAccepted = 0;
  					$totalDeclined = 0;
  					$totalCompleted = 0;
  					$totalAmount = 0;
					while ($row = mysqli_fetch_assoc($rs)){
						$totalRequests++;
						$totalAmount = $totalAmount + getTotalServiceCharges($con, $row['id']);
						?>


		  			<tr>
						<td><?=$row['id'] ?></td>
						<td><?=ucwords($row['cus_name']) ?></td>
						<td><?=$row['cus_email'] ?></td>
						<td><?=$row['vehicle_brand'] ?></td>
						<td><?=$row['vehicle_model_year'] ?></td>
						<td><?=getTotalServiceCharges($con, $row['id']) ?>  BD</td>
						<td><?=date('d/M/y h:iA', strtotime($row['_datetime']))?></td>
						<td><?=date('d/M/y h:iA', strtotime($row['created_date'])) ?></td>

						
						<?php 
						// SET APPOINTMENT STATUS
						if($row['appointment_status'] == 1){
							echo '<td><div style="padding: 5px 24px;" class="label label-warning">Pending</div></td>';
						}
						if($row['appointment_status'] == 2){
							echo '<td><div style="padding: 5px 24px;" class="label label-success">Await payment</div></td>';
							$totalAccepted++;
						}
						if($row['appointment_status'] == 3){
							echo '<td><div style="padding: 5px 24px;" class="label label-danger">Declined</div></td>';
							$totalDeclined++;
						}
						if($row['appointment_status'] == 4){
							echo '<td><div style="padding: 5px 24px;" class="label label-warning">Payment Completed</div></td>';
						}
						if($row['appointment_status'] == 5){
							echo '<td><div style="padding: 5px 24px;" class="label label-success">Completed</div></td>';
							$totalCompleted;
						}
						 ?>
						<td>
						<ul class="list-inline">
							<li>
								<a href="view_request_details.php?app_id=<?=$row['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-external-link"></span></a>
							</li><!-- 
							<li>
								<a href="?del_id=<?=$row['id'] ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
							</li> -->
						</ul>
						</td>
						
		  			</tr>	
				<?php } ?>
	  			</tbody>
	  		</table>

	  		<div style="float: right;width: 40%">
	  		<table class="table table-bordered table-striped">
	  			<tbody>
	  				<tr>
	  					<th>Total Requests</th>
	  					<th><?php echo $totalRequests; ?></th>
	  				</tr>
	  				<tr>
	  					<th>Total Completed</th>
	  					<th><?php echo $totalCompleted; ?></th>
	  				</tr>
	  				<tr>
	  					<th>Total Accepted</th>
	  					<th><?php echo $totalAccepted; ?></th>
	  				</tr>
	  				<tr>
	  					<th>Total Declined</th>
	  					<th><?php echo $totalDeclined; ?></th>
	  				</tr>
	  				<tr>
	  					<th>Total Amount</th>
	  					<th><?php echo $totalAmount; ?>BD</th>
	  				</tr>
	  			</tbody>
	  		</table>
	  	</div>
	  	</div>
	  </div>
	</div>
	<!-- .ROW -->
  </div>
  <!-- .CONTAINER -->
</section>

<?php require_once('includes/footer.php'); ?>
</body>

<?php require_once('includes/import_scripts.php'); ?>
</html>