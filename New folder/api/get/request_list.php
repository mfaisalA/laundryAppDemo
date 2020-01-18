<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/lazer';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();


   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
      $customerId = mysqli_real_escape_string($con,$_GET['customer_id']);
      
      
         
         $sql = "SELECT * FROM appointments 
         WHERE customer_id = $customerId AND status = 1 
         ORDER BY created_date DESC";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);
         
         if($count >= 1) {
            $dataList = array();
            while ($row = mysqli_fetch_assoc($result)) {    
               $row['submit_date'] = date('d/M/Y', strtotime($row['created_date']));
               $row['request_time'] = date('h:i A', strtotime($row['_datetime']));
               $row['request_date'] =  date('d/M/Y ', strtotime($row['_datetime']));
               $row['request_status'] = $row['appointment_status'];
               $row['request_amount'] = getTotalServiceCharges($con, $row['id']);
               array_push($dataList, $row);
            }
            $response['data_list'] = $dataList;
            
            $response["success"] = 1;
            $response["message"] = "request successful";
         }else {
            $response["success"] = 0;
            $response["message"] = "no record found!";
         }
      
      echo json_encode($response);
   }
?>