<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/e-laundry';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();


   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
         $customer_id = $_GET['customer_id'];
      
      
         

         $sql = "SELECT id FROM appointments WHERE customer_id = $customer_id AND appointment_status = 1 AND status = 1 ";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);

         $response['pending'] = $count;
         

         $sql = "SELECT id FROM appointments WHERE customer_id = $customer_id AND appointment_status = 2 AND status = 1 ";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);

         $response['in_process'] = $count;


         

         $sql = "SELECT id FROM appointments WHERE customer_id = $customer_id AND appointment_status = 3 AND status = 1 ";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);

         $response['canceled'] = $count;
         

         $sql = "SELECT id FROM appointments WHERE customer_id = $customer_id AND appointment_status = 1 AND status = 1 ";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);

         $response['pending'] = $count;



         $sql = "SELECT id FROM appointments WHERE customer_id = $customer_id AND status = 1 ";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);

         $response['all'] = $count;



         $response["success"] = 1;
         $response["message"] = "request successful";
      echo json_encode($response);
   }
?>