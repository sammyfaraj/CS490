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


if ($conn->query($sql) === TRUE)
    echo "<br>Table profile created successfully";


$raw_data = file_get_contents('php://input');
$request = json_decode($str_json, true);

if(isset($request['username'])) $username = $request['username'];
if(isset($request['password'])) $password = $request['password'];

$sql = "SELECT * FROM profile WHERE NAME = '$username' AND PASS = '$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<br>User in Database";
} else {
    echo "<br>User NOT in Database";
}

$conn->close()


?>