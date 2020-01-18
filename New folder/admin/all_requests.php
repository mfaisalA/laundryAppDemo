<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 
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
    <h1 class="jumbotron text-center">All Requests</h1>
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
  					$sql = "SELECT * FROM appointments 
  					WHERE status = 1 
					ORDER BY created_date DESC";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){?>

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