<?php require_once('includes/config.php'); ?>
<?php require_once('functions.php'); ?>

<?php require_once('includes/header.php'); ?>
<?php 
    $workshopID = null;
	if($_GET['workshop_id']){
		$workshopID = $_GET['workshop_id'];
	}else{
		//header('location: error_page.php');
	}

    if(isset($_POST['check_btn'])){
        $appId = $_POST['app_id'];
        $sql = "SELECT * FROM appointments 
        WHERE id = $appId AND workshop_id =  $workshopID AND appointment_status = 1 AND status = 1";
        $rs = mysqli_query($con, $sql);
        if(mysqli_num_rows($rs) > 0){
            $edit = mysqli_fetch_assoc($rs);
        }else{
            $valid = 0;
            $msg = "Appointment does not exist";
        header('location: appointment_success.php?workshop_id='.$workshopID.'&success='.$valid.'&msg='.$msg);
        }
    }

    if(isset($_POST['delete_btn'])){
        $appId = $_POST['app_id'];
        $sql = "UPDATE appointments 
        SET status = 0
        WHERE id = $appId AND workshop_id =  $workshopID AND appointment_status = 1 AND status = 1";
        if(mysqli_query($con, $sql)){
            $valid = 1;
            $msg = "Appointment deleted successfully";
        header('location: appointment_success.php?workshop_id='.$workshopID.'&success='.$valid.'&msg='.$msg);
        }else{
            $valid = 0;
            $msg = "An error occured appointment could not be deleted";
        header('location: appointment_success.php?workshop_id='.$workshopID.'&success='.$valid.'&msg='.$msg);
        }
    }

    
    if(isset($_POST['update_btn'])){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        extract($post);
        $valid = "";
        $msg = "";    
        //Set pickup location
        if(!$pickup_location){
            $pickup_location = "";
        }

        // format appointment date and time to insert in db
        $dateTimeStr = $pref_date.'-'.$pref_time;
        $appDateTime = DateTime::createFromFormat('m/d/Y-H', $dateTimeStr);
        $appDateTimeStr = $appDateTime->format("Y-m-d H:i:s");

        $sql = "UPDATE `appointments` SET `cus_name`='$customer_name',`cus_email`='$customer_email',`cus_contact`='$customer_contact',`vehicle_brand_id`=$brand_id,`vehicle_model_year`='$model_year',`vehicle_model_name`='$model_name',`pickup_required`=$pickup_options,`pickup_location`='$pickup_location',`failure_desc`='$failure_desc',`_datetime`='$appDateTimeStr' WHERE id = $appointment_id";
        if(mysqli_query($con, $sql)){
            // deleted previusly added expected failure
            $delSql = "DELETE FROM `appointment_exp_failures` WHERE appointment_id = $appointment_id";
            mysqli_query($con, $delSql);
            //insert expected failures of this appointment in 'appointment_exp_failures' Table
            if($expected_failures){
                foreach ($expected_failures as $key => $value) {
                    $insSql = "INSERT INTO appointment_exp_failures (appointment_id, expected_failure_id) 
                    VALUES($appointment_id, $value)";
                    if(mysqli_query($con, $insSql)){            
                        $valid = true;
                        $msg = "Appointment updated successfully";
                    }else{
                        //log error
                    }
                }
            }
            $valid = true;
            $msg = "Appointment updated successfully. Appointment ID: ".$appointment_id."";
        }else{
            $valid = false;
            $msg = "Something went wrong unable to book your appointment at the moment!";
        }

        header('location: appointment_success.php?workshop_id='.$workshopID.'&success='.$valid.'&msg='.$msg);

    }
?>

