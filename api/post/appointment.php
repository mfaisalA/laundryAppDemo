<?php
$webRoot =  $_SERVER['DOCUMENT_ROOT'].'/e-laundry';
include($webRoot."/config.php");
include($webRoot."/functions.php");
   session_start();

   $response = array();
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {
       $json = file_get_contents('php://input');
         $obj = json_decode($json);
         $customer_id = $obj->{'customer_id'}; 
         $name = $obj->{'customer_name'};
         $email = $obj->{'customer_email'};
         $contact = $obj->{'customer_contact'};
         $location = $obj->{'customer_location'};  
         $deliveryType = $obj->{'delivery_type'};  
         $paymentType = $obj->{'payment_type'};  
         $pickupDateTime = $obj->{'pickup_date_time'};  
         $deliveryDate = $obj->{'delivery_date_time'};  
         $serviceItemList = $obj->{'service_item_list'};
         $totalAmount = $obj->{'total_amount'};

      $sql = "INSERT INTO `appointments`( `customer_id`, `cus_name`, `cus_email`, `cus_contact`, `location`, delivery_type, payment_type, `_datetime`, delivery_date, total_amount) VALUES ('$customer_id', '$name', '$email', '$contact', '$location', '$deliveryType', '$paymentType', '$pickupDateTime', '$deliveryDate', '$totalAmount' ) ";


      if(mysqli_query($con,$sql)) {
         $request_id = $con->insert_id;
         $response['request_id'] = $request_id;  

         $requestPosted = true;
      }

        if($requestPosted == true){
           foreach ($serviceItemList as $key => $item) { 

           $serviceItemSql = "INSERT INTO appointment_services (appointment_id, service_id, qty) 
           VALUES ($request_id, $item->id, $item->qty)";

           $con->query($serviceItemSql);      
  
           } // /foreach

        $valid = true;
        $msg = "Laundry booked successfully. Request ID:".$request_id;
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