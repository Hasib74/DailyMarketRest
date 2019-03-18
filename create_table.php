<?php
require_once 'db_function.php';
$db=new db_function();

$response=array();
if (isset($_POST['number'] )) {
	$number = $_POST['number'];
	
	$result=$db->create_table($number);
	
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