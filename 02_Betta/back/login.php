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
include "db.php";
$db = new DB();
$conn = $db->get_connection();

if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);

#Retrieve raw HTTP request data
$str_json = file_get_contents('php://input');

#Decode raw HTTP data into json format
$decoded_data = json_decode($str_json, true);

#Retrieve values
$username = $decoded_data["username"];
$password = $decoded_data["password"];


/*********************** 2 **********************/
$sql="CREATE TABLE IF NOT EXISTS `profile`
	(
    `username` varchar(255) NOT NULL default '',
    `password` varchar(255) NOT NULL default '',
    PRIMARY KEY  (`username`)
	) ENGINE = InnoDB;";

if ($conn->query($sql) === FALSE)
    echo "<br>Table profile not created successfully";



$sql = "SELECT * FROM profile WHERE NAME = '$username'";

$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
	$sql_student = "SELECT * FROM profile WHERE NAME = '$username' AND PASS = '$password' AND ROLE = '1'";
	$result = $conn->query($sql_student);
    
	//Credentials successful for student;
	if ($result->num_rows > 0) 
	{
		$ret_json->role = "1";
		$json_message = json_encode($ret_json);
		echo $json_message;
	}
	else 
	{ //Credentials successful for teacher;
		$sql_teacher = "SELECT * FROM profile WHERE NAME = '$username' AND PASS = '$password' AND ROLE = '2'";
		$result = $conn->query($sql_teacher);
		if ($result->num_rows > 0)
		{
			$ret_json->role = "2";
			$json_message = json_encode($ret_json);
			echo $json_message;
		}
	}
} 
else 
{   //Credentials are invalid;
    $ret_json->role = "0";
	$json_message = json_encode($ret_json);
	echo $json_message;
}

$conn->close()

?>