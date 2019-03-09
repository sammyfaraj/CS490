<?php

require_once("db.php");

function end_exam()
{
    $db = new DB();
    $conn = $db->get_connection();

    $sucess = $conn->query("UPDATE `Exam Status` SET status = 0 WHERE `status` = 1");
    $conn->close();

    return $sucess ? "Exam Session terminated successfully!" : "No Active Exam";
}

?>