<?php

require_once("db.php");
function answers($data, $end_name){
    $db = new DB();
    $conn = $db->get_connection();

// Check connection
    if ($conn->connect_error)
        die("<br>Connection failed: " . $conn->connect_error);

    $username = $data["username"];
    $answers = $data["answers"];
    $scores = $data["scores"];
    $comments = $data["comments"];

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

    $query="insert into $end_name (`username`, `answers`, `grading_status`, `grades`, `comments`) 
        VALUES ('$username', '$answers', 1, '$scores', '$comments')";

    $result = $conn->query($query);

    $conn->close();
}

?>
