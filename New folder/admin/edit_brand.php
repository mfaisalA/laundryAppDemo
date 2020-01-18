<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 
	$edit = null;
	$brand_id = null;
	if($_GET['brand_id']){
		$brand_id = $_GET['brand_id'];
		$selSql = "SELECT * FROM vehicle_brands
		WHERE id = $brand_id";
		$rs = mysqli_query($con, $selSql);
		$edit = mysqli_fetch_assoc($rs);
	}else{
		header('location: manage_brands.php?success=false&msg=Requested record not found !');
	}

	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
		$valid = 0;
		$msg = "Something went wrong unable to process your request!";

	//check if image is changed
	$isQueryValid = false;
	$query ="";
	if(isset($_FILES['brand_logo']) && !empty($_FILES['brand_logo']['name'])){
		//uploading image to server
	    $directory = '../images/brand_logos/';
	    $response = uploadImage($_FILES['brand_logo'], $brand_id, $directory);
	    if($response['success'] == true){
	      	$imageSaved = $response['img_saved_name'];
			$query = "UPDATE vehicle_brands 
			SET name = '$brand_name', image = '$imageSaved'
			WHERE id = $brand_id ";
			$isQueryValid = true;
		}
	}else{//if not updating image
		$query = "UPDATE vehicle_brands 
			SET name = '$brand_name'
			WHERE id = $brand_id ";
			$isQueryValid = true;
	}

	if($isQueryValid == true){
		if(mysqli_query($con, $query)){
			$valid = 1;
			$msg = "Record edit successfully";
		}
	}else{
		$msg = $response['msg'];
	}

		header('location: manage_brands.php?success='.$valid.'&msg='.$msg);
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
	  		<h3 class="text-center"> Add Brands</h3>
	  		
	  		<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<br>
	  		<div class="col-sm-8 col-sm-offset-2">
	  			<form action="" method="post"  enctype="multipart/form-data">
	  				<div class="form-group row">
                        <div class="col-sm-4">Brand ID</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="brand_id" name="brand_id" value="<?=$edit['id'] ?>" disabled>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
            		<div class="form-group row">
		  				<div class="col-sm-4">
                            <label for="brand_name">Brand Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="brand_name" name="brand_name" value="<?=$edit['name'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
            		<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="brand_logo">Upload Brand Logo</label>
                        </div>
                        <div class="col-sm-8">
                        	<div class="row">
                        	<div class="col-sm-10">
                            <label class="form-control" for="upload">
						      <span class="fa fa-upload"></span> choose file... 
						      <input name="brand_logo" type="file" id="upload" style="display:none">
    						</label>
    						</div>
    						<div class="col-sm-2">
    							<img  class="brand-logo " src="../images/brand_logos/<?=$edit['image'] ?>" alt="">
    						</div>
    						</div>
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