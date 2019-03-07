<?php

require_once("db.php");

$db = new DB();
$conn = $db->get_connection();

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);


$exam_name = $data["exam_name"];

$questions = $data["questions"];
$questionsarr = explode(",", $questions);
$points = $data["scores"];
$pointsarr = explode(",", $points);

/*****************************************************

        CREATE EXAM TABLE WITH POINTS AND QUESTION ID

*****************************************************/
$query="CREATE TABLE IF NOT EXISTS $exam_name
	(
    `examQuestionID` int NOT NULL AUTO_INCREMENT,
    `points` int,
	`id` int,
    PRIMARY KEY  (`examQuestionID`),
	FOREIGN KEY (id) REFERENCES `masterquestions`(id)
	) ENGINE = InnoDB;";

$result = $conn->query($query);

if (!$result)
  echo "Table already created";


/*****************************************************

        INSERT INTO TABLE THE POINTS AND QUESTION ID

*****************************************************/
$length = count($questionsarr);

$i = 0;
for ($i; $i < $length; $i++)
{
  
  $query="INSERT INTO $exam_name (`points`, `id`) VALUES ('$pointsarr[$i]', '$questionsarr[$i]')";

	$result = $conn->query($query);
  
}

/*****************************************************

        CREATE EXAM STATUS TABLE

*****************************************************/

$query="CREATE TABLE IF NOT EXISTS `Exam Status`
	(
	`index` int NOT NULL AUTO_INCREMENT,
    `exam_name` varchar(650) NOT NULL default '',
    `status` int,
	PRIMARY KEY  (`index`)
	) ENGINE = InnoDB;";
	
$result = $conn->query($query);


/*****************************************************

        INSERT INTO EXAM STATUS IF EXAM NAME IS NOT IN EXAM STATUS TABLE

*****************************************************/

$query = "SELECT * FROM `Exam Status` WHERE `exam_name` = '$exam_name`";
$result = $conn->query($query);

if (!$result)
{
  $query="insert into `Exam Status` (`exam_name`, `status`) VALUES ('$exam_name', '1')";

  $result = $conn->query($query);
}


 
$conn->close()

?>
