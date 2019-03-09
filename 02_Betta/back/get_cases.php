<?php

require_once("db.php");

$db = new DB();
$conn = $db->get_connection();

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);

$table = $row[0]; //~~~ table name

if (is_null($table)){
    print_r("something happened and table is now NULL<br>");
}


$query = "SELECT id, points FROM $table";
$result = $conn->query($query);


$message = array();
$temp_message = array();
$scores = array();

while ($rows = $result->fetch_row()) {

    $id = $rows[0];
    $score = $rows[1];
    array_push($temp_message, $rows[1]);

    $sql = "SELECT func_name, inone, intwo, outone, outtwo FROM `masterquestions` WHERE id = $id";
    $result2 = $conn->query($sql);


    while($case = $result2->fetch_row())
    {
        foreach($case as $key => $value)
        {
            array_push($temp_message, $value);
        }
        array_push($temp_message, $id);
        array_push($temp_message, $score);
    }

    array_push($message, $temp_message);

}

$conn->close()

?>