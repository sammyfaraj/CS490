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
$sql="CREATE TABLE IF NOT EXISTS `masterquestions`
	(
    `id` int NOT NULL AUTO_INCREMENT,
    `question` TEXT NOT NULL default '',
	`topic` varchar(255) NOT NULL default '',
	`diff` varchar(255) NOT NULL default '',
    PRIMARY KEY  (`id`)
	) ENGINE = InnoDB;";

$question = $data["question"];
$topic = $data["topic"];
$diff = $data["diff"];

$sql="insert into `masterquestions` (`question`, `topic`, `diff`) VALUES ('$question', '$topic', '$diff')";

$result = $conn->query($sql);

if($result)	
	echo "Question added.";
else 
	echo "Question not added.";

//$conn->close()

?>
