<?php
$servername = "sql.njit.edu";
$db_username = "bt74";
$db_password = "7CkWqwkrh";
$database = "bt74";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);
else
    echo "<br>Connected successfully";

// sql to create table
$sql="CREATE TABLE IF NOT EXISTS `profile`
	(
    `NAME` varchar(255) NOT NULL default '',
    `PASS` varchar(255) NOT NULL default '',
    PRIMARY KEY  (`NAME`)
	) ENGINE = InnoDB;";


if ($conn->query($sql) === TRUE) {
    echo "<br>Table profile created successfully";
} else {
    echo "<br>Error creating table: " . $conn->error;
}

$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);

if(isset($response['name'])) $username = $response['name'];
if(isset($response['pass'])) $password = $response['pass'];

$sql = "SELECT * FROM profile WHERE NAME = '$username' AND PASS = '$password'";

echo "<br>".$sql;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br>username: " . $row["NAME"]. " - password: " . $row["PASS"];
    }
} else {
    echo "<br>0 results";
}

$conn->close()


?>