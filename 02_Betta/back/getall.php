<?php

/*
	
*/

/*********************** 1 **********************/
require_once("db.php");

$db = new DB();
$conn = $db->get_connection();

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);


//$json = file_get_contents('php://input'); 
//$received = json_decode($json, true);

/*********************** 2 **********************/

$query = "SELECT * FROM masterquestions";

$getall_result=array();

if ($result = $conn->query($query)) {

    while ($row = $result->fetch_row()) {
		$getall_result[]=$row;
    }
	
    $result->close();
}


echo json_encode($getall_result);

$conn->close()

?>
