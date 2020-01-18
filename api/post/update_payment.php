<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/e-laundry';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $json = file_get_contents('php://input');
      $obj = json_decode($json);
      $request_id = $obj->{'request_id'}; 
      $card_number = $obj->{'card_number'}; 
      $card_name = $obj->{'card_name'}; 

      $sql = "UPDATE appointments SET appointment_status = 4 
      WHERE id = $request_id";
		
      if(mysqli_query($con,$sql)) {

         $sql2 = "UPDATE payments SET card_number = '$card_number', name = '$card_name', status = 2
         WHERE appointment_id = $request_id";

         if(mysqli_query($con,$sql2)) {
         $response["success"] = 1;
         $response["message"] = "payment comleted successfully";
         }else{
         $response["success"] = 0;
         $response["message"] = "payment error";

         }
         echo json_encode($response);  
      }else {
         $response["success"] = 0;
         $response["message"] = "failed to insert record!";
         echo json_encode($response);
      }
   }
?>