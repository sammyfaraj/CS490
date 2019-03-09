<?php

require_once("db.php");

function get_test_cases($name)
{
    $db = new DB();
    $conn = $db->get_connection();

    if ($conn->connect_error)
        die("<br>Connection failed: " . $conn->connect_error);
        
        $query = 
        "
        SELECT $name.points,masterquestions.func_name, masterquestions.inone, masterquestions.outone, masterquestions.intwo, masterquestions.outtwo 
        FROM $name 
        NATURAL JOIN masterquestions
        ";
        
        $questions = array();
        
        if ($result = $conn->query($query))
        while ($row = $result->fetch_row())
            $questions[] = $row;

    $conn->close();

    return $questions;
}

?>