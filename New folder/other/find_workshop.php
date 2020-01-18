<?php include_once('includes/header.php'); ?>
<?php include_once('functions.php'); ?>



<section id="main">
  <div class="container">

    <div class="row">
    <br>
    <div class="banner">
      <div class="col-sm-4">
        <img src="images/auto_mech.png" class="pull-left" alt="">
      </div>
      <div class="col-sm-4 banner-title">
      <h2 class=""> Find the best Auto Workshops near you </h2>
      </div>
      <div class="col-sm-4">
        <img src="images/images12.jpg" class="pull-right" alt="">
      </div>
      <div class="clearfix"></div>
    </div>
    <?php include_once('includes/search_bar.php'); ?>
    <div class="col-md-3">
      <img style="width: 100%;" class="img-responsive" src="images/vertical_banner_1.jpg" alt="">
      <br>
    </div>


    <div class="col-md-9">
      <?php 
        // generating search query from post values coming from 'search_bar.php'
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($post){
          extract($post);
          $queryOptions = "";
          if(isset($sLocation) && !empty($sLocation)){
            $queryOptions .= "area = $sLocation AND ";
          }

          if(isset($sBrand) && !empty($sBrand)){
            // subQuery on workshop_brands table
            $queryOptions .= "id IN (SELECT workshop_id FROM workshop_brands 
            WHERE brand_id = $sBrand AND status = 1) AND";
          }
          $sql = "SELECT * FROM workshops 
        WHERE ".$queryOptions." name LIKE '%$search_str%'  AND is_active = 1 AND status = 1";
        }else{
          $sql = "SELECT * FROM workshops 
        WHERE is_active = 1 AND status = 1";
        }
        $rs = mysqli_query($con, $sql);
        $rowCount = mysqli_num_rows($rs);
        if($rowCount == 0){?>
        <div>
          <br><br><br><br>
          <h3 class="text-center"> No Workshop Found </h3>
        </div>
        <?php }else{

        while ($row = mysqli_fetch_assoc($rs)) {?>

         <!-- Single ITEM START -->
      <div class="panel panel-default single_item">
        <div class="panel-body">
          <a href="single_workshop.php?workshop_id=<?=$row['id'] ?>">
          <div class="col-md-3">
            <img src="images/<?=$row['image'] ?>" style="width: 120px;height: 120px">
          </div>
          <div class="col-md-9">
            <div class="col-md-7">
              <h3><?=$row['name'] ?></h3>
              <h4><?=getAreaNameFromId($con,$row['area']) ?></h4>
              <div class="brand-logos">
                <ul class="list-inline">
                  <?php
                    $logoSql = "SELECT vb.image FROM vehicle_brands AS vb JOIN workshop_brands AS wb ON vb.id = wb.brand_id 
                    WHERE wb.workshop_id = {$row['id']} AND vb.status = 1 AND wb.status = 1" ;
                    $logoRs = mysqli_query($con, $logoSql);
                    while ($logo = mysqli_fetch_row($logoRs)[0]) {
                      echo '<li><img src="images/brand_logos/'.$logo.'" alt="" style="width: 32px;"></li>';
                    }
                   ?>

                </ul>
              </div>
              </div>
              <div class="col-md-5">
                <h3>Location</h3>
                <p><?=$row['location'] ?></p>
              </div>
            </div>
            </a>
            
          </div>
        </div>
     <!-- Single ITEM ENDS -->
     <?php }} ?>

      </div>

    </div>
     <!-- ROW ENDS -->
  </div>
</section>

<?php include_once('includes/footer.php'); ?>
</body>
</html>