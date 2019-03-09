<?php

require_once("db.php");

$db = new DB();
$conn = $db->get_connection();

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);

$table = $row[0]; //~~~ table name

$query = "SELECT id FROM $table"; 
$result = $conn->query($query);

$message = array();
$temp_message = array();


while ($rows = $result->fetch_row()) {
{

	$sql = mysql_query("SELECT func_name, inone, intwo, outone, outtwo FROM `masterquestions` WHERE id = $row['id']");
	
	while($case = mysql_fetch_assoc($sql))
	{
		foreach($case as $key => $value)
		{
			array_push($temp_message, $value);
		}
		array_push($temp_message, $q);
		$q++;
	}
	
    array_push($message, $temp_message);
    
}

//$json_message = json_encode($message);
//echo $json_message;

$conn->close()

?>