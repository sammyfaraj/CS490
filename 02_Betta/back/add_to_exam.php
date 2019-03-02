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

$masterid = $data["masterid"];
$exam_name = $data["exam_name"];
$points = $data["points"];

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
	echo "Exam created.";
else 
	echo "Exam not created.";

$query = "SELECT * FROM masterquestions WHERE id = '$masterid'";

if ($result = $conn->query($query)) 
{
    $row = $result->fetch_row();
}

$query="INSERT INTO $exam_name (`points`, `id`) VALUES ('$points', '$masterid')";

$result = $conn->query($query);

if($result)
	echo "Question added.";
else 
	echo "Question not added.";

/*
$question=array();

if ($result = $conn->query($query)) {

    $row = $result->fetch_row();
	$question=$row;
	
	//echo $question[0][0];
	
    $result->close();
}
*/






/*
$query="insert into $exam_name (`points`, `id`) VALUES ('$points', '$masterid')";

$result = $conn->query($query);

if($result)
	echo "Question added to exam.";
else 
	echo "Question not added to exam.";
*/

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
