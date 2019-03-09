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

    $success = $conn->query($query);
    $conn->close();

    return $ret = $success ? $success->fetch_array() : "No Results matching filtering criteria!";;
}

# Code below is used for debugging purposes, run local php server and pass filtering data.

//$data = array(
//    "topic" => "",
//    "diff" => "",
//    "key" => ""
//);
//
//echo json_encode(filter($data));