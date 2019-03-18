<?php
require_once 'db_function.php';
$db=new db_function();

$response=array();

if (
    isset($_POST['date'])
	&& isset($_POST['mynumber'])
    && isset($_POST['receiverNumber']) 
    && isset($_POST['dateandtime'])
    && isset($_POST['itemname'])
    && isset($_POST['quantity'])
    && isset($_POST['price'])
    && isset($_POST['confromstatus'])
    && isset($_POST['expected_accept'])
) {
		
		
	$date=$_POST['date'];
	$mynumber = $_POST['mynumber'];
	$receiverNumber = $_POST['receiverNumber'];
	$dateandtime = $_POST['dateandtime'];
	$itemname = $_POST['itemname'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$confromstatus = $_POST['confromstatus'];
	$expected_accept = $_POST['expected_accept'];
//$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus
	$result=$db->insertintotheSenderTable($date,$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus,$expected_accept);
	
	if($result){
		
		echo json_encode("fine");
	}else{
		/*$response["result"]="not";*/
		echo json_encode("not");
	}
 
} else {
    //$response["error_msg"]="Required parameter (number) is missing";
    echo json_encode("missing");
}
?>