<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>

<section id="main" class="">
    <div class="container">
        <div class="row">
        <h1 class="jumbotron text-center">Reports</h1>
        <div class="panel panel-default">
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
                      <button type="submit" class="btn btn-warning" id="printReportBtn"> <i class="glyphicon glyphicon-print"></i> Print Report</button>
                    </div>
                  </div>
                </form>
            </div>
            </div>
        </div>


        </div>
    </div>

</section>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/import_scripts.php'; ?>

    <script>
       $(document).ready(function() {

    //$('#navReport').addClass('active'); 
    // order date picker
    $("#startDate").datepicker();
    // order date picker
    $("#endDate").datepicker();

    // $("#getReportForm").unbind('submit').bind('submit', function() {

    //     var form = $(this);

    //     $.ajax({
    //         url: form.attr('action'),
    //         type: form.attr('method'),
    //         data: form.serialize(),
    //         dataType: 'text',
    //         success:function(response) {
    //             var mywindow = window.open('', 'Car Wash System', 'height=400,width=600');
    //     mywindow.document.write('<html><head><title>Requests Report</title>');        
    //     mywindow.document.write('</head><body>');
    //     mywindow.document.write(response);
    //     mywindow.document.write('</body></html>');

    //     mywindow.document.close(); // necessary for IE >= 10
    //     mywindow.focus(); // necessary for IE >= 10

    //     mywindow.print();
    //     mywindow.close();
    //         } // /success
    //     }); // /ajax

    //     return false;
    // });

});
    </script>
</body>
</html>