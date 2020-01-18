<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 
	if($_GET['del_id']){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$del_id = $_GET['del_id'];
		$delSql = "UPDATE services 
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
    <h1 class="jumbotron text-center">Manage Payments</h1>
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
	  		<h3><span class="fa fa-list"></span> Payments List</h3>
	  		
	  		<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<table class="table table-striped">
	  			<thead>
	  				<tr>
	  					<th>
	  						Payment ID
	  					</th>
	  					<th>
	  						Customer Name
	  					</th>
	  					<th>
	  						Total Amount
	  					</th>
	  					<th>
	  						Payment Status
	  					</th>
	  					<th>
	  						Details
	  					</th>
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  					$sql = "SELECT p.id, a.customer_id, p.amount, p.status FROM payments AS p JOIN appointments AS a ON p.appointment_id = a.id";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){?>

		  			<tr>
						<td><?=$row['id'] ?></td>
						<td><?=getCustomerNameFromId($con, $row['customer_id']) ?></td>
						<td><?=$row['amount'] ?> BD</td>
						<?php 
						// STATUS
						if($row['status'] == 1){
							echo '<td><div style="padding: 5px 24px;" class="label label-warning">Payment Due</div></td>';
						}
						if($row['status'] == 2){
							echo '<td><div style="padding: 5px 24px;" class="label label-success">Payment Received</div></td>';
						}
						 ?>
 						<td style="width: 15%">
						<ul class="list-inline">
							<li>
								<?php 
								if($row['status'] == 1){
									echo 'N/A';
								}
								if($row['status'] == 2){
									echo '
								<a href="view_payment_details.php?payment_id='.$row['id'].'" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>';
								}

								 ?>
							</li>
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