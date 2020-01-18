<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 

	if(isset($_GET['completed_id'])){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$completed_id = $_GET['completed_id'];
		$compSql = "UPDATE appointments 
		SET appointment_status = 5 
		WHERE id = $completed_id";
		if(mysqli_query($con, $compSql)){
			//send mail
			// $sqlMail = "SELECT * FROM appointments 
			// WHERE id = $completed_id";
			// $rsMail = mysqli_query($con, $sqlMail);
			// $rowMail = mysqli_fetch_assoc($rsMail);
			// $toName =$rowMail['cus_name'];
			// $toEmail =$rowMail['cus_email'];
			// $workshopName =getWorkshopNameFromId($con, $rowMail['workshop_id']);
			// $loc =$rowMail['location'];
			// $apDate = DateTime::createFromFormat('Y-m-d H:i:s', $rowMail['_datetime']);
			// $appointmentDate = $apDate->format('d/M/Y h:iA');

			// //echo "<br><br><br><br><br><br>";
			// $subject = "Vehicle Service Completed";
			// $message = "<table><tr><td> Dear ".ucfirst($toName)."</td></tr><tr><td></td></tr><tr><td>Your appointment for vehicle service with <b>".$workshopName."</b> on <b>".$appointmentDate."</b> has been completed, You can collect your car from our workshop. </tr></td><tr><td>-----------------------------------------------------------------<tr><td> If you have any questions or concerns please contact us at <a href=''>support@autogarage.com.</a></tr></td><tr><td></tr></td><tr><td><br><br>Regards,<br><br>".constant('APP_NAME')." Team</td></tr><tr><td></td></tr><tr><td>---------------------------------------------------------------</td></tr></table>";
			// //echo $message;
			// $fromName = constant('APP_NAME');
			// $fromEmail = "noreply@autogarage.com";

			// sendMail($fromName, $fromEmail, $toEmail, $subject, $message);
			$valid = true;
			$msg = "Appointment completed successfully";
		}

		header('location: ?success='.$valid.'&msg='.$msg);
	}

	if(isset($_GET['accept_id'])){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$accept_id = $_GET['accept_id'];
		$acceptSql = "UPDATE appointments 
		SET appointment_status = 2 
		WHERE id = $accept_id";
		$totalAmount = getTotalServiceCharges($con, $accept_id);
		if(mysqli_query($con, $acceptSql)){
			mysqli_query($con, "INSERT INTO payments (appointment_id, amount) VALUES($accept_id, $totalAmount)");

			//send mail
			// $sqlMail = "SELECT * FROM appointments 
			// WHERE id = $accept_id";
			// $rsMail = mysqli_query($con, $sqlMail);
			// $rowMail = mysqli_fetch_assoc($rsMail);
			// $toName =$rowMail['cus_name'];
			// $toEmail =$rowMail['cus_email'];
			// $workshopName =getWorkshopNameFromId($con, $rowMail['workshop_id']);
			// $loc =$rowMail['location'];
			// $apDate = DateTime::createFromFormat('Y-m-d H:i:s', $rowMail['_datetime']);
			// $appointmentDate = $apDate->format('d/M/Y h:iA');

			// //echo "<br><br><br><br><br><br>";
			// $subject = "Vehicle Service Appointment Accepted";
			// $message = "<table><tr><td> Dear ".ucfirst($toName)."</td></tr><tr><td></td></tr><tr><td>Your appointment for vehicle service with <b>".$workshopName."</b> on <b>".$appointmentDate."</b> has been accepted with Appointment ID:<b>".$rowMail['id']."</b> .</tr></td><tr><td>-----------------------------------------------------------------<tr><td> If you have any questions or concerns please contact us at <a href=''>support@autogarage.com.</a></tr></td><tr><td></tr></td><tr><td><br><br>Regards,<br><br>".constant('APP_NAME')." Team</td></tr><tr><td></td></tr><tr><td>---------------------------------------------------------------</td></tr></table>";
			// //echo $message;
			// $fromName = constant('APP_NAME');
			// $fromEmail = "noreply@autogarage.com";

			// sendMail($fromName, $fromEmail, $toEmail, $subject, $message);
			$valid = true;
			$msg = "Appoinment accepted successfully";
		}

		header('location: ?success='.$valid.'&msg='.$msg);

	}
	if(isset($_GET['decline_id'])){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$decline_id = $_GET['decline_id'];
		$decSql = "UPDATE appointments 
		SET appointment_status = 3 
		WHERE id = $decline_id";
		if(mysqli_query($con, $decSql)){
			//send mail
			// $sqlMail = "SELECT * FROM appointments 
			// WHERE id = $decline_id";
			// $rsMail = mysqli_query($con, $sqlMail);
			// $rowMail = mysqli_fetch_assoc($rsMail);
			// $toName =$rowMail['cus_name'];
			// $toEmail =$rowMail['cus_email'];
			// $workshopName =getWorkshopNameFromId($con, $rowMail['workshop_id']);
			// $loc =$rowMail['location'];
			// $apDate = DateTime::createFromFormat('Y-m-d H:i:s', $rowMail['_datetime']);
			// $appointmentDate = $apDate->format('d/M/Y h:iA');

			// //echo "<br><br><br><br><br><br>";
			// $subject = "Vehicle Service Appointment Declined";
			// $message = "<table><tr><td> Dear ".ucfirst($toName)."</td></tr><tr><td></td></tr><tr><td>Your appointment for vehicle service with <b>".$workshopName."</b> on <b>".$appointmentDate."</b> has been declined .</tr></td><tr><td>-----------------------------------------------------------------<tr><td> If you have any questions or concerns please contact us at <a href=''>support@autogarage.com.</a></tr></td><tr><td></tr></td><tr><td><br><br>Regards,<br><br>".constant('APP_NAME')." Team</td></tr><tr><td></td></tr><tr><td>---------------------------------------------------------------</td></tr></table>";
			// //echo $message;
			// $fromName = constant('APP_NAME');
			// $fromEmail = "noreply@autogarage.com";

			// sendMail($fromName, $fromEmail, $toEmail, $subject, $message);
			$valid = true;
			$msg = "Appoinment declined successfully";
		}

		header('location: ?success='.$valid.'&msg='.$msg);

	}
	if($_GET['del_id']){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$del_id = $_GET['del_id'];
		$delSql = "UPDATE appointments 
		SET status = 0 
		WHERE id = $del_id";
		if(mysqli_query($con, $delSql)){
			$valid = true;
			$msg = "Record deleted successfully";
		}

		header('location: ?success='.$valid.'&msg='.$msg);
	}
 ?>

