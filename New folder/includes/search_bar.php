<div class="search_bar">
  <!-- START SEARCH FORM -->
    <form action="find_workshop.php" method="post" class="form form-inline pull-right">
    <label for="">Search By: </label>
     <div class="form-group">
     <label for="search_str">Name</label>
       <input type="text" class="form-control" id="search_str" name="search_str" placeholder="Workshop Name" value="">
     </div>
     <div class="form-group">
        <label for="sLocation">Location</label>
       <select name="sLocation" id="sLocation" 
       class="form-control">
       <option value="" selected disabled> -- Select Area --</option>
       <option value=""> All</option>
       <?php 
        $sqlLoc = "SELECT * FROM areas 
        WHERE status = 1";
        $rsLoc = mysqli_query($con, $sqlLoc);
        while ( $rowLoc = mysqli_fetch_assoc($rsLoc)) {
          $selected = $_POST['sLocation'] == $rowLoc['id'] ? 'selected' : '';
          echo '
          <option '.$selected.' value="'.$rowLoc['id'].'">'.$rowLoc['name'].'</option>
          ';
        }
        
        ?>
     </select>
     </div>
     <div class="form-group">
        <label for="sBrand">Vehicle Brand</label>
       <select name="sBrand" id="sBrand" 
       class="form-control">
       <option value="" selected disabled> -- Select Brand --</option>
       <option value=""> All</option>
       <?php 
        $sqlBrand = "SELECT * FROM vehicle_brands 
        WHERE status = 1";
        $rsBrand = mysqli_query($con, $sqlBrand);
        while ( $rowBrand = mysqli_fetch_assoc($rsBrand)) {
          $selected = $_POST['sBrand'] == $rowBrand['id'] ? 'selected' : '';
          echo '
          <option '.$selected.' value="'.$rowBrand['id'].'">'.$rowBrand['name'].'</option>
          ';
        }
        
        ?>
     </select>
     </div>
    <button class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Search</button>
    </form>
    <div class="clearfix"></div>
                  <!-- END SEARCH FORM -->
</div>