<?php

/*
	
*/

/*********************** 1 **********************/
require_once("db.php");
/*
$db = new DB();
$conn = $db->get_connection();

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);
*/

//$json = file_get_contents('php://input'); 
//$received = json_decode($json, true);

/*********************** 2 **********************/

$topic = $data["topic"];
$diff = $data["diff"];
$keyword = $data["keyword"]

$sql = "SELECT * FROM masterquestions WHERE topic = '$id' AND diff = '$diff'";

$query = $conn->query($sql);
$result = $query->fetchAll();

$filter_result=[];

foreach ($result as $row)	
{
	if (strpos($row['question'], $keyword) !== false) 
	{
		$filter_result[]=array('id'=>$row['id'],'question'=> $row['question'],'topic'=>$row['topic'],'diff'=>$row['diff']);
	}
}

echo json_encode($filter_result);

//$conn->close()

?>