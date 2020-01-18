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
              <br>
              <a href="edit_appointment.php?workshop_id=<?=$workshopID?>" class="btn btn-default">Edit Appointment</a>


    		</div>    		
    	</div>
      <br>
    </div>


    <div class="col-md-9">
        <?php 
            if(isset($_GET['success'])){//if isset success
                if($_GET['success'] == true){
                    echo '
        <div class="alert alert-success text-center">
          <br>
          <h4>'.$_GET['msg'].'</h4>
          <br>
        </div>';
                }else{
                    echo '
        <div class="alert alert-danger text-center">
          <br>
          <h4>'.$_GET['msg'].'</h4>
          <br>
        </div>';
                } 
            }
         ?>
    </div>

    </div>
     <!-- ROW ENDS -->
  </div>
</section>

<?php require_once('includes/footer.php'); ?>
</body>
<?php require_once('includes/import_scripts.php'); ?>
<script src="js/single_workshop.js"></script>
</html>