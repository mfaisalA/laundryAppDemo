<?php require_once("includes/session.php"); ?>
<?php include_once '../config.php' ?>

<?php 
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
        $valid = false;
        $msg = "Something went wrong unable to process your request!";
        $sql = "INSERT INTO services (name, charges) 
        VALUES ('$service_name', '$service_charges')";
        if(mysqli_query($con, $sql)){
            $valid = true;
            $msg = "Record added successfully";
        }

        header('location: ?success='.$valid.'&msg='.$msg);
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

      <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="text-center"><span class="fa fa-cog"></span> Add Service</h3>
            
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <br>
            <div class="col-sm-8 col-sm-offset-2">
                <form action="" method="post">
            <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Service Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="service_name" name="service_name" placeholder="Enter Service Name" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
            <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Service Charges</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" step="0.05" name="service_charges" placeholder="Enter Service Charges" required>
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
