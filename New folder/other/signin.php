<?php
  session_start();
  require_once 'includes/config.php';

  $signin_valid = 0;

  if(isset($_POST['signinBtn'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
      $username = mysqli_escape_string($con, $_POST['username']);
      $password = mysqli_escape_string($con, $_POST['password']);

      $pswd_hash = md5($password);

      $sql = "SELECT * FROM workshops WHERE login_username = '$username' AND login_password = '$pswd_hash' AND is_active = 1 AND status = 1 ";
      
      if($result = $con->query($sql)) {
        //success
        if($result->num_rows == 1){
          $row = $result->fetch_assoc();
          $_SESSION['workshop_id'] = $row['id'];
          $_SESSION['workshop_name'] = $row['name'];

          $signin_valid = 1;
          header('location: system_home.php');

        }else{
          $signin_valid = 2;
        }
      }else{
        //error
        $signin_valid = 2;
      }

    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=constant("APP_NAME") ?></title>

    <link rel="stylesheet" href="vendor/jquery/jquery-ui.min.css">
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
  
<main style="background:#31585F; color: #ececec; height: 800px; padding-top:5%;">
  <div class="container">
      <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 text-center">
      <img src="assets/images/logo.png" alt="">
        <h1 style="font-weight: bolder;"><?=constant("APP_NAME") ?></h1>
        <br>
      </div>
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 signin-box">
        <h2 class="text-center">Workshop Login</h2>
        <br>
        <form class="form-horizontal" id="signinForm" action="signin.php" method="POST">
              
              <div id="signin-user-messages"></div>

              <div class="form-group">
                <label for="username" class="col-sm-4 control-label">Username </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="username" placeholder="Username" name="username" autocomplete="off" required>
                </div>
              </div> <!-- /form-group-->
              <div class="form-group">
                <label for="password" class="col-sm-4 control-label">Password </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-7">
                  <input type="password" class="form-control" id="password" placeholder="password" name="password" autocomplete="off" required>
                </div>
              </div> <!-- /form-group-->   
            
            <div class="form-footer clearfix">          
              <button type="submit" class="btn btn-default pull-right" id="signinBtn" name="signinBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
            </div> <!-- /modal-footer -->       
          </form> <!-- /.form --> 
          <br>

          <?php
            if($signin_valid == 1){
            }
            if($signin_valid == 2){
              echo '<div class="alert alert-danger text-center" style="margin-bottom:2px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong>  Invalid username or password</div>';
            }
          ?>   
          </div>
    </div> 
  </div>
</main>
</body>
<?php require_once('includes/import_scripts.php'); ?>
</html>