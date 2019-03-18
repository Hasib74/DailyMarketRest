<?php
require_once 'db_function.php';
$db=new db_function();

$response=array();

if ( isset($_POST['mynumber']) ) {
		
	$mynumber = $_POST['mynumber'];
//$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus
	$result=$db->readDataFromReceiverTable($mynumber);
	
	$response=$result;
	echo json_encode($response);
    
} 
else 
{
    $response["error_msg"]="Required parameter (number) is missing";
    echo json_encode($response);
}
?>