<?php

require_once("db.php");

function get_all_questions()
{
    $db = new DB();
    $conn = $db->get_connection();

    $all_questions = array();

    if ($result = $conn->query("SELECT * FROM masterquestions"))
        while ($row = $result->fetch_row())
            $all_questions[] = $row;

    $conn->close();
    return $all_questions;
}

?>

