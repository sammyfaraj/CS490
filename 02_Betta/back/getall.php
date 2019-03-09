<?php

require_once("db.php");
//
//function get_active_exam($exam_name)
//{
//    $db = new DB();
//    $conn = $db->get_connection();
//
//    $query = "SELECT * FROM $exam_name";
//    if ($result = $conn->query($query)) {
//
//        while ($row = $result->fetch_row()) {
//            array_push($getall_result, $row);
//            $sql = "SELECT intro FROM masterquestions WHERE id = $row[2]";
//            $question = $result->fetch_row();
//            $getall_result[] = $question[0];
//        }
//
//        $result->close();
//    }
//    return $getall_result;
//}

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



