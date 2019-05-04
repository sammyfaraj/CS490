<?php
	require_once("db.php");
function get_temp_grades($end_name)
{
	$db = new DB();
	$conn = $db->get_connection();
	if ($conn->connect_error)
		die("<br>Connection failed: " . $conn->connect_error);
	  $query = "SELECT username, grades, answers, comments FROM $end_name WHERE grading_status = 1";
     
		$questions = array();
		if ($result = $conn->query($query))
			while ($row = $result->fetch_row())
				$questions[] = $row;
			$conn->close();
    return $questions;
	
}
?>