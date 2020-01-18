<?php require_once("includes/session.php"); ?>
<?php include_once '../config.php' ?>
<?php include_once '../functions.php' ?>
<?php 

    

    if(isset($_GET['accept_id'])){
        $valid = false;
        $msg = "Something went wrong unable to process your request!";
        $accept_id = $_GET['accept_id'];
        $acceptSql = "UPDATE appointments 
        SET appointment_status = 2 
        WHERE id = $accept_id";
        $totalAmount = getTotalServiceCharges($con, $accept_id);
        if(mysqli_query($con, $acceptSql)){
            mysqli_query($con, "INSERT INTO payments (appointment_id, amount) VALUES($accept_id, $totalAmount)");

            //send mail
            // $sqlMail = "SELECT * FROM appointments 
            // WHERE id = $accept_id";
            // $rsMail = mysqli_query($con, $sqlMail);
            // $rowMail = mysqli_fetch_assoc($rsMail);
            // $toName =$rowMail['cus_name'];
            // $toEmail =$rowMail['cus_email'];
            // $workshopName =getWorkshopNameFromId($con, $rowMail['workshop_id']);
            // $loc =$rowMail['location'];
            // $apDate = DateTime::createFromFormat('Y-m-d H:i:s', $rowMail['_datetime']);
            // $appointmentDate = $apDate->format('d/M/Y h:iA');

            // //echo "<br><br><br><br><br><br>";
            // $subject = "Vehicle Service Appointment Accepted";
            // $message = "<table><tr><td> Dear ".ucfirst($toName)."</td></tr><tr><td></td></tr><tr><td>Your appointment for vehicle service with <b>".$workshopName."</b> on <b>".$appointmentDate."</b> has been accepted with Appointment ID:<b>".$rowMail['id']."</b> .</tr></td><tr><td>-----------------------------------------------------------------<tr><td> If you have any questions or concerns please contact us at <a href=''>support@autogarage.com.</a></tr></td><tr><td></tr></td><tr><td><br><br>Regards,<br><br>".constant('APP_NAME')." Team</td></tr><tr><td></td></tr><tr><td>---------------------------------------------------------------</td></tr></table>";
            // //echo $message;
            // $fromName = constant('APP_NAME');
            // $fromEmail = "noreply@autogarage.com";

            // sendMail($fromName, $fromEmail, $toEmail, $subject, $message);
            $valid = true;
            $msg = "Booking accepted successfully";
        }

        header('location: ?success='.$valid.'&msg='.$msg);

    }
    if(isset($_GET['decline_id'])){
        $valid = false;
        $msg = "Something went wrong unable to process your request!";
        $decline_id = $_GET['decline_id'];
        $decSql = "UPDATE appointments 
        SET appointment_status = 3 
        WHERE id = $decline_id";
        if(mysqli_query($con, $decSql)){
            //send mail
            // $sqlMail = "SELECT * FROM appointments 
            // WHERE id = $decline_id";
            // $rsMail = mysqli_query($con, $sqlMail);
            // $rowMail = mysqli_fetch_assoc($rsMail);
            // $toName =$rowMail['cus_name'];
            // $toEmail =$rowMail['cus_email'];
            // $workshopName =getWorkshopNameFromId($con, $rowMail['workshop_id']);
            // $loc =$rowMail['location'];
            // $apDate = DateTime::createFromFormat('Y-m-d H:i:s', $rowMail['_datetime']);
            // $appointmentDate = $apDate->format('d/M/Y h:iA');

            // //echo "<br><br><br><br><br><br>";
            // $subject = "Vehicle Service Appointment Declined";
            // $message = "<table><tr><td> Dear ".ucfirst($toName)."</td></tr><tr><td></td></tr><tr><td>Your appointment for vehicle service with <b>".$workshopName."</b> on <b>".$appointmentDate."</b> has been declined .</tr></td><tr><td>-----------------------------------------------------------------<tr><td> If you have any questions or concerns please contact us at <a href=''>support@autogarage.com.</a></tr></td><tr><td></tr></td><tr><td><br><br>Regards,<br><br>".constant('APP_NAME')." Team</td></tr><tr><td></td></tr><tr><td>---------------------------------------------------------------</td></tr></table>";
            // //echo $message;
            // $fromName = constant('APP_NAME');
            // $fromEmail = "noreply@autogarage.com";

            // sendMail($fromName, $fromEmail, $toEmail, $subject, $message);
            $valid = true;
            $msg = "Booking declined successfully";
        }

        header('location: ?success='.$valid.'&msg='.$msg);

    }
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
                    <h1 class="page-header">Pending laundry</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <section id="main">
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
            <h3><span class="fa fa-list"></span> Booking List</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
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
                            Request Date
                        </th>
                        <th>
                            Pickup Date
                        </th>
                        <th>
                            Delivery Type
                        </th>
                        <th>
                            Payment Type
                        </th>
                        <th>
                            Total Charges
                        </th>
                        <th>
                            Laundry Status
                        </th>
                        <th style="width: 20%"> <center>    
                            Action
                        </center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM appointments 
                    WHERE status = 1 AND appointment_status = 1
                    ORDER BY _datetime DESC";
                    $rs = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($rs);
                    if($count == 0){
                        echo '<tr><th colspan="11"><center>No appointments pending </center></th></tr>';
                    }else{

                    while ($row = mysqli_fetch_assoc($rs)){?>

                    <tr>
                        <td><?=$row['id'] ?></td>
                        <td><?=ucwords($row['cus_name']) ?></td>
                        <td><?=$row['cus_email'] ?></td>

                        <td><?=date('d/M/y h:iA', strtotime($row['created_date'])) ?></td>
                        <td><?=date('d/M/y h:iA', strtotime($row['_datetime']))?></td>
                        <td><?=ucwords($row['delivery_type']) ?></td>
                        <td><?=ucwords($row['payment_type']) ?></td>
                        <td><?=$row['total_amount'] ?> BD</td>

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
                                <a href="?accept_id=<?=$row['id'] ?>" class="btn btn-success btn-xs">Picked Up</a>
                            </li>
                            <li>
                                <a href="?decline_id=<?=$row['id'] ?>" class="btn btn-danger btn-xs">Rejected</a>
                            </li>
                            <li>
                                <a href="view_request_details.php?app_id=<?=$row['id'] ?>" class="btn btn-primary btn-xs"><span class="fa fa-external-link"></span></a>
                            </li>
                            <!-- <li>
                                <a href="?del_id=<?=$row['id'] ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                            </li> -->
                        </ul>
                        </td>
                        
                    </tr>   
                <?php }
                } ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
    <!-- .ROW -->
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
