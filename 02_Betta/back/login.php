<?php

/*

	FOR USERS LOGGING IN:
	
	1. 	GETS CREDENTIALS FOR DATABASE AND LOG IN.
		CHECKS IF CONNECTION FAILED.
		RECEIVES AND DECODE CONTENTS FROM JSON FILE
	
	2.	CREATES TABLE FOR 'profile'
		SQL STATEMENT TO FIND IF USER HAS AUTHENTICATION
		RETURNS AUTHENTICATION RESULT AS "role"
		
*/

/*********************** 1 **********************/

require_once("db.php");
/*
$db = new DB();
$conn = $db->get_connection();

if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);
*/

#Retrieve raw HTTP request data
//$str_json = file_get_contents('php://input');

#Decode raw HTTP data into json format
//$decoded_data = json_decode($str_json, true);

#Retrieve values
$username = $data["username"];
$password = $data["password"];

/*********************** 2 **********************/
$sql="CREATE TABLE IF NOT EXISTS `profile`
	(
    `username` varchar(255) NOT NULL default '',
    `password` varchar(255) NOT NULL default '',
	`role` INT,
    PRIMARY KEY  (`username`)
	) ENGINE = InnoDB;";

if ($conn->query($sql) === FALSE)
    echo "<br>Table profile not created successfully";


//password checking
$sql = "SELECT role FROM profiles WHERE username = '$username' AND password = '$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
	$ret_json->role = $result;
	$json_message = json_encode($ret_json);
	echo $json_message;
} 
else 
{   //Credentials are invalid;
    $ret_json->role = "0";
	$json_message = json_encode($ret_json);
	echo $json_message;
}

//$conn->close()

?>
