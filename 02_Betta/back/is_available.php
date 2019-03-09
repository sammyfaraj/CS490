<?php

require_once("db.php");

function is_available()
{
    $db = new DB();
    $conn = $db->get_connection();

    $success = $conn->query("SELECT exam_name FROM `Exam Status` WHERE status = 1");
    $conn->close();

    return $success->num_rows ? 1 : 0;
}

?>