<section id="main">
  <div class="container">

    <div class="row">
    <br>
    <div class="banner">
      <div class="col-sm-4">
        <img src="images/auto_mech.png" class="pull-left" alt="">
      </div>
      <div class="col-sm-4 banner-title">
      <h2 class=""> Book an Appointment with our Registered Workshop </h2>
      </div>
      <div class="col-sm-4">
        <img src="images/images12.jpg" class="pull-right" alt="">
      </div>
      <div class="clearfix"></div>
    </div>

    <?php include_once('includes/search_bar.php'); ?>

    <div class="col-md-3">
    	<div class="panel panel-default side-panel">
            <?php 
                $sql = "SELECT * FROM workshops 
                WHERE id = $workshopID AND status = 1";
                $rs = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($rs);
             ?>
    		<div class="panel-body">
    			<h2><?=$row['name'] ?></h2>
    			<h4><?=getAreaNameFromId($con, $row['area']) ?></h4>
              <div class="brand-logos">
                <ul class="list-inline">
                    <?php
                    $logoSql = "SELECT vb.image FROM vehicle_brands AS vb JOIN workshop_brands AS wb ON vb.id = wb.brand_id 
                    WHERE wb.workshop_id = '$workshopID' AND vb.status = 1 AND wb.status = 1" ;
                    $logoRs = mysqli_query($con, $logoSql);
                    while ($logo = mysqli_fetch_row($logoRs)[0]) {
                      echo '<li><img src="images/brand_logos/'.$logo.'" alt="" style="width: 32px;"></li>';
                    }
                   ?>

                </ul>
              </div>
              <div>
                <h3>Location</h3>
                <p><?=$row['location'] ?></p>
              </div>

    		</div>    		
    	</div>
      <br>
    </div>


    <div class="col-md-9">
    	
    	<div class="panel panel-default form-panel">
            <div id="errorDiv" class="col-sm-10 col-sm-offset-1">
                <?php
                if(isset($_GET['success'])){//if isset success
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
    		<h2 class="text-center">EDIT APPOINTMENT</h2>
            <br>
    		<div class="panel-body">
    			<form id="appointment_form" name="appointment_form" action="" method="post">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="app_id">Appointment ID</label>
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="app_id" name="app_id" placeholder="Enter appointment id" value="<?=$edit['id'] ?>" required>
                        </div>
                        <div class="col-sm-4">
                            <div class="pull-right">
                            <button class="btn btn-success" name="check_btn"> Check</button>
                            <?php 
                            $disabled = (isset($edit['id']) ? "" : "disabled") ?>
                            <button class="btn btn-danger <?=$disabled ?>" name="delete_btn"><span class="fa fa-trash"></span> Delete</button>
                            </div>
                        </div>

                    </div>
                    <!-- FORM-GROUP ENDS -->
                </form>
                <form id="appointment_form" name="appointment_form" action="" method="post">
                    <input type="hidden" name="appointment_id" value="<?=$edit['id'] ?>">
    				<div class="form-group row">
    					<div class="col-sm-4">
    						<label for="customer_name">Customer Name</label>
    					</div>
    					<div class="col-sm-8">
    						<input class="form-control" type="text" id="customer_name" name="customer_name" placeholder="Enter your name" value="<?=$edit['cus_name']  ?>" required>
    					</div>
    				</div>
    				<!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="customer_email">Customer Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" id="customer_email" name="customer_email" placeholder="Enter your email" value="<?=$edit['cus_email'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
    				<div class="form-group row">
    					<div class="col-sm-4">
    						<label for="customer_contact">Customer Contact</label>
    					</div>
    					<div class="col-sm-8">
    						<input class="form-control" type="tel" pattern="^((?!(0))[0-9]{8})" id="customer_contact" name="customer_contact" placeholder="Enter your contact" value="<?=$edit['cus_contact'] ?>" required>
    					</div>
    				</div>
    				<!-- FORM-GROUP ENDS -->
    				<div class="form-group row">
    					<div class="col-sm-4">
    						<label for="brand_id">Select Brand</label>
    					</div>
    					<div class="col-sm-8">
    						<select class="form-control" name="brand_id" id="brand_id">
                                <?php
                    $sql = "SELECT id, name FROM vehicle_brands
                    WHERE id in (SELECT brand_id FROM workshop_brands
                    WHERE workshop_id = {$row['id']} AND status = 1)  AND status = 1";
                    $rs = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($rs)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        if($id == $edit['vehicle_brand_id']){
                            echo '
                        <option value="'.$id.'" selected>'.$name.'</option>
                        ';
                        }else{
                            echo '
                        <option value="'.$id.'">'.$name.'</option>
                        ';
                        }
                        
                    }
                    ?>
    						</select>
    					</div>
    				</div>
    				<!-- FORM-GROUP ENDS -->

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="model_name">Model <small>(Name)</small></label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="model_name" id="model_name">
                            </select>
                        </div>
                        <!-- hidden input for selecting right option -->
                        <input type="hidden" id="hidden_model_name" value="<?=$edit['vehicle_model_name']  ?>" >
                    </div>
                    <!-- FORM-GROUP ENDS -->
    				<div class="form-group row">
    					<div class="col-sm-4">
    						<label for="model_year">Select Model <small>(Year)</small></label>
    					</div>
    					<div class="col-sm-8">
    						<select class="form-control" name="model_year" id="model_year">
                                <?php 
                                    $year = 1960;
                                    while($year <= 2018){
                                        $selected = '';
                                        if($year == $edit['vehicle_model_year']) $selected = 'selected';
                                        echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';

                                        $year++;
                                    }
                                 ?>
                            </select>
    					</div>
    				</div>
    				<!-- FORM-GROUP ENDS -->
                    
    				<div id="radio_btn_div"  class="form-group row">
    					<div class="col-sm-4">
    						<label for="pickup">Pickup Required</label>
    					</div>
    					<div class="col-sm-8">
    						<div class="btn-group" data-toggle="buttons">
                            <?php 
                            $checkedYes = "";
                            $checkedNo = "";
                            $activeYes = "";
                            $activeNo = "";
                            if($edit['pickup_required'] == 1){
                                $checkedYes = "checked";
                                $activeYes = "active";

                            }else{
                                $checkedNo = "checked";
                                $activeNo = "active";
                            }
                            ?>
						  <label class="btn btn-default <?=$activeYes ?>">
						    <input type="radio" name="pickup_options" id="option_yes" autocomplete="off" value="true" <?=$checkedYes ?>> Yes
						  </label>
						  <label class="btn btn-default <?=$activeNo ?>">
						    <input type="radio" name="pickup_options" id="option_no" autocomplete="off" value="false"  <?=$checkedNo ?>> No
						  </label>
						</div>
    					</div>
    				</div>
    				<!-- FORM-GROUP ENDS -->
                    <input type="hidden" id="pick_loc_hidden" value="<?=$edit['pickup_location'] ?>">
        <!-- FORM-GROUP ENDS -->
        <div id="failure-checkboxes"  class="form-group row">
            <div class="col-sm-4">
                <label for="expected_failures">Expected Failure In</label>
            </div>
            <div class="col-sm-8">
                <ul class="list-inline">
                <?php
                    $sql = "SELECT * FROM expected_failures 
                    WHERE status = 1";
                    $rs = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($rs)) {
                        $id = $row['id'];
                        $name = $row['name'];

                        $failureList = array();
                        if(isset($edit['id'])){
                        $failureList = getExpectedFailureList($con, $edit['id']);
                        }

                        if(in_array($id, $failureList)){
                            echo '
                        <li><input name="expected_failures['.$id.']" type="checkbox" checked value="'.$id.'">
                            '.$name.' 
                        </li>
                        ';

                        }else{
                            echo '
                        <li><input name="expected_failures['.$id.']" type="checkbox" value="'.$id.'">
                            '.$name.' 
                        </li>
                        ';

                        }
                        
                    }
                ?>
                </ul>
            </div>
        </div>
        <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="failure_desc">Failure Description</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="failure_desc" name="failure_desc" required><?=$edit['failure_desc'] ?></textarea>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <?php 
                        $date = date('d/m/Y', strtotime($edit['_datetime']));
                        $time = date('G', strtotime($edit['_datetime']));
                     ?>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="pref_date">Preffered Date</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" id="pref_date" name="pref_date" value="<?=$date ?>">
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS --><div class="form-group row">
                        <div class="col-sm-4">
                            <label for="pref_time">Preffered Time</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="pref_time" id="pref_time">
                                <?php
                                $_time = 8; // 8:00 AM
                                    while($_time <= 20){//20 = 8:00 PM
                                        $selected = '';
                                        if($_time == $time) $selected = 'selected';
                                        echo '<option value="'.$_time.'" '.$selected.'>'.convert24Time($_time).'</option>';

                                        $_time++;
                                    }
                                 ?>
                            </select>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="row" >
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <button class="btn-submit-ap btn btn-primary btn-block" id="submitBtn" name="update_btn">Update</button>
                    </div>
                    </div>
                    

    			</form>
    		</div>
    	</div>
    </div>

    </div>
     <!-- ROW ENDS -->
  </div>
</section>

<?php require_once('includes/footer.php'); ?>
</body>
<?php require_once('includes/import_scripts.php'); ?>
<script src="js/edit_appointment.js"></script>
</html>