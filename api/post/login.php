<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/e-laundry';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($con,$_POST['username']);
      $password = mysqli_real_escape_string($con,$_POST['password']);
	  
      $sql = "SELECT * FROM customers WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($result);
      //$active = $row['active'];
	  
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //$_SESSION['user_id'] = $row['id'];

         $response['customer_info'] = $row;

         // $imagedata = file_get_contents($row['image']);
         //  // alternatively specify an URL, if PHP settings allow
         // $response['base64_image'] = base64_encode($imagedata);
          
         
         $response["success"] = 1;
         $response["message"] = "Login Successful ";
         echo json_encode($response);
      }else {

         $response["success"] = 0;
         $response["message"] = "Login Failed, Invalid username or password";
         echo json_encode($response);
      }
   }
?>