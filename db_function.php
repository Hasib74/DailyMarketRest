<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class  db_function{
    private  $conn;

    function  __construct()
    {

        require_once  'db_connection.php';

        $db=new db_connection();

        $this->conn=$db->connect();
    }

    function __destruct(){

    }
	
	

	function create_table($phone_number){
		$senndertable="senndertable".$phone_number;
		$sql="CREATE TABLE $senndertable (

		   id int NOT NULL AUTO_INCREMENT, 
		   date DATE,
           receiveid VARCHAR(30),
           dateandtime VARCHAR(30),
           itemname VARCHAR(30),
           quantity VARCHAR(30),
           price VARCHAR(30),
           confrom VARCHAR(30),
           expect_accept VARCHAR(10),
           PRIMARY KEY (ID)
         )";


        $receivertable="receivertable".$phone_number;

		$sql1="CREATE TABLE $receivertable (
		   id int NOT NULL AUTO_INCREMENT, 
		   date DATE,
           senderid VARCHAR(30),
           dateandtime VARCHAR(30),
           itemname VARCHAR(30),
           quantity VARCHAR(30),
           price VARCHAR(30),
           confrom VARCHAR(30),
           accept VARCHAR(10),
           PRIMARY KEY (ID)
         )"; 

        $confrombazar="confromtable".$phone_number;
		$sql2="CREATE TABLE  $confrombazar(
		   id int NOT NULL AUTO_INCREMENT, 
	       date DATE,
           dateandtime VARCHAR(30),
           itemname VARCHAR(30),
           quantity VARCHAR(30),
           price VARCHAR(30),
           PRIMARY KEY (ID)
           
         )"; 
           $ok=$this->conn->query($sql);
           $ok=$this->conn->query($sql1);
           $ok=$this->conn->query($sql2);

         if ($ok===true) {
         	return true;
         }else{
         	return false;
         }

      

	}

	function insertintotheSenderTable($date,$mynumber,$receiverNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus,$expected_accept){
		$table="senndertable".$mynumber;
		$sql="INSERT INTO $table (date,receiveid,dateandtime,itemname, quantity,price,confrom,expect_accept) VALUES ('$date','$receiverNumber','$dateandtime','$itemname','$quantity','$price','$confromstatus','$expected_accept')";

		$ok=$this->conn->query($sql);
		if ($ok===true) {
			return true;
		}else{
			return false;
		}
	}

	function insertintotheReceiverTable($date,$mynumber,$senderNumber,$dateandtime,$itemname,$quantity,$price,$confromstatus,$accept)
	{    

		$table="receivertable".$mynumber;
		$sql="INSERT INTO $table (date,senderid ,dateandtime ,itemname ,quantity ,price ,confrom ,accept) VALUES ('$date','$senderNumber','$dateandtime','$itemname','$quantity','$price','$confromstatus','$accept')";

		$ok=$this->conn->query($sql);
		if ($ok===true) {
			return true;
		}else{
			return false;
		}
	}

	function insertintotheConfromTable($date,$mynumber,$dateandtime,$itemname,$quantity,$price){
		$table="confromtable".$mynumber;
		$sql="INSERT INTO $table (date,dateandtime,itemname,quantity,price) VALUES ($date,'$dateandtime','$itemname','$quantity','$price')";

		$ok=$this->conn->query($sql);
		if ($ok===true) {
			return true;
		}else{
			return false;
		}
	}
	function readDataFromSendTable($number) {

       $table="senndertable".$number;
	   $result=$this->conn->query("SELECT * FROM $table");
       $menus=array();
	   
	    while ($item = $result->fetch_assoc())
           $menus[]=$item;
        return $menus;
	
	}


	function readShowSendBazarList($dateAndTime,$number)
	{

       $table="senndertable".$number;
	   $result=$this->conn->query("SELECT * FROM $table WHERE dateandtime ='$dateAndTime'")or die($this->conn->error);;
       $menus=array();
	   
	    while ($item = $result->fetch_assoc()){
           $menus[]=$item;
	    }
        return $menus;
	
	}

	public function readDataFromReceiverTable($number){

		$table="receivertable".$number;
		$sql="SELECT * FROM $table";

		$result =$this->conn->query($sql);

		$menus= array();


		while ($item=$result->fetch_assoc()) {
			# code...
			$menus=$item;
		}
		return $menus;
	}

	public function readListFromreceiverTable($number,$dateandtime){

       $table="receivertable".$number;
	   $result=$this->conn->query("SELECT * FROM $table WHERE dateandtime ='$dateandtime'")or die($this->conn->error);;
       $menus=array();
	   
	    while ($item = $result->fetch_assoc()){
           $menus[]=$item;
	    }
        return $menus;

	}

	function accept ($number,$senderNumber,$dateandtime){
		$table="receivertable".$number;
		$table1="senndertable".$senderNumber;
		$sql="UPDATE $table SET  accept='1' WHERE dateandtime='$dateandtime'";
		$sql1="UPDATE $table1 SET  expect_accept='1' WHERE dateandtime='$dateandtime'";

		$result=$this->conn->query($sql);
		$result1=$this->conn->query($sql1);

		if ($result==true && $result1==true) {
            
            return true;

		}else{

			return false;
		}
	}

	function decline($mynumber,$senderNumber,$dateandtime){
		$r_table="receivertable".$mynumber;
		$s_table="senndertable".$senderNumber;

		$sql_r ="DELETE FROM $r_table WHERE dateandtime='$dateandtime'";
		$sql_s ="UPDATE $s_table SET expect_accept='-1' WHERE dateandtime = '$dateandtime' AND receiveid='$mynumber'";
          $a=$this->conn->query($sql_r);
          $b=$this->conn->query($sql_s);
		if ( $a===true && $b===true) {
			# code...
			return true;
		}else{
			return false;
		}

	}
	//$id,$number,$dateandtime,$receiverNumber,$price
	function put_price($id,$number,$dateandtime,$receiverNumber,$price){
		$table="receivertable".$number;


		$sql="UPDATE $table SET price='$price' WHERE dateandtime='$dateandtime' AND id ='$id' AND accept='1'";

		$result=$this->conn->query($sql);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	function readAllPriceFromReceiveTable($id,$number,$dateandtime){
		$table="receivertable".$number;

		$sql="SELECT price FROM $table WHERE id='$id' AND dateandtime='$dateandtime'";

		$result=$this->conn->query($sql);

		$menus=array();

		while ($item = $result->fetch_assoc()){
           $menus[]=$item;
	    }

	    return $menus;
	}

   

	public function readDateBtween($number,$date1,$date2){
		$table="senndertable".$number;

		$sql="SELECT * FROM $table WHERE date BETWEEN '$date1' AND '$date2'";
        $result=$this->conn->query($sql);
		$menus=array();

		while ($item=$result->fetch_assoc()) {
			$menus[]=$item;
		}
		return $menus;
	}

	function getPriceTodays ($number,$date){

		$table="senndertable".$number;

		$sql="SELECT * FROM $table WHERE date ='$date'";
        $result=$this->conn->query($sql);
		$menus=array();

		while ($item=$result->fetch_assoc()) {
			$menus[]=$item;
		}
		return $menus;
         
	}


   
}


?>