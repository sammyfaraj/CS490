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
$sql="CREATE TABLE IF NOT EXISTS `masterquestions`
	(
    `id` int AUTO_INCREMENT,
    `intro` varchar(650) NOT NULL default '',
	`topic` varchar(650) NOT NULL default '',
	`diff` varchar(650) NOT NULL default '',
	`func_name` varchar(650) NOT NULL default '',
	`paramname` varchar(650) NOT NULL default '',
	`paramtype` varchar(650) NOT NULL default '',
	`inone` varchar(255) NOT NULL default '',
	`outone` varchar(255) NOT NULL default '',
	`intwo` varchar(255) NOT NULL default '',
	`outtwo` varchar(255) NOT NULL default '',
    PRIMARY KEY  (`id`)
	) ENGINE = InnoDB;";


$create = $conn->query($sql);

$alter = "alter table `masterquestions` auto_increment = 1";
$altered = $conn->query($alter);

if($altered)
  echo "Table is altered";
else
  echo "Table not altered";


$intro = $data["intro"];
$topic = $data["topic"];
$diff = $data["diff"];
$func_name = $data["func_name"];
$paramname = $data["paramname"];
$paramtype = $data["paramtype"];
$inone = $data["inone"];
$intwo = $data["intwo"];
$outone = $data["outone"];
$outtwo = $data["outtwo"];

$sql2="insert into `masterquestions` (`intro`, `topic`, `diff`, `func_name`, `paramname`, `paramtype`, `inone`, `outone`, `intwo`, `outtwo`) VALUES (\"$intro\", '$topic', '$diff', '$func_name', '$paramname', '$paramtype', '$inone', '$outone', '$intwo', '$outtwo')";


$result = $conn->query($sql2);

if($result)
	echo "Question successfully added.";
else 
	echo "Question not added.";

//$conn->close()

?>
