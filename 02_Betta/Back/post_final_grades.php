<?php

require_once("db.php");

function post_final_grades($data, $exam_name)
{
    $db = new DB();
    $conn = $db->get_connection();

	$username = $data["username"];
	$scores = $data["scores"];
	$comments = $data["comments"];
  $answers = $data["answers"];
  echo "    ";
  echo $answers;
  echo "    ";
  echo $scores;
  echo "    ";
  echo $comments;
  echo "    ";
  echo $username;
  echo "    ";
  echo$exam_name;
  echo  "   ";
  
  $query = "UPDATE $exam_name 
			      SET answers = '$answers', grading_status  = 2, comments = '$comments', grades = '$scores'
			      WHERE username = '$username'";
	
  $result = $conn->query($query);
	
	if ($result)
		echo "Final Grades posted";
	else
		echo "Final Grades not posted";

    $conn->close();

}



?>