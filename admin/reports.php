<?php require_once("includes/session.php"); ?>
<?php include_once '../functions.php' ?>
<?php include_once 'includes/header.php' ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reports</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<section id="main" class="">
    <div class="">
        <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3><span class="fa fa-check-square-o"></span> Reports</h3>
            </div>
            <div class="panel-body">
                <div class="col-sm-6 col-sm-offset-3">
                 <form class="form-horizontal" action="request_report.php" method="post" id="getReportForm">
                  <div class="form-group">
                    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="endDate" class="col-sm-2 control-label">End Date</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="endDate" name="endDate" placeholder="End Date" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-outline btn-primary" id="printReportBtn"> <i class="glyphicon glyphicon-print"></i> Print Report</button>
                    </div>
                  </div>
                </form>
            </div>
            </div>
        </div>


        </div>
    </div>

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
    <script>
       $(document).ready(function() {
        //$('#navReport').addClass('active'); 
        // order date picker
        $("#startDate").datepicker();
        // order date picker
        $("#endDate").datepicker();
    });
    </script>
</body>

</html>
