<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
    extract($post);
		$valid = 0;
		$msg = "Something went wrong unable to process your request!";

    //uploading image to server

    $maxId = getMaxId($con, 'vehicle_brands');
    $directory = '../images/brand_logos/';
    $response = uploadImage($_FILES['brand_logo'], $maxId+1, $directory);
    if($response['success'] == true){
      $imageSaved = $response['img_saved_name'];
      $sql = "INSERT INTO vehicle_brands (name, image) 
      VALUES ('$brand_name', '$imageSaved')";
      if(mysqli_query($con, $sql)){
        $valid = 1;
        $msg = "Record added successfully";
      }
    }else{
      $msg = $response['msg'];
    }

		header('location: ?success='.$valid.'&msg='.$msg);
	}
 ?>

<section id="main">
  <div class="container">
  	<div class="row">
    <a href="manage_brands.php" class="no_style_link"><h1 class="jumbotron text-center">Manage Vehicle Brands</h1></a>
    <div id="errorDiv" class="col-sm-8 col-sm-offset-2">
  	<?php
                if(isset($_GET['success'])){
                    if($_GET['success'] == 1){
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
	  		<h3 class="text-center"> Add Brand</h3>
	  		
	  		<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<br>
	  		<div class="col-sm-8 col-sm-offset-2">
	  			<form action="" method="post" enctype="multipart/form-data">
	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="brand_name">Brand Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="brand_name" name="brand_name" placeholder="Enter brand name" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
            <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="brand_logo">Upload Brand Logo</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="file" id="brand_logo" name="brand_logo" required>
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