<!-- ADMIN HEADER FILE -->
<?php require_once('../config.php'); ?>
<?php require_once("session.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?='Admin-'.constant('APP_NAME')?></title>

    <link rel="stylesheet" href="vendor/jquery/jquery-ui.min.css">
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <nav class="navbar navbar-inverse navbar-static-top navbar-fixed-top" style="min-height: 100px">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"> <img style="width: 160px" src="../images/lazer-logo.png"></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      


      <ul class="nav navbar-nav " style="margin-left: 200px;margin-top:-50px; ">        
        

        <li id="navPenAppointments"><a href="index.php"><i class="glyphicon glyphicon-list"></i>  Pending Requests</a></li>  
        <li id="navAllAppointments"><a href="all_requests.php"><i class="glyphicon glyphicon-edit"></i>  All Requests</a></li>        
        

        <li id="navManServices"><a href="manage_services.php"> <i class=" glyphicon glyphicon-wrench"></i> Manage Services </a></li>

       <!--  <li id="navBrand"><a href="manage_brands.php"><i class="fa fa-car"></i>  Manage Vehicle Brands</a></li>  --> 
        <li id="navBrand"><a href="manage_payments.php"><i class="fa fa-money"></i>  Manage Payments</a></li>      
        <li id="navBrand"><a href="manage_customers.php"><i class="fa fa-user"></i>  Manage Customers</a></li>       
              
        <li id="navReport"><a href="report.php"> <i class="fa fa-check-square-o"></i> Reports</a></li>  
        <?php
          if(isset($_SESSION['admin_id'])){
            echo '<li><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>';
          }
        ?>
                        
      </ul>
      <ul  class="nav navbar-nav navbar-right">
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>
  <br><br>