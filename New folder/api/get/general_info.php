<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/lazer';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();


   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
         $customer_id = $_GET['customer_id'];
      
      
         $sql = "SELECT _datetime FROM appointments WHERE customer_id = $customer_id AND _datetime >= now() AND appointment_status = 4 AND
          status = 1 
          ORDER BY _datetime";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);

         if($count == 0) {
            $response['next_carwash'] = "";
         }else{
            $_date = mysqli_fetch_row($result)[0];
            $response['next_carwash'] = date('d/M/y h:iA', strtotime($_date));
            
         }      

         $sql = "SELECT id FROM payments WHERE customer_id = $customer_id AND  status = 1 ";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);

         $response['pending_payments'] = $count;



         $sql = "SELECT id FROM appointments WHERE customer_id = $customer_id AND status = 1 ";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);

         $response['total_carwash'] = $count;



         $response["success"] = 1;
         $response["message"] = "request successful";
      echo json_encode($response);
   }
?>