<section id="main">
  <div class="container">
  	<div class="row">
    <h1 class="jumbotron text-center">Pending Requests</h1>
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
	  		<h3><span class="fa fa-list"></span> Request List</h3>
	  	</div>
	  	<div class="panel-body">
	  		<table class="table table-striped">
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
	  						Appointment Date
	  					</th>
	  					<th>
	  						Request Date
	  					</th>
	  					<th>
	  						Total Charges
	  					</th>
	  					<th>
	  						Appointment Status
	  					</th>
	  					<th style="width: 30%"> <center>	
	  						Action
	  					</center>
	  					</th>
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  					$sql = "SELECT * FROM appointments 
  					WHERE status = 1 AND appointment_status IN (1,4) 
					ORDER BY created_date DESC";
  					$rs = mysqli_query($con, $sql);
  					$count = mysqli_num_rows($rs);
  					if($count == 0){
  						echo '<tr><th colspan="11"><center>No appointments pending </center></th></tr>';
  					}else{

					while ($row = mysqli_fetch_assoc($rs)){?>

		  			<tr>
						<td><?=$row['id'] ?></td>
						<td><?=ucwords($row['cus_name']) ?></td>
						<td><?=$row['cus_email'] ?></td>
						<td><?=$row['vehicle_brand'] ?></td>
						<td><?=$row['vehicle_model_year'] ?></td>

						<td><?=date('d/M/y h:iA', strtotime($row['_datetime']))?></td>
						<td><?=date('d/M/y h:iA', strtotime($row['created_date'])) ?></td>
						<td><?=getTotalServiceCharges($con, $row['id']) ?> BD</td>

						<?php 
						// SET APPOINTMENT STATUS
						if($row['appointment_status'] == 1){
							echo '<td><div style="padding: 5px 24px;" class="label label-warning">Pending</div></td>';
						}
						if($row['appointment_status'] == 2){
							echo '<td><div style="padding: 5px 24px;" class="label label-success">Await payment</div></td>';
						}
						if($row['appointment_status'] == 3){
							echo '<td><div style="padding: 5px 24px;" class="label label-danger">Declined</div></td>';
						}
						if($row['appointment_status'] == 4){
							echo '<td><div style="padding: 5px 24px;" class="label label-warning">Payment Completed</div></td>';
						}
						if($row['appointment_status'] == 5){
							echo '<td><div style="padding: 5px 24px;" class="label label-success">Completed</div></td>';
						}
						 ?>
						<td>
						<ul class="list-inline">
							<li>
								<!-- Enabled only when appointment status is accepted = 2  -->
								<a href="?completed_id=<?=$row['id'] ?>" class="btn btn-info btn-xs <?=($row['appointment_status'] == 4)? '' : 'disabled' ?>">Complete</a>
							</li>
							<li>
								<a href="?accept_id=<?=$row['id'] ?>" class="btn btn-success btn-xs <?=($row['appointment_status'] == 4 || $row['appointment_status'] == 5)? 'disabled' : '' ?>">Accept</a>
							</li>
							<li>
								<a href="?decline_id=<?=$row['id'] ?>" class="btn btn-warning btn-xs <?=($row['appointment_status'] == 4 || $row['appointment_status'] == 5)? 'disabled' : '' ?>">Decline</a>
							</li>
							<li>
								<a href="view_request_details.php?app_id=<?=$row['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-external-link"></span></a>
							</li>
							<li>
								<a href="?del_id=<?=$row['id'] ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
							</li>
						</ul>
						</td>
						
		  			</tr>	
				<?php }
				} ?>
	  			</tbody>
	  		</table>
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