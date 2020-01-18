<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/lazer';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {
       $json = file_get_contents('php://input');
         $obj = json_decode($json);
         $customer_id = $obj->{'customer_id'}; 
         $name = $obj->{'name'};
         $email = $obj->{'email'};
         $contact = $obj->{'contact'};
         $reg_no = $obj->{'reg_no'};
         $brand_name = $obj->{'car_manufacturer'};
         $model_name = $obj->{'car_model_name'};
         $model_year = $obj->{'car_model_year'};
         $car_location = $obj->{'car_location'};  
         $requestDate = $obj->{'request_date'};  
         $serviceItemList = $obj->{'service_item_list'};

      $sql = "INSERT INTO `appointments`( `customer_id`, `reg_no`, `cus_name`, `cus_email`, `cus_contact`, `vehicle_brand`, `vehicle_model_year`, `vehicle_model_name`,`car_location`, `_datetime`) VALUES ('$customer_id', '$reg_no', '$name', '$email', '$contact', '$brand_name', '$model_year', '$model_name', '$car_location', '$requestDate' ) ";


      if(mysqli_query($con,$sql)) {
         $request_id = $con->insert_id;
         $response['request_id'] = $request_id;  

         $requestPosted = true;
      }

        if($requestPosted == true){
           foreach ($serviceItemList as $key => $item) { 

           $serviceItemSql = "INSERT INTO appointment_services (appointment_id, service_id) 
           VALUES ($request_id, $item->id)";

           $con->query($serviceItemSql);      
  
           } // /foreach

        $valid = true;
        $msg = "Car Wash booked successfully. Request ID:".$request_id;
         $response["success"] = 1;
         $response["message"] = $msg;
         echo json_encode($response);  
      }else {
         $response["success"] = 0;
         $response["message"] = "failed to insert record!";
         echo json_encode($response);
      }
   }
?>