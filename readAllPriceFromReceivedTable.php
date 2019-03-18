<?php
require_once 'db_function.php';
$db=new db_function();

$response=array();

if (isset($_POST['id'])
 && isset($_POST['number'])
 && isset($_POST['dateandtime'])

) {
		
		
	$id	=$_POST['id'];
    $number=$_POST['number'];
	$dateandtime=$_POST['dateandtime'];

	$result=$db->readAllPriceFromReceiveTable($id,$number,$dateandtime);
	
	$response=$result;
	echo json_encode($response);
    
} else {
    $response["error_msg"]="Required parameter (number) is missing";
    echo json_encode($response);
}
?>