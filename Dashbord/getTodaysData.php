<?php
require_once '../db_function.php';
$db=new db_function();

$response=array();

if ( isset($_POST['myNumber']) 
  && isset($_POST['date']) 
 ) {
		
	$mynumber = $_POST['myNumber'];
    $date=$_POST['date'];
//$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus
	$result=$db->getPriceTodays($mynumber,$date);
	
	$response=$result;
	echo json_encode($response);
    
} 
else 
{
    $response["error_msg"]="Required parameter (number) is missing";
    echo json_encode($response);
}
?>