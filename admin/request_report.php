<?php require_once("includes/session.php"); ?>
<?php include_once '../config.php' ?>
<?php include_once '../functions.php' ?>
<?php 
if($_POST) {

    $startDate = $_POST['startDate'];
    $date = DateTime::createFromFormat('m/d/Y',$startDate);
    $start_date = $date->format("Y-m-d");


    $endDate = $_POST['endDate'];
    $format = DateTime::createFromFormat('m/d/Y',$endDate);
    $end_date = $format->format("Y-m-d");


    $sql = "SELECT * FROM appointments 
    WHERE DATE(_datetime) >= '$start_date' AND DATE(_datetime) <= '$end_date' AND appointment_status != 1 AND status = 1 
    ORDER BY created_date DESC";
    $rs = mysqli_query($con, $sql);
    }

    ?>

<?php include_once 'includes/header.php' ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Report</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<section id="main">
  <div class="">
    <div class="row">
      <div class="clearfix"></div>
            <br>

      <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="text-center"><span class="fa fa-files-o"></span> Request Report</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Customer Name
                        </th>
                        <th>
                            Customer Email
                        </th>
                        
                        <th>
                            Total Charges
                        </th>
                        <th>
                            Request Date
                        </th>
                        <th>
                            Pickup Date
                        </th>
                        <th>
                            Delivery Date
                        </th>
                        <th>
                            Laundry Status
                        </th>
                        <th>
                            Details
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php

                    $totalRequests = 0;
                    $totalAccepted = 0;
                    $totalDeclined = 0;
                    $totalCompleted = 0;
                    $totalAmount = 0;
                    while ($row = mysqli_fetch_assoc($rs)){
                        $totalRequests++;
                        $totalAmount = $totalAmount + $row['total_amount'];

                        ?>

                    <tr>
                        <td><?=$row['id'] ?></td>
                        <td><?=ucwords($row['cus_name']) ?></td>
                        <td><?=$row['cus_email'] ?></td>
                        <td><?=$row['total_amount'] ?>  BD</td>
                        <td><?=date('d/M/y h:iA', strtotime($row['created_date'])) ?></td>
                        <td><?=date('d/M/y h:iA', strtotime($row['_datetime']))?></td>
                        <td><?=date('d/M/y h:iA', strtotime($row['delivery_date']))?></td>

                        
                        <?php 
                        // SET APPOINTMENT STATUS
                        if($row['appointment_status'] == 1){

                            echo '<td><div style="padding: 5px 24px;" class="label label-warning">Pickup Pending</div></td>';
                        }
                        if($row['appointment_status'] == 2){
                            $totalAccepted++;
                            echo '<td><div style="padding: 5px 24px;" class="label label-info">In-Progress</div></td>';
                        }
                        if($row['appointment_status'] == 3){
                            $totalDeclined++;
                            echo '<td><div style="padding: 5px 24px;" class="label label-danger">Rejected</div></td>';
                        }
                        if($row['appointment_status'] == 4){
                            $totalCompleted++;
                            echo '<td><div style="padding: 5px 24px;" class="label label-success">Delivered</div></td>';
                        }
                         ?>
                        <td>
                        <ul class="list-inline">
                            <li>
                                <a href="view_request_details.php?app_id=<?=$row['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-external-link"></span></a>
                            </li><!-- 
                            <li>
                                <a href="?del_id=<?=$row['id'] ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                            </li> -->
                        </ul>
                        </td>
                        
                    </tr>   
                <?php } ?>
                </tbody>
                </tbody>
            </table>

            <div style="float: right;width: 40%">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Total Requests</th>
                        <th><?php echo $totalRequests; ?></th>
                    </tr>
                    <tr>
                        <th>Total Delivered</th>
                        <th><?php echo $totalCompleted; ?></th>
                    </tr>
                    <tr>
                        <th>Total Pick Up</th>
                        <th><?php echo $totalAccepted; ?></th>
                    </tr>
                    <tr>
                        <th>Total Rejected</th>
                        <th><?php echo $totalDeclined; ?></th>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <th><?php echo $totalAmount; ?> BD</th>
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
