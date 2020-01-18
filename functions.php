<?php 
function convert24Time($time24){
    // converting time from 24 hours to 12
	$pTime = DateTime::createFromFormat('H', $time24 );
	return $pTime->format('h A');
}

function uploadImage($file, $uniqueName, $directory){
	 $response = array();

      $file_name = $file['name'];
      $file_size =$file['size'];
      $file_tmp_path =$file['tmp_name'];
      $file_type=$file['type'];
      $file_ext=strtolower(end(explode('.',$file['name'])));
    
      $extensions= array("png", "jpg", "jpeg");
    
      if(in_array($file_ext,$extensions)=== false){
        $errors[]="Invalid file type, please choose a PNG/JPG/JPEG.";
      }
    
       
      $MB = 1048576;  // 1048576 = 1MB
      // max size 2 MB
      if($file_size > 2*$MB || $file_size == 0){
        $errors[]='Image size must be less than 2 MB';
      }

      if(empty($errors)){
	    $new_name = $uniqueName.rand(100,10000).'.'.$file_ext;
	    $path = $directory.$new_name;

	    if(move_uploaded_file($file_tmp_path, $path)){
	    	$response['success'] = true;
	    	$response['img_saved_name'] = $new_name;
	    }else{
	    	$response['success'] = false;
	    	$response['msg'] = "Error uploading file!";
	    }

	    
	  }else{
	  	    $response['success'] = false;
	    	$response['msg'] = implode(' | ',$errors);
	  }

	  return $response;

}

function sendMail($fromname, $fromaddress, $toaddress, $subject, $message){

		$headers  = "MIME-Version: 1.0\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "X-Mailer: php\n";
		$headers .= "From: \"".$fromname."\" <".$fromaddress.">\r\n";
		if(mail($toaddress, $subject, $message, $headers)){
			return true;
		}
		else{
			return false;

		}
	}

function getMaxId($con, $tableName){
	$sql = "SELECT MAX(id) FROM $tableName";
    $rs = $con->query($sql);
    return $rs->fetch_row()[0];
}

function getCustomerNameFromId($con, $customer_id){
	$sql = "SELECT name FROM customers 
	WHERE id = $customer_id";
	$rs = mysqli_query($con, $sql);
	$name = mysqli_fetch_row($rs)[0];
	return $name;
}

function getBrandNameFromId($con, $brand_id){
	$sql = "SELECT name FROM vehicle_brands 
	WHERE id = $brand_id";
	$rs = mysqli_query($con, $sql);
	$brandName = mysqli_fetch_row($rs)[0];
	return $brandName;

}

function getModelNameFromId($con, $model_id){
	$sql = "SELECT name FROM vehicle_model_names 
	WHERE id = $model_id";
	$rs = mysqli_query($con, $sql);
	$modelName = mysqli_fetch_row($rs)[0];
	return $modelName;

}

function getAreaNameFromId($con, $area_id){
	$sql = "SELECT name FROM areas 
	WHERE id = $area_id";
	$rs = mysqli_query($con, $sql);
	$areaName = mysqli_fetch_row($rs)[0];
	return $areaName;

}

function getExpectedFailureList($con, $appointment_id){
	$sql = "SELECT expected_failure_id FROM appointment_exp_failures 
	WHERE appointment_id = $appointment_id";
	$rs = mysqli_query($con, $sql);
	$list = array();
	while ( $row = mysqli_fetch_row($rs)) {
		array_push($list, $row['0']); 
	}
	return $list;
}

function getTotalServiceCharges($con, $appointment_id){
	$rs = mysqli_query($con, "SELECT SUM(services.charges) AS charges
	 FROM appointment_services JOIN services  ON appointment_services.service_id = services.id
		WHERE appointment_services.appointment_id = $appointment_id");
	$charges = mysqli_fetch_row($rs)[0];
	return $charges;

}
?>