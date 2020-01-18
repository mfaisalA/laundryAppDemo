<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 
	if($_GET['del_id']){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$del_id = $_GET['del_id'];
		$delSql = "DELETE FROM customers 
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
    <h1 class="jumbotron text-center">Manage Customers</h1>
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
	  		<h3><span class="fa fa-list"></span> Customers List</h3>
	  		
	  		<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<table class="table table-striped">
	  			<thead>
	  				<tr>
	  					<th>
	  						Customer ID
	  					</th>
	  					<th>
	  						Username
	  					</th>
	  					<th>
	  						Customer Name
	  					</th>
	  					<th>
	  						Customer Email
	  					</th>
	  					<th>
	  						Customer Contact
	  					</th>
	  					<th>
	  						Customer Address
	  					</th>
	  					
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  					$sql = "SELECT * FROM customers";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){?>

		  			<tr>
						<td><?=$row['id'] ?></td>
						<td><?=$row['username'] ?> </td>
						<td><?=$row['name']?></td>
						<td><?=$row['email'] ?> </td>
						<td><?=$row['contact'] ?> </td>
						<td><?=$row['address'] ?> </td>
						
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