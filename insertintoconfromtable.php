<?php
require_once 'db_function.php';
$db=new db_function();

$response=array();

if (isset($_POST['mynumber'])
    && isset($_POST['dateandtime'])
    &&isset($_POST['itemname'])
    &&isset($_POST['quantity'])
    &&isset($_POST['price'])) {
		
		
		
	$mynumber = $_POST['mynumber'];
	$dateandtime = $_POST['dateandtime'];
	$itemname = $_POST['itemname'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
//$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus
	$result=$db->insertintotheConfromTable($mynumber,$dateandtime,$itemname,$quantity,$price);
	
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