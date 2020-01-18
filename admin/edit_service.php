<?php require_once("includes/session.php"); ?>
<?php include_once '../config.php' ?>
<?php 
    $edit = null;
    $service_id = null;
    if($_GET['service_id']){
        $service_id = $_GET['service_id'];
        $selSql = "SELECT * FROM services 
        WHERE id = $service_id";
        $rs = mysqli_query($con, $selSql);
        $edit = mysqli_fetch_assoc($rs);
    }else{
        header('location: manage_services.php?success=false&msg=Requested record not found !');
    }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
        $valid = false;
        $msg = "Something went wrong unable to process your request!";
        $sql = "UPDATE services 
        SET name = '$service_name', charges = '$service_charges'
        WHERE id = $service_id ";
        if(mysqli_query($con, $sql)){
            $valid = true;
            $msg = "Record edit successfully";
        }

        header('location: manage_services.php?success='.$valid.'&msg='.$msg);
    }
 ?>

<?php include_once 'includes/header.php' ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Services</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
<section id="main">
  <div class="">
    <div class="row">
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
            <h3 class="text-center"> Edit Service</h3>
            
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <br>
            <div class="col-sm-8 col-sm-offset-2">
                <form action="" method="post">
                    <div class="form-group row">
                        <div class="col-sm-4"><label>Service ID</label>
                       </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="failure_id" name="service_id" value="<?=$edit['id'] ?>" disabled>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Service Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="service_name" value="<?=$edit['name'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Service Charges</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" step="0.05" name="service_charges" value="<?=$edit['charges'] ?>" required>
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
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once 'includes/footer.php' ?>


    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    
    <script src="../vendor/jquery/jquery-ui.min.js"></script>
</body>

</html>
