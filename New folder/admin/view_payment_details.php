<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 
	if($_GET['payment_id']){
		$row ="";
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$payment_id = $_GET['payment_id'];
		$sql = "SELECT p.id, a.customer_id, p.card_number, p.name,  p.amount, p.created_date, p.status FROM payments AS p JOIN appointments AS a ON p.appointment_id = a.id
		WHERE p.id = $payment_id";
		if($rs = mysqli_query($con, $sql)){
			$row = mysqli_fetch_assoc($rs);
			$valid = true;
			$msg = "Record retured successfully";
		}else{
			header('location: ?success='.$valid.'&msg='.$msg);
		}
	}else{
		$msg = "Selected record does not exist";
		header('location: ?success='.$valid.'&msg='.$msg);
	}
 ?>

<section id="main">
  <div class="container">
  	<div class="row">
    <a class="no_style_link" href="all_requests.php"><h1 class="jumbotron text-center">Manage Payments</h1></a>
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
	  		<h3 class="text-center"><span class="fa fa-newspaper-o"></span> Payment Details</h3>
	  	</div>
	  	<div class="panel-body">
	  		<div class=" col-sm-8 col-sm-offset-2">
	  		<table class="table table-bordered">
	  			<tbody>
	  				<tr>
	  					<th >Customer Name</th>
	  					<th style="width: 75%"><?=ucwords(getCustomerNameFromId($con, $row['customer_id'])) ?></th>
	  				</tr>
	  				<tr>
	  					<th >Card Number</th>
	  					<th style="width: 75%"><?=$row['card_number']?></th>
	  				</tr>
	  				<tr>
	  					<th >Total Amount</th>
	  					<th style="width: 75%"><?=$row['amount'] ?></th>
	  				</tr>

	  				<tr>
	  					<th >Payment Date</th>
	  					<th style="width: 75%"><?=date('d/M/y', strtotime($row['created_date'])) ?></th>
	  				</tr>
	  				
	  				<tr>
	  					<th >Payment Status</th>

	  				<?php
	  				$status = null; 
	  					if($row['status'] == 1){
	  						$status = 'Payment Due';
	  					} 
	  					if($row['status'] == 2){
	  						$status = 'Payment Received';
	  					} 
	  				 ?>
	  					<th style="width: 75%">
	  						<?= $status ?>
	  					</th>
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