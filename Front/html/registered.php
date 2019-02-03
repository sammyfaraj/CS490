<?php
	$dbserver = "sql.njit.edu"; 
	$user = "jsf25"; $password = "8FJBGgDP";
	$database = "jsf25";
	
	$conn = mysqli_connect($dbserver, $user, $password, $database)
		or die("Could not connect: " . mysql_error());
	mysqli_select_db($conn, $database)
        or die("Could not select database");
		
	$query = "CREATE TABLE IF NOT EXISTS `USERS` 
	(
    `NAME` varchar(255) NOT NULL default '',
    `PASS` varchar(255) NOT NULL default '',
    PRIMARY KEY  (`NAME`)
	) ENGINE = InnoDB;";


?>