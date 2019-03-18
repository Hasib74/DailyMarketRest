<?php
require_once '../db_function.php';
$db=new db_function();

$response=array();

if (
    isset($_POST['number'])
	&& isset($_POST['sender_number'])
    && isset($_POST['dateandtime'])
) {
		
		
	$number=$_POST['number'];
	$sender_number=$_POST['sender_number'];
	$dateandtime = $_POST['dateandtime'];
	
//$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus
	$result=$db->decline($number,$sender_number,$dateandtime);
	
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