<?php require_once('includes/header.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 

if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");


	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");


	$sql = "SELECT * FROM appointments 
		WHERE  DATE(_datetime) >= '$start_date' AND DATE(_datetime) <= '$end_date' AND appointment_status != 1 AND status = 1";

	$result = $con->query($sql);
	echo $sql;
	

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
	<tr><th colspan="6"> General Report</th></tr>
		<tr>
			<th>Request ID</th>
			<th>Customer Name</th>
			<th>Customer Email</th>
			<th>Appointment Date</th>
			<th>Status</th>
		</tr>

		<tr>';
		$totalAccepted = 0;
		$totalDeclined = 0;
		$totalCompleted = 0;
		$status = null;
		while ($appointment = $result->fetch_assoc()) {
			if($appointment['appointment_status'] == 2){
				$status = "Accepted";
				$totalAccepted++;
			}
			if($appointment['appointment_status'] == 3){
				$status = "Declined";
				$totalDeclined++;
			}
			if($appointment['appointment_status'] == 5){
				$status = "Completed";
				$totalCompleted++;
			}
			$table .= '<tr>
				<td><center>'.$appointment['id'].'</center></td>
				<td><center>'.getCustomerNameFromId($con, $appointment['customer_id']).'</center></td>
				<td><center>'.$appointment['cus_email'].'</center></td>
				<td><center>'.$appointment['_datetime'].'</center></td>
				<td><center>'.$status.'</center></td>
			</tr>';	
		}
		$table .= '
		</tr>
		<tr>
			<th colspan="3" >Total Accepted</th>
			<td colspan="3"><center>'.$totalAccepted.'</center></td>
		</tr>
		<tr>
			<th colspan="3" >Total Declined</th>
			<td colspan="3"><center>'.$totalDeclined.'</center></td>
		</tr>
		<tr>
			<th colspan="3" >Total Completed</th>
			<td colspan="3"><center>'.$totalCompleted.'</center></td>
		</tr>';

	$table .= '	
	</table>
	';	

	echo $table;

}

?>