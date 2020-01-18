<?php include_once('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=constant('APP_NAME') ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="vendor/jquery/jquery-ui.min.css">
    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Architects+Daughter|Frijole|Righteous" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <nav class="navbar navbar-inverse navbar-static-top navbar-fixed-top">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><?=constant('APP_NAME') ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

      <ul class="nav navbar-nav navbar-right">        

        <li id="navIndex"><a href="index.php"><i class="glyphicon glyphicon-home"></i>  Home</a></li>        
        

        <!-- <li id="navFindGarage"><a href="find_workshop.php"> <i class=" glyphicon glyphicon-search"></i> Find Workshop</a>
        </li> -->

        <!-- <li id="navAbout"><a href="about.php"><i class="glyphicon glyphicon-education"></i>  About</a></li>        
        <li id="navContact"><a href="contact.php"> <i class="glyphicon glyphicon-phone-alt"></i> Contact</a></li>
         -->
         <?php
          if(!isset($_SESSION['workshop_id'])){
            echo '<li id="navSignin"><a href="system_home.php"> <i class="fa fa-car"></i> My Workshop</a></li>';
          }
        ?>
         <?php
          if(!isset($_SESSION['workshop_id'])){
            echo '<li id="navRegister"><a href="register.php"> <i class="glyphicon glyphicon-new-window"></i> Register Workshop</a></li>';
          }
        ?>
        <?php
          if(isset($_SESSION['workshop_id'])){
            echo '<li id="navLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>';
          }
        ?>
                        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>