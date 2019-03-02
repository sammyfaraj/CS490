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

$topic = $data["topic"];
$diff = $data["diff"];
$key = $data["key"];


$query = "SELECT * FROM masterquestions WHERE topic = '$topic' AND diff = '$diff'";

$filter_result=array();

if ($result = $conn->query($query)) {

    while ($row = $result->fetch_row()) {
    
    	if (strpos($row, $key) !== false) 
	    {
		      $filter_result[]=$row;
	    }
		
    }
	
    $result->close();
}

/*

--------ignore--------

$query = $conn->query($sql);

$result = mysqli_fetch_row($query);

$filter_result=[];

foreach ($result as $row)	
{

}
*/
echo json_encode($filter_result);

$conn->close()

?>
