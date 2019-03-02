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

//front end to create own exam name---

$exam_name = $data["exam_name"];

$query="CREATE TABLE IF NOT EXISTS $exam_name
	(
    `examQuestionID` int NOT NULL AUTO_INCREMENT,
    `points` int,
	`id` int,
    PRIMARY KEY  (`examQuestionID`),
	FOREIGN KEY (id) REFERENCES `masterquestions`(id)
	) ENGINE = InnoDB;";


$result = $conn->query($query);

if($result)
	echo "Exam table added.";
else 
	echo "Exam table not added.";

//might have to fix this---
//innoDB automatically indexes foreign keys.
//later, decide whether to add constraints to foreign key.
//examID is automatically incremented, do not need to add in insert statement as well.
/*for ($i = 0; $i < count($ids); $i++) 
{
	$sql = "SELECT * FROM masterquestions WHERE id = '$exam_name[$i]['id']'";

	$query = $conn->query($sql);
	$result = $query->fetch();
	$id = $result['id'];

	$sql="insert into `exam` (`points`, `id`) VALUES ('$exam_name[$i]['points']', '$id')";
	
	$result = $conn->query($sql);
	
	if($result)	
		echo "Question inserted into exam.";
	else 
		echo "Question not inserted into exam.";

}
*/
$conn->close()

?>
