<?php require_once('includes/header.php'); ?>
<?php require_once('functions.php'); ?>
<?php 
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
    extract($post);
		$valid = 0;
		$msg = "Something went wrong unable to process your request!";

    //uploading image to server

    $maxId = getMaxId($con, 'workshops');
    $directory = 'images/';
    $response = uploadImage($_FILES['workshop_dp'], $maxId+1, $directory);
    if($response['success'] == true){
      $pswd_hash = md5($login_password);
      $imageSaved = $response['img_saved_name'];
      $sql = "INSERT INTO workshops (name, contact, email, area, location, image, login_username, login_password) 
      VALUES ('$workshop_name', '$workshop_contact', '$workshop_email', '$workshop_area', '$workshop_location', '$imageSaved', '$login_username', '$pswd_hash')";
      if(mysqli_query($con, $sql)){
        $valid = 1;
        $msg = "Workshop registered successfully";
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
    <a href="manage_workshops.php" class="no_style_link"><h1 class="jumbotron text-center">Register Auto Workshop</h1></a>
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
	  		<h3 class="text-center"> Workshop Detials</h3>
	  		
	  		<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<br>
	  		<div class="col-sm-8 col-sm-offset-2">
	  			<form action="" method="post" enctype="multipart/form-data">
	  				<div class="form-group row">
                <div class="col-sm-4">
                    <label>Workshop Name</label>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="workshop_name" placeholder="Enter workshop name" required>
                </div>
              </div>
              <!-- FORM-GROUP ENDS -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label>Workshop Email</label>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" type="email" name="workshop_email" placeholder="Enter workshop email" required>
                </div>
              </div>
              <!-- FORM-GROUP ENDS -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label>Workshop Contact</label>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="workshop_contact" placeholder="Enter workshop contact" required>
                </div>
              </div>
              <!-- FORM-GROUP ENDS -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label>Workshop Area</label>
                </div>
                <div class="col-sm-8">
                    <select class="form-control" name="workshop_area" id="area" required>
                      <option value=""> -- Select Area -- </option>
                  <?php
                    $sql = "SELECT * FROM areas 
                    WHERE status = 1";
                    $rs = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($rs)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        echo '
                        <option value="'.$id.'">'.$name.'</option>
                        ';
                    }
                    ?>
                </select>
                </div>
              </div>
              <!-- FORM-GROUP ENDS -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label>Workshop Location</label>
                </div>
                <div class="col-sm-8">
                    <textarea class="form-control" name="workshop_location" required></textarea>
                </div>
              </div>
              <!-- FORM-GROUP ENDS -->
              <div class="form-group row">
                  <div class="col-sm-4">
                      <label for="workshop_dp">Upload Display Picture</label>
                  </div>
                  <div class="col-sm-8">
                      <input class="form-control" type="file" id="workshop_dp" name="workshop_dp" required>
                  </div>
              </div>
              <!-- FORM-GROUP ENDS -->

            <div class="form-group row">
                <div class="col-sm-4">
                    <label>Login Username</label>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="login_username" placeholder="Enter login username" required>
                </div>
              </div>
              <!-- FORM-GROUP ENDS -->

            <div class="form-group row">
                <div class="col-sm-4">
                    <label>Login Password</label>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" type="password" name="login_password" placeholder="Enter login password" required>
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
