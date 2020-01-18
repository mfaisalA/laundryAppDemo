<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/e-laundry';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   	extract($post);      

      $sql = "INSERT INTO complaints (name, email, contact, complaint) 
      VALUES( '$name', '$email', '$contact', '$complaint')";
		
      if(mysqli_query($con,$sql)) {
         $response["success"] = 1;
         $response["message"] = "Complaint submitted sucessfully";
         echo json_encode($response);  
      }else {
         $response["success"] = 0;
         $response["message"] = "failed to insert record!";
         echo json_encode($response);
      }
   }
?>