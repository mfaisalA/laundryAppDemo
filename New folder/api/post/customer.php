<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/lazer';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   	extract($post);      

      $sql = "INSERT INTO customers (name, email, contact, address, username, password) 
      VALUES( '$name', '$email', '$contact', '$address', '$username', '$password')";
		
      if(mysqli_query($con,$sql)) {
         $response["success"] = 1;
         $response["message"] = "customer registered sucessfully";
         echo json_encode($response);  
      }else {
         $response["success"] = 0;
         $response["message"] = "failed to insert record!";
         echo json_encode($response);
      }
   }
?>