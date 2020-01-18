<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/lazer';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();


   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
      
      
         $sql = "SELECT * FROM services WHERE
          status = 1 
          ORDER BY name";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);
         
         if($count >= 1) {
            $dataList = array();
            while ($row = mysqli_fetch_assoc($result)) {
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