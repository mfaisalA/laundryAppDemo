<?php require_once('includes/system_header.php'); ?>
<?php require_once('functions.php'); ?>
<?php 
	if($_GET['app_id']){
		$row ="";
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$app_id = $_GET['app_id'];
		$sql = "SELECT * FROM appointments 
		WHERE id = $app_id";
		if($rs = mysqli_query($con, $sql)){
			$row = mysqli_fetch_assoc($rs);
			$valid = true;
			$msg = "Record retured successfully";
		}else{
			header('location: index.php?success='.$valid.'&msg='.$msg);
		}
	}else{
		$msg = "Selected record does not exist";
		header('location: index.php?success='.$valid.'&msg='.$msg);
	}
 ?>

<section id="main">
  <div class="container">
  	<div class="row">
    <a class="no_style_link" href="system_home.php"><h1 class="jumbotron text-center">All Appoinments</h1></a>
    <div id="errorDiv" class="col-sm-8 col-sm-offset-2">
  	<?php
                if($_GET['success']){
                    if($_GET['success'] == true){
                        echo '
                            <div class="alert alert-success text-center">'.$_GET['msg'].'
            </div>';
                    }else{
                        echo '
            <div class="alert alert-danger text-center">'.$_GET['msg'].'
            </div>';
                    } 
                }
                 ?>
      </div>
      <div class="clearfix"></div>

	  <div class="panel panel-default">
	  	<div class="panel-heading">
	  		<h3 class="text-center"><span class="fa fa-newspaper-o"></span> Appointment Detail</h3>
	  	</div>
	  	<div class="panel-body">
	  		<div class=" col-sm-8 col-sm-offset-2">
	  		<table class="table table-bordered">
	  			<tbody>
	  				<tr>
	  					<th >Customer Name</th>
	  					<th style="width: 75%"><?=ucwords($row['cus_name']) ?></th>
	  				</tr>
	  				<tr>
	  					<th >Customer Email</th>
	  					<th style="width: 75%"><?=ucwords($row['cus_email']) ?></th>
	  				</tr>
	  				<tr>
	  					<th >Customer Contact</th>
	  					<th style="width: 75%"><?=ucwords($row['cus_contact']) ?></th>
	  				</tr>
	  				<tr>
	  					<th >Vehicle Brand</th>
	  					<th style="width: 75%"><?=getBrandNameFromId($con, $row['vehicle_brand_id']) ?></th>
	  				</tr>
	  				<tr>
	  					<th >Model <small>(Year)</small></th>
	  					<th style="width: 75%"><?=$row['vehicle_model_year'] ?></th>
	  				</tr>
	  				<tr>
	  					<th >Model <small>(Name)</small></th>
	  					<th style="width: 75%"><?=empty($row['vehicle_model_name']) ? 'N/A' : getModelNameFromId($con, $row['vehicle_model_name']) ?></th>
	  				</tr>

	  				<tr>
	  					<th >Pickup Required</th>
	  					<th style="width: 75%"><?=$pickupReq = ($row['pickup_required'] == 0) ? 'No' : 'Yes' ?></th>
	  				</tr>
	  				<?php 
	  					if($pickupReq == 'Yes'){
	  						echo '<tr>
	  					<th >Pickup Location</th>
	  					<th style="width: 75%">'.$row['pickup_location'].'</th>
	  				</tr>';
	  					}
	  				 ?>

	  				 <tr>
	  					<th >Expected Failure In</th>
	  					<th style="width: 75%">
	  					<?php 
	  						$failureSql = "SELECT fail.name FROM appointment_exp_failures AS app JOIN expected_failures AS fail 
	  						ON app.expected_failure_id = fail.id 
	  						WHERE app.appointment_id = {$row['id']}";
	  						$rs = mysqli_query($con, $failureSql);
	  						while($failName = mysqli_fetch_row($rs)[0]){
	  							echo $failName.' | ';
	  						}

	  					 ?>
	  					</th>
	  				</tr>
	  				<tr>
	  					<th >Failure Description</th>
	  					<th style="width: 75%"><?=$row['failure_desc'] ?></th>
	  				</tr>
	  				<tr>
	  					<th >Appointment Date</th>
	  					<?php 

			$appDate = DateTime::createFromFormat('Y-m-d H:i:s', $row['_datetime']);
			$appDate = $appDate->format('D d-M-Y  h:iA');
						 ?>
	  					<th style="width: 75%"><?=$appDate?></th>
	  				</tr>
	  				<?php
	  				$status = null; 
	  					if($row['appointment_status'] == 1){
	  						$status = 'Pending';
	  					} 
	  					if($row['appointment_status'] == 2){
	  						$status = 'Accepted';
	  					} 
	  					if($row['appointment_status'] == 3){
	  						$status = 'Declined';
	  					} 
	  					if($row['appointment_status'] == 4){
	  						$status = 'Completed';
	  					} 
	  				 ?>
	  				<tr>
	  					<th >Request Date</th>
	  					<?php 

			$createdDate = DateTime::createFromFormat('Y-m-d H:i:s', $row['created_date']);
			$createdDate = $createdDate->format('D d-M-Y h:iA');
						 ?>
	  					<th style="width: 75%"><?=$createdDate ?></th>
	  				</tr>
	  				<tr>
	  					<th >Appointment Status</th>
	  					<th style="width: 75%"><?=$status ?></th>
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