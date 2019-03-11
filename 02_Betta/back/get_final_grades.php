<?php

require_once("db.php");

function get_final_grades($data, $exam_name)
{
    $db = new DB();
    $conn = $db->get_connection();
  
	  $username = $data["username"];
   
    $query = "SELECT grades, answers, comments
			        FROM $exam_name
              WHERE username = '$username' AND grading_status = 2";
    
    $result = $conn->query($query);
    
    $row = $result->fetch_assoc();
    
    return $row;
  }

?>