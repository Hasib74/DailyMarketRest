<?php
require_once '../db_function.php';
$db=new db_function();

$response=array();

if ( isset($_POST['myNumber'])
     &&  isset($_POST['date1'])
      &&  isset($_POST['date2'])
 ) {
		
	$mynumber = $_POST['myNumber'];
    $date1=$_POST['date1'];
    $date2=$_POST['date2'];
//$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus
	$result=$db->readDateBtween($mynumber,$date1,$date2);

	$response=$result;
	echo json_encode($response);
    
} 
else 
{
    $response["error_msg"]="Required parameter (number) is missing";
    echo json_encode($response);
}
?>