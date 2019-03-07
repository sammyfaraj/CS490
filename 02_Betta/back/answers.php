<?php

require_once("db.php");

$db = new DB();
$conn = $db->get_connection();

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);

$username = $data["username"];
$answers = $data["answers"];


$query="CREATE TABLE IF NOT EXISTS $end_name
	(
    `ID` int NOT NULL AUTO_INCREMENT,
	`username` varchar(650) NOT NULL default '',
    `grading_status` int,
	`answers` varchar(10000) NOT NULL default '',
	`grades` varchar(650) NOT NULL default '',
	`comments` varchar(1000) NOT NULL default '',
    PRIMARY KEY  (`ID`),
	) ENGINE = InnoDB;";

$result = $conn->query($query);

$query="insert into $end_name (`username`, `answers`) VALUES ('$username', '$answers')";

$result = $conn->query($query);

$conn->close()

?>
