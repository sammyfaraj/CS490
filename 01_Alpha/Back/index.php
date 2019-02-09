<?php

require_once ("db.php");
$db = new DB();
$conn = $db->get_connection();

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);

// sql to create table
$sql="CREATE TABLE IF NOT EXISTS `profile`
	(
    `username` varchar(255) NOT NULL default '',
    `password` varchar(255) NOT NULL default '',
    PRIMARY KEY  (`username`)
	) ENGINE = InnoDB;";

if ($conn->query($sql) === FALSE)
    echo "<br>Table profile not created successfully";

# STEP 1: Retrieve raw HTTP request data
$str_json = file_get_contents('php://input');

# STEP 2: Decode raw HTTP data into json format
$decoded_data = json_decode($str_json, true);

# STEP 3: Retrieve values
$username = $decoded_data["username"];
$password = $decoded_data["password"];

$sql = "SELECT * FROM profile WHERE NAME = '$username'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
    $sqlpass = "SELECT '$username' FROM profile WHERE PASS = '$password'";
	  $resultx = $conn->query($sqlpass);
     
	//Credentials are valid;
	if ($resultx->num_rows > 0) {
    $ret_json->DATABASE = "0";
		$json_message = json_encode($ret_json);
		echo $json_message;
	}
	else {  //Password is invalid;
		$ret_json->DATABASE = "1";
		$json_message = json_encode($ret_json);
    echo $json_message;
	}

} else {   //Credentials are invalid;
    $ret_json->DATABASE = "2";
	  $json_message = json_encode($ret_json);
	  echo $json_message;
}

$conn->close()

?>