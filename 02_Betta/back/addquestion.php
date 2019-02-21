<?php

/*

	FOR CREATING QUESTIONS:
	
	1. 	GETS CREDENTIALS FOR DATABASE AND LOG IN.
		CHECKS IF CONNECTION FAILED.
		RECEIVES AND DECODE CONTENTS FROM JSON FILE
	
	2.	TAKES QUESTION, DIFFICULTY, AND TOPIC VARIABLES
		INSERT INTO 'MASTERQUESTIONS' TABLE
		
*/

/*********************** 1 **********************/
include "db.php";
$db = new DB();
$conn = $db->get_connection();

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);

$json = file_get_contents('php://input'); 
$received = json_decode($json, true);

/*********************** 2 **********************/
$sql="CREATE TABLE IF NOT EXISTS `masterquestions`
	(
    `id` int NOT NULL AUTO_INCREMENT,
    `question` TEXT NOT NULL default '',
	`diff` varchar(255) NOT NULL default '',
	`topic` varchar(255) NOT NULL default '',
    PRIMARY KEY  (`id`)
	) ENGINE = InnoDB;";

$question = $response["question"];
$diff = $response["diff"];
$topic = $response["topic"];

$sql="Insert into `masterquestions` (`question`, `diff`, `topic`) VALUES ('$question', '$diff', '$topic')";

$result = $conn->query($sql);

if($result)	
	echo "Question added.";
else 
	echo "Question not added.";

$conn->close()

?>