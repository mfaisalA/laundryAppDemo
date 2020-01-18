<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$sql = "INSERT INTO services (name, charges) 
		VALUES ('$service_name', '$service_charges')";
		if(mysqli_query($con, $sql)){
			$valid = true;
			$msg = "Record added successfully";
		}

		header('location: ?success='.$valid.'&msg='.$msg);
	}
 ?>

<section id="main">
  <div class="container">
  	<div class="row">
    <a href="manage_services.php" class="no_style_link"><h1 class="jumbotron text-center">Manage Services</h1></a>
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
	  		<h3 class="text-center"> Add Service</h3>
	  		
	  		<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<br>
	  		<div class="col-sm-8 col-sm-offset-2">
	  			<form action="" method="post">
            <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Service Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="service_name" name="service_name" placeholder="Enter Service Name" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
            <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Service Charges</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" step="0.05" name="service_charges" placeholder="Enter Service Charges" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="text-center">
                    <button class="btn btn-primary">Submit</button>
                	</div>
	  			</form>
	  			<br>
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