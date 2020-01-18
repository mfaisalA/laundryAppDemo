<?php require_once('includes/system_header.php'); ?>
<?php require_once('functions.php'); ?>
<?php 

  if(isset($_SESSION['workshop_id'])){
    $workshopId = $_SESSION['workshop_id'];
  }

	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
    extract($post);
		$valid = 0;
		$msg = "Something went wrong unable to process your request!";
    
    $sql = "INSERT INTO workshop_brands (workshop_id, brand_id) 
    VALUES ('$workshopId', '$brand_id')";
    if(mysqli_query($con, $sql)){
      $valid = 1;
      $msg = "Record added successfully";
    }

		header('location: ?success='.$valid.'&msg='.$msg);
	}
 ?>

<section id="main">
  <div class="container">
  	<div class="row">
    <a href="system_manage_brands.php" class="no_style_link"><h1 class="jumbotron text-center">Manage Vehicle Brands</h1></a>
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
                            <label for="brand_name">Select Brand</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="brand_id" id="brand_id" 
       class="form-control">
       <option value="" selected disabled> --- --- --- Select Brand --- --- ---</option>
       <?php 
        $sqlBrand = "SELECT * FROM vehicle_brands 
        WHERE status = 1";
        $rsBrand = mysqli_query($con, $sqlBrand);
        while ( $rowBrand = mysqli_fetch_assoc($rsBrand)) {
          $selected = $_POST['brand_id'] == $rowBrand['id'] ? 'selected' : '';
          echo '
          <option '.$selected.' value="'.$rowBrand['id'].'">'.$rowBrand['name'].'</option>
          ';
        }
        
        ?>
     </select>
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