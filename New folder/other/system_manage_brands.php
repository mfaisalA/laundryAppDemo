<?php require_once('includes/system_header.php'); ?>
<?php require_once('functions.php'); ?>
<?php 
	if($_GET['del_id']){
		$valid = 0;
		$msg = "Something went wrong unable to process your request!";
		$del_id = $_GET['del_id'];
		$delSql = "UPDATE workshop_brands 
		SET status = 0 
		WHERE id = $del_id";
		if(mysqli_query($con, $delSql)){
			$valid = true;
			$msg = "Record deleted successfully";
		}

		header('location: ?success='.$valid.'&msg='.$msg);
	}

	if(isset($_SESSION['workshop_id'])){
		$workshopId = $_SESSION['workshop_id'];
	}
 ?>

<section id="main">
  <div class="container">
  	<div class="row">
    <h1 class="jumbotron text-center">Manage Vehicle Brands</h1>
    <div id="errorDiv" class="col-sm-8 col-sm-offset-2">
  	<?php
                if(isset($_GET['success'])){
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
	  		<a href="system_add_brand.php" class="btn btn-primary btn-add"><span class="fa fa-plus"></span> Add</a>
	  		<h3><span class="fa fa-list"></span> Brands List</h3>
	  		
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
	  						Brand Name
	  					</th>
	  					<th>
	  						Brand Logo
	  					</th>
	  					<th>
	  						Action
	  					</th>
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  					$sql = "SELECT vb.id, vb.name, vb.image FROM workshop_brands AS wb JOIN vehicle_brands vb ON wb.brand_id = vb.id 
  					WHERE wb.workshop_id = '$workshopId' AND wb.status = 1";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){?>

		  			<tr>
						<td><?=$row['id'] ?></td>
						<td><?=$row['name'] ?></td>

						<td><img class="brand-logo" src="images/brand_logos/<?=$row['image'] ?>" alt=""></td>
 						<td style="width: 15%">
						<ul class="list-inline">
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