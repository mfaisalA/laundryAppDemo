<?php include_once("includes/config.php"); ?>

<?php
$response = array('data' => array(), 'success' => false);
// $response['success'] = false;
// 	$response['data'] = array();

  if(isset($_GET['brand_id'])){
  	$brandId = $_GET['brand_id'];

  	$sql = "SELECT id, name FROM vehicle_model_names 
    WHERE vehicle_brand_id = $brandId AND status = 1";
    $rs = mysqli_query($con, $sql);
                        
  	if($rs = mysqli_query($con, $sql)){
	  	while($row = mysqli_fetch_assoc($rs)){
	  		$response['data'][] = $row;
	  	}
	  	$response['success'] = true;
  	}
  }

	echo json_encode($response);
 ?>