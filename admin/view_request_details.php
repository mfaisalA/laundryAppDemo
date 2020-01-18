<?php require_once("includes/session.php"); ?>
<?php include_once 'includes/header.php' ?>
<?php include_once '../functions.php' ?>
<?php 
    if($_GET['app_id']){
        $row ="";
        $valid = false;
        $msg = "Something went wrong unable to process your request!";
        $app_id = $_GET['app_id'];
        $sql = "SELECT * FROM appointments 
        WHERE id = $app_id";
        if($rs = mysqli_query($con, $sql)){
            $row = mysqli_fetch_assoc($rs);
            $valid = true;
            $msg = "Record retured successfully";
        }else{
            header('location: index.php?success='.$valid.'&msg='.$msg);
        }
    }else{
        $msg = "Selected record does not exist";
        header('location: index.php?success='.$valid.'&msg='.$msg);
    }
 ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Laundry Records</h1>
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
            <h3 class="text-center"><span class="fa fa-edit"></span> Laundry Details</h3>
        </div>
        <div class="panel-body">
            <div class="">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="th-dark-bg" >Customer Name</th>
                        <th style="width: 75%"><?=ucwords($row['cus_name']) ?></th>
                    </tr>
                    <tr>
                        <th class="th-dark-bg" >Customer Email</th>
                        <th style="width: 75%"><?=ucwords($row['cus_email']) ?></th>
                    </tr>
                    <tr>
                        <th  class="th-dark-bg">Customer Contact</th>
                        <th style="width: 75%"><?=ucwords($row['cus_contact']) ?></th>
                    </tr>

                    <tr>
                        <th  class="th-dark-bg">Customer Location</th>
                        <th style="width: 75%"><?=$row['location'] ?></th>
                    </tr>
                    

                     <tr>
                        <th  class="th-dark-bg">Required Service</th>
                        <th style="width: 75%">
                            <table class="table table-border">
                                <thead>
                                <tr><th>Item Name</th><th>Quantity</th></tr>
                                </thead>
                                <tbody>
                        <?php 
                            $serSql = "SELECT ser.name, app.qty FROM appointment_services AS app JOIN services  AS ser 
                            ON app.service_id = ser.id 
                            WHERE app.appointment_id = {$row['id']}";
                            $rs = mysqli_query($con, $serSql);

                            while($laundryItems = mysqli_fetch_assoc($rs)){?>
                                <tr><td><?php echo $laundryItems['name'] ?></td>
                                    <td><?php echo $laundryItems['qty'] ?></td>
                                </tr>
                            
                            <?php } ?>
                        </tbody>
                        </table>

                        
                        </th>
                    </tr>


                    <tr>
                        <th  class="th-dark-bg">Addtional Instructions</small></th>
                        <th style="width: 75%"><?=empty($row['additional_instructions']) ? 'N/A' : $row['additional_instructions'] ?></th>
                    </tr>

                    <tr>
                        <th  class="th-dark-bg">Total Charges</th>
                        <th style="width: 75%"><?=$row['total_amount'] ?> BD</th>
                    </tr>
                    <!-- <tr>
                        <th >Special Request</th>
                        <th style="width: 75%"><?=$row['description'] ?></th>
                    </tr> -->
                    <tr>
                        <th  class="th-dark-bg">Laundry Pickup Date</th>
                        <th style="width: 75%"><?=date('d/M/y h:iA', strtotime($row['_datetime'])) ?></th>
                    </tr>
                    <tr>
                        <th  class="th-dark-bg">Delivery Date</th>
                        <th style="width: 75%"><?=date('d/M/y', strtotime($row['delivery_date'])) ?></th>
                    </tr>
                    <?php
                    $status = null; 
                         if($row['appointment_status'] == 1){
                            $status = '<div style="padding: 5px 24px;" class="label label-warning">Pickup Pending</div>';
                        }
                        if($row['appointment_status'] == 2){
                            $status = '<div style="padding: 5px 24px;" class="label label-info">In-Progress</div>';
                        }
                        if($row['appointment_status'] == 3){
                            $status = '<div style="padding: 5px 24px;" class="label label-danger">Declined</div>';
                        }
                        if($row['appointment_status'] == 4){
                            $status = '<div style="padding: 5px 24px;" class="label label-success">Delivered</div>';
                        }
                     ?>
                    <tr>
                        <th  class="th-dark-bg">Appointment Status</th>
                        <th style="width: 75%"><?=$status ?></th>
                    </tr>
                    <tr>
                        <th  class="th-dark-bg">Request Date</th>
                        <th style="width: 75%"><?= date('d/M/y h:iA', strtotime($row['created_date'])) ?></th>
                    </tr>

                </tbody>
            </table>
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
