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


$exam_name = $data["exam_name"];

$query = "SELECT * FROM $exam_name";

$exam_questions=array();

if ($result = $conn->query($query)) {

    while ($row = $result->fetch_row()) {
		
		$query = "SELECT * FROM masterquestions WHERE  id = $row[2]";
		
		if ($result2 = $conn->query($query)) {
			
			$master_row = $result2->fetch_row();
			
			$exam_questions=$master_row[1];
			
		}

    }
	$result2->close();
    $result->close();
}


echo json_encode($exam_questions);

$conn->close()

?>
