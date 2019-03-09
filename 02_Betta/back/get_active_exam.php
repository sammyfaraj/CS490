<?php

require_once("db.php");

function get_active_exam()
{
    $db = new DB();
    $conn = $db->get_connection();

    $exam_name = get_active_exam_name();

    $query = "SELECT masterquestions.intro FROM $exam_name NATURAL JOIN masterquestions";

    $questions = array();

    if ($result = $conn->query($query))
        while ($row = $result->fetch_row())
            $questions[] = $row;

    $conn->close();

    return $questions;
}

function get_active_exam_name()
{
    $db = new DB();
    $conn = $db->get_connection();

    $success = $conn->query("SELECT `exam_name` FROM `Exam Status` WHERE `status` = 1");
    $conn->close();

    return $success->fetch_array()["exam_name"];
}

// Debugging
//get_active_exam();
?>