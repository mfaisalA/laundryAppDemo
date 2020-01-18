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
    <h1 class="jumbotron text-center">Manage Services</h1>
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
	  		<a href="add_service.php" class="btn btn-primary btn-add"><span class="fa fa-plus"></span> Add</a>
	  		<h3><span class="fa fa-list"></span> Services List</h3>
	  		
	  		<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<table class="table table-striped">
	  			<thead>
	  				<tr>
	  					<th>
	  						ID
	  					</th>
	  					<th>
	  						Service Name
	  					</th>
	  					<th>
	  						Service Charges
	  					</th>
	  					<th>
	  						Action
	  					</th>
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  					$sql = "SELECT * FROM services 
  					WHERE status = 1";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){?>

		  			<tr>
						<td><?=$row['id'] ?></td>
						<td><?=$row['name'] ?></td>
						<td><?=$row['charges'] ?> BD</td>
 						<td style="width: 15%">
						<ul class="list-inline">
							<li>
								<a href="edit_service.php?service_id=<?=$row['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>
							</li>
							<li>
								<a href="?del_id=<?=$row['id'] ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
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