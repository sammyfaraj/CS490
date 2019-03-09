<?php

require_once("db.php");

function filter($in_data)
{
    $db = new DB();
    $conn = $db->get_connection();

    $topic = $in_data["topic"];
    $diff = $in_data["diff"];
    $key = $in_data["key"];

    $query = "SELECT * FROM `masterquestions` 
              WHERE 
                    `topic` LIKE '%$topic%' AND  
                    `diff`  LIKE '%$diff%' AND 
                    `intro` LIKE '%$key%'";
    
    $filter_results = array();

    if ($result = $conn->query($query))
        while ($row = $result->fetch_row())
            $filter_results[] = $row;

    $conn->close();

    return $filter_results;
    
}

?>