<?php require_once("includes/session.php"); ?>
<?php include_once '../functions.php' ?>
<?php 
    if($_GET['del_id']){
        $valid = false;
        $msg = "Something went wrong unable to process your request!";
        $del_id = $_GET['del_id'];
        $delSql = "UPDATE appointments 
        SET status = 0 
        WHERE id = $del_id";
        if(mysqli_query($con, $delSql)){
            $valid = true;
            $msg = "Record deleted successfully";
        }

        header('location: ?success='.$valid.'&msg='.$msg);
    }
 ?>
 
<?php include_once 'includes/header.php' ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">laundary History</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row --><section id="main">
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
            <h3><span class="fa fa-archive"></span> Laundary List</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
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
                            Pickup Date
                        </th>
                        <th>
                            Request Date
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
                    $sql = "SELECT * FROM appointments 
                    WHERE status = 1 
                    ORDER BY created_date DESC";
                    $rs = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($rs)){?>

                    <tr>
                        <td><?=$row['id'] ?></td>
                        <td><?=ucwords($row['cus_name']) ?></td>
                        <td><?=$row['cus_email'] ?></td>
                        <td><?=$row['total_amount'] ?>  BD</td>
                        <td><?=date('d/M/y h:iA', strtotime($row['_datetime']))?></td>
                        <td><?=date('d/M/y h:iA', strtotime($row['created_date'])) ?></td>

                        
                        <?php 
                        // SET APPOINTMENT STATUS
                            if($row['appointment_status'] == 1){
                            echo '<td><div style="padding: 5px 24px;" class="label label-warning">Pickup Pending</div></td>';
                        }
                        if($row['appointment_status'] == 2){
                            echo '<td><div style="padding: 5px 24px;" class="label label-info">In-Progress</div></td>';
                        }
                        if($row['appointment_status'] == 3){
                            echo '<td><div style="padding: 5px 24px;" class="label label-danger">Declined</div></td>';
                        }
                        if($row['appointment_status'] == 4){
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
            </table>
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
