<?php
require_once 'db_function.php';
$db=new db_function();

$response=array();

if ( isset($_POST['mynumber']) && isset($_POST['dateandtime'])) {
		
	$mynumber = $_POST['mynumber'];
		$dateandtime = $_POST['dateandtime'];

//$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus
	$result=$db->readListFromreceiverTable($mynumber,$dateandtime);
	
	$response=$result;
	echo json_encode($response);
    
} 
else 
{
    $response["error_msg"]="Required parameter (number) is missing";
    echo json_encode($response);
}
?>