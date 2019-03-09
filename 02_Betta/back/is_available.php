<?php

require_once("db.php");

function is_available(){
    $db = new DB();
    $conn = $db->get_connection();

    $success = $conn->query("SELECT exam_name FROM `Exam Status` WHERE status = 1");
    $conn->close();

    return $success->num_rows ? 1 : 0;
}

//$end_temp = "Results";
//$row = mysqli_fetch_array($result);

//
//if ($data["request_id"] != "GET_TEST_CASES" and $result->num_rows > 0)
//{
//    if ($data["request_id"] == "IS_AVAILABLE")
//    {
//        $ret_json->status = '1';
//        $json_message = json_encode($ret_json);
//        echo $json_message;
//    }
//    else if ($data["request_id"] == "GET_ACTIVE_EXAM")
//    {
//        $getall_result=array();
//    }
//
//}
//else if ($data["request_id"] != "GET_TEST_CASES")
//{
//    $ret_json->status = '0';
//	  $json_message = json_encode($ret_json);
//	  echo $json_message;
//}


//echo $row[0];

/*
if($result)
	echo $row[0]; //to return without quotations
else 
	echo $result;
*/

//echo json_encode($row[0]);

