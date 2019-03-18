<?php
require_once 'db_function.php';
$db=new db_function();

$response=array();

if (
    isset($_POST['date'])
	&& isset($_POST['receiverNumber'])
    && isset($_POST['senderNumber']) 
    && isset($_POST['dateandtime'])
    &&isset($_POST['itemname'])
    &&isset($_POST['quantity'])
    &&isset($_POST['price'])
    &&isset($_POST['confromstatus'])
    && isset($_POST['accept'])
) {
		
		
	$date=$_POST['date'];
	$mynumber = $_POST['receiverNumber'];
	$senderNumber = $_POST['senderNumber'];
	$dateandtime = $_POST['dateandtime'];
	$itemname = $_POST['itemname'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$confromstatus = $_POST['confromstatus'];
	$accept = $_POST['accept'];

//$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus
	$result=$db->insertintotheReceiverTable($date,$mynumber,$senderNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus,$accept);
	
	if($result){
		$response["result"]="ok";
		echo json_encode($response);
	}else{
		$response["result"]="not";
		echo json_encode($response);
	}
    
} else {
    $response["error_msg"]="Required parameter (number) is missing";
    echo json_encode($response);
}
?>