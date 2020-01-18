<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
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
    <a class="no_style_link" href="all_requests.php"><h1 class="jumbotron text-center">All Requests</h1></a>
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
	  		<h3 class="text-center"><span class="fa fa-newspaper-o"></span> Request Details</h3>
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
	  					<th style="width: 75%"><?=$row['vehicle_brand'] ?></th>
	  				</tr>
	  				<tr>
	  					<th >Model <small>(Year)</small></th>
	  					<th style="width: 75%"><?=$row['vehicle_model_year'] ?></th>
	  				</tr>
	  				<tr>
	  					<th >Model <small>(Name)</small></th>
	  					<th style="width: 75%"><?=empty($row['vehicle_model_name']) ? 'N/A' : $row['vehicle_model_name'] ?></th>
	  				</tr>

	  				<tr>
	  					<th >Car Location</th>
	  					<th style="width: 75%"><?=$row['car_location'] ?></th>
	  				</tr>
	  				

	  				 <tr>
	  					<th >Additional Services</th>
	  					<th style="width: 75%">
	  					<?php 
	  						$serSql = "SELECT ser.name FROM appointment_services AS app JOIN services  AS ser 
	  						ON app.service_id = ser.id 
	  						WHERE app.appointment_id = {$row['id']}";
	  						$rs = mysqli_query($con, $serSql);
	  						$servicesName = "";
	  						while($serName = mysqli_fetch_row($rs)[0]){
	  							$servicesName = $servicesName.$serName.' | ';
	  						}
	  						echo ($servicesName == "") ? 'None': $servicesName;

	  					 ?>
	  					</th>
	  				</tr>

	  				<tr>
	  					<th >Total Charges</th>
	  					<th style="width: 75%"><?=getTotalServiceCharges($con, $row['id'])?> BD</th>
	  				</tr>
	  				<!-- <tr>
	  					<th >Special Request</th>
	  					<th style="width: 75%"><?=$row['description'] ?></th>
	  				</tr> -->
	  				<tr>
	  					<th >Service Date</th>
	  					<th style="width: 75%"><?=date('d/M/y h:iA', strtotime($row['_datetime'])) ?></th>
	  				</tr>
	  				<?php
	  				$status = null; 
	  					if($row['appointment_status'] == 1){
	  						$status = 'Pending';
	  					} 
	  					if($row['appointment_status'] == 2){
	  						$status = 'Await Payment';
	  					} 
	  					if($row['appointment_status'] == 3){
	  						$status = 'Declined';
	  					} 
	  					if($row['appointment_status'] == 4){
	  						$status = 'Payment Completed';
	  					} 
	  					if($row['appointment_status'] == 5){
	  						$status = 'Completed';
	  					} 
	  				 ?>
	  				<tr>
	  					<th >Appointment Status</th>
	  					<th style="width: 75%"><?=$status ?></th>
	  				</tr>
	  				<tr>
	  					<th >Request Date</th>
	  					<th style="width: 75%"><?= date('d/M/y h:iA', strtotime($row['created_date'])) ?></th>
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