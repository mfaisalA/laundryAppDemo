<div class="search_bar">
  <!-- START SEARCH FORM -->
    <form action="" method="post" class="form form-inline pull-right">
    <label for="">Search By: </label>
     <div class="form-group">
     <label for="search_str">Name</label>
       <input type="text" class="form-control" id="search_str" name="search_str" placeholder="Search Name" value="">
     </div>
     <div class="form-group">
        <label for="sLocation">Location</label>
       <select name="sLocation" id="sLocation" 
       class="form-control">
       <option <?=($_POST['searchBy'] == 'uemail' ? 'selected' : '') ?> value="uemail">Username / Email</option>
       <option  <?=($_POST['searchBy'] == 'uname' ? 'selected' : '') ?> value="uname">Name</option>
       <option <?=($_POST['searchBy'] == 'umobile' ? 'selected' : '') ?> value="umobile">Contact</option>
     </select>
     </div>
     <div class="form-group">
        <label for="sBrand">Brand</label>
       <select name="sBrand" id="sBrand" 
       class="form-control">
       <option <?=($_POST['searchBy'] == 'uemail' ? 'selected' : '') ?> value="uemail">Username / Email</option>
       <option  <?=($_POST['searchBy'] == 'uname' ? 'selected' : '') ?> value="uname">Name</option>
       <option <?=($_POST['searchBy'] == 'umobile' ? 'selected' : '') ?> value="umobile">Contact</option>
     </select>
     </div>
    <button class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Search</button>
    </form>
    <div class="clearfix"></div>
                  <!-- END SEARCH FORM -->
</div